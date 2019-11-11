<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Contrato;
use App\Proveedor;
use App\Moneda;
use App\Cargo;
use App\Boleta;
use App\HitoContrato;
use App\Licitacion;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Exports\ContratosExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Http\Requests\Backend\ContratoRequest;

class contratosController extends Controller
{
    public function index(Request $request)
    {
       
        if (Auth::user()->hasRole('Admin')){
            $contratos = Contrato::withTrashed(); //si es admin despliega todos los contratos
        }else{
            $contratos = Contrato::where('cargo_id','=', Auth::user()->cargo_id); //si es admin tecnico despliega solo sus contratos
        }
        
        
        $proveedores = Proveedor::withTrashed()->pluck('rut', 'id')->toArray();
        $proveedoresNombre = Proveedor::withTrashed()->pluck('razon_social', 'id')->toArray();
        $licitaciones = Contrato::withTrashed()->pluck('licitacion_id', 'id')->toArray();
        $cargos = Cargo::withTrashed()->pluck('nombre', 'id')->toArray();
        $licitacion = Licitacion::withTrashed()->pluck('nro_licitacion', 'id');


        if ($request->has('proveedores') && $request->get('proveedores') != null) {
			$contratos = $contratos->where('proveedor_id', '=', $request->get('proveedores'));
        }
        if ($request->has('proveedoresNombre') && $request->get('proveedoresNombre') != null) {
			$contratos = $contratos->where('proveedor_id', '=', $request->get('proveedoresNombre'));
        }
        if ($request->has('licitaciones') && $request->get('licitaciones') != null) {
			$contratos = $contratos->where('licitacion_id', '=', $request->get('licitaciones'));
        }
        if ($request->has('cargos') && $request->get('cargos') != null) {
            $contratos = $contratos->join('cargos','contratos.cargo_id','=','cargos.id')
			                        ->where('cargos.id', '=', $request->get('cargos'));
        }
        if ($request->has('vigencia') && $request->get('vigencia') != null) {
            $fechaActual = new \DateTime();
            if($request->get('vigencia') == 'si'){
                $contratos = $contratos->where('fecha_termino', '>=', $fechaActual->format('Y-m-d'));
            }else{
                $contratos = $contratos->where('fecha_termino', '<', $fechaActual->format('Y-m-d'));
            }
        }

      

        $contratos = $contratos->paginate(10);
        return view('backend.contratos.index')->with('contratosData', $contratos)
                                              ->with('proveedoresData', $proveedores)
                                              ->with('proveedoresNombreData', $proveedoresNombre)
                                              ->with('licitacionesData', $licitaciones)
                                              ->with('cargosData', $cargos)
                                              ->with('licitacion', $licitacion);
    }



    public function export()
    {
        return Excel::download(new ContratosExport, 'Contratos.xlsx');
    }

    public function form(Contrato $contrato = null)
    {
        $contrato = $contrato ?: new Contrato;        

        $licitacion = \App\Licitacion::pluck('nro_licitacion','id')->toArray();
        $proveedores = \App\Proveedor::pluck('rut', 'id')->toArray();
        $monedas = \App\Moneda::pluck('codigo', 'id')->toArray();
        $cargos = \App\Cargo::pluck('nombre', 'id')->toArray();
        $boletas = \App\Boleta::withTrashed()->pluck('numero', 'id')->toArray();

        return view('backend.contratos.form')->with('contrato', $contrato)
                                                ->with('proveedoresData', $proveedores)
                                                ->with('monedasData', $monedas)
                                                ->with('cargosData', $cargos)
                                                ->with('boletasData', $boletas)
                                                ->with('licitacionData', $licitacion);
                                                
    }

    public function post(Request $request)
    {
       
     
        $contrato = Contrato::withTrashed()->firstOrNew(['id' => $request->get('id')]);
        // aca podemos validar el campo licitacion
        if($request->get('licitacion')===null){
            $contrato->licitacion_id = 1;
        }else{
            $contrato->licitacion_id = $request->get('licitacion');
        }
        $contrato->id = $request->get('id');
        $contrato->proveedor_id = $request->get('proveedor_id');
        
        $contrato->moneda_id = $request->get('moneda_id');
        $contrato->precio = $request->get('precio');
        $contrato->diferencial = $request->get('precio'); //DIFERENCIAL
        $contrato->cargo_id = $request->get('cargo_id');
       // $contrato->nombre_admin_tecnico = $request->get('nombre_admin_tecnico');
        $contrato->fecha_inicio = $request->get('fecha_inicio');
        $contrato->fecha_termino = $request->get('fecha_termino');
        $contrato->fecha_aprobacion = $request->get('fecha_aprobacion');
        $contrato->alerta_vencimiento = $request->get('alerta_vencimiento');
        $contrato->objeto_contrato = $request->get('objeto_contrato');
        $contrato->selectContrato = $request->get('selectContrato');

      

        if($request->get('alerta_vencimiento')){
            $this->validate($request,array(
                'alerta_vencimiento' => 'date:contratos',
            ));
        }
        
        

        $nuevaBoleta = Boleta::withTrashed()->firstOrNew(['id' => $request->get('boleta_id')]);
        $nuevaBoleta->id = $request->get('boleta_id');
        $nuevaBoleta->numero = $request->get('numero');
        $nuevaBoleta->monto = $request->get('monto');
        $nuevaBoleta->fecha_vencimiento = $request->get('fecha_vencimiento');
        $nuevaBoleta->alerta_vencimiento = $request->get('alerta_boleta');

        if($request->get('alerta_boleta')){
            $this->validate($request,array(
                'numero' => 'required:boletas',
                'monto' => 'required|numeric:boletas',
                'fecha_vencimiento' => 'date|required:boletas',
                'alerta_vencimiento' => 'date:boletas',
            ));
        }else{
            $this->validate($request,array(
                'numero' => 'required:boletas',
                'monto' => 'required|numeric:boletas',
                'fecha_vencimiento' => 'date|required:boletas',
            ));
        }
        
        if($contrato->alerta_vencimiento == null && $nuevaBoleta->alerta_vencimiento == null){
            $contrato->estado_alerta = 'visto';
            $nuevaBoleta->estado_alerta = 'visto';
        }

        //$contrato->selectContrato = $request->get('selectContrato');
       /*  if($request->get('selectContrato') == "0")
        {           
            $contrato->licitacion_id = "LC-". $request->get('licitacion');

        }else
        {
            $contrato->licitacion_id = "TD-".$request->get('licitacion'); 
        } */

        
     

        $nuevaBoleta->save();
        $contrato->boleta_id = $nuevaBoleta->id;  
        
        $contrato->save();

        return redirect()->route('contratos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     
    public function delete(Contrato $contrato)
    {
        $contrato->delete();

        return redirect()->back();
    }

    public function restore($contrato)
    {
        $contrato = Contrato::withTrashed()->find($contrato);
        $contrato->restore();
        
        return redirect()->back();
    }

    public function forceDelete($contrato)
    {
        $contrato = Contrato::withTrashed()->find($contrato);
        $contrato->forceDelete();
        
        return redirect()->back();
    }


}
