<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Convenio;
use App\Proveedor;
use App\Boleta;
use App\Http\Requests\Backend\ConvenioRequest;
use App\Exports\ConveniosExport;
use Maatwebsite\Excel\Facades\Excel;

class conveniosController extends Controller
{
    public function index(Request $request)
    {
        $convenios = Convenio::withTrashed();
        $proveedores = Proveedor::withTrashed()->pluck('rut', 'id')->toArray();
        $licitaciones = Convenio::withTrashed()->pluck('licitacion', 'id')->toArray();
        $razon_social = Proveedor::withTrashed()->pluck('razon_social', 'id')->toArray();

        if ($request->has('proveedores') && $request->get('proveedores') != null) {
			$convenios = $convenios->where('proveedor_id', '=', $request->get('proveedores'));
        }
        if ($request->has('licitaciones') && $request->get('licitaciones') != null) {
			$convenios = $convenios->where('id', '=', $request->get('licitaciones'));
        }
        if ($request->has('razon_social') && $request->get('razon_social') != null) {
			$convenios = $convenios->where('proveedor_id', '=', $request->get('razon_social'));
        }
        if ($request->has('vigencia') && $request->get('vigencia') != null) {
            $fechaActual = new \DateTime();
            if($request->get('vigencia') == 'si'){
                $convenios = $convenios->where('fecha_termino', '>=', $fechaActual->format('Y-m-d'));
            }else{
                $convenios = $convenios->where('fecha_termino', '<', $fechaActual->format('Y-m-d'));
            }
        }

        $convenios = $convenios->paginate(9999999);
        return view('backend.convenios.index')->with('conveniosData', $convenios)
                                              ->with('proveedoresData', $proveedores)
                                              ->with('licitacionesData', $licitaciones)
                                              ->with('razon_socialData', $razon_social);
    }

    public function export()
    {
        return Excel::download(new ConveniosExport, 'Convenios.xlsx');
    }

    public function form(convenio $convenio = null, Request $request)
    {
        $convenio = $convenio ?: new Convenio;

        $proveedores = Proveedor::pluck('rut', 'id')->toArray();
        $boletas = Boleta::withTrashed()->pluck('numero', 'id')->toArray();


        return view('backend.convenios.form')->with('convenio', $convenio)
                                                ->with('proveedoresData', $proveedores)
                                                ->with('boletasData', $boletas);
    }

    public function post(ConvenioRequest $request, convenio $convenio, Boleta $boleta)
    {
        $convenio = Convenio::withTrashed()->firstOrNew(['id' => $request->get('id')]);
        $convenio->id = $request->get('id');
        $convenio->proveedor_id = $request->get('proveedor_id');
        $convenio->licitacion = $request->get('licitacion');
        $convenio->fecha_inicio = $request->get('fecha_inicio');
        $convenio->fecha_termino = $request->get('fecha_termino');
        $convenio->objeto_contrato = $request->get('objeto_contrato');
        $convenio->alerta_vencimiento = $request->get('alerta_vencimiento');

        if($request->get('alerta_vencimiento')){
            $this->validate($request,array(
                'alerta_vencimiento' => 'date:convenios',
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

        $nuevaBoleta->save();

        $convenio->boleta_id = $nuevaBoleta->id;     

        $convenio->save();

        return redirect()->route('convenios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     
    public function delete(convenio $convenio)
    {
        $convenio->delete();

        return redirect()->back();
    }

    public function restore($convenio)
    {
        $convenio = Convenio::withTrashed()->find($convenio);
        $convenio->restore();
        
        return redirect()->back();
    }

    public function forceDelete($convenio)
    {
        $convenio = Convenio::withTrashed()->find($convenio);
        $convenio->forceDelete();
        
        return redirect()->back();
    }
}