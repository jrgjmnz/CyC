<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Backend\HitoContratoRequest;

use App\Contrato;
use App\Proveedor;
use App\Moneda;
use App\Cargo;
use App\Boleta;
use App\HitoContrato;

class hitoContratoController extends Controller
{
    public function index(Request $request, $contrato_id)
    {
        $hitos = HitoContrato::withTrashed();
        $licitaciones = Contrato::withTrashed()->pluck('licitacion', 'id')->toArray();
        $objetos = Contrato::withTrashed()->pluck('objeto_contrato', 'id')->toArray();

        $hitos = $hitos->where('contrato_id', '=', $contrato_id);

        $hitos = $hitos->where('estado_alerta', '=', null);

        $hitos = $hitos->paginate(10);
        return view('backend.hitoContrato.index', ['contrato' => Contrato::withTrashed()->findOrFail($contrato_id)])
                                              ->with('hitosData', $hitos)
                                              ->with('licitacionesData', $licitaciones)
                                              ->with('objetosData', $objetos);
    }

    public function mostrarTodos(Request $request, $contrato_id)
    {
        $hitos = HitoContrato::withTrashed();
        $licitaciones = Contrato::withTrashed()->pluck('licitacion', 'id')->toArray();
        $objetos = Contrato::withTrashed()->pluck('objeto_contrato', 'id')->toArray();

        $hitos = $hitos->where('contrato_id', '=', $contrato_id);

        $hitos = $hitos->paginate(9999999);
        return view('backend.hitoContrato.index', ['contrato' => Contrato::withTrashed()->findOrFail($contrato_id)])
                                              ->with('hitosData', $hitos)
                                              ->with('licitacionesData', $licitaciones)
                                              ->with('objetosData', $objetos);
    }

    public function form(HitoContrato $hito, $contrato_id)
    {
        $hito = $hito ?: new HitoContrato;
        
        return view('backend.hitoContrato.form', ['contrato' => Contrato::withTrashed()->findOrFail($contrato_id)])
                                                ->with('hitos', $hito);
    }

    public function post(HitoContratoRequest $request, HitoContrato $hito, $contrato_id)
    {
        $hito = HitoContrato::withTrashed()->firstOrNew(['id' => $request->get('id')]);

        if(!$hito->exists){
            $contrato = Contrato::withTrashed()->firstOrNew(['id' => $contrato_id]);
            $contrato->estado_alerta = null;
            $contrato->save();

            $boleta = Boleta::withTrashed()->firstOrNew(['id' => $contrato->boleta_id]);
            $boleta->estado_alerta = null;
            $boleta->save();
        }

        $hito->id = $request->get('id');
        $hito->nombre = $request->get('nombre');
        $hito->fecha_alerta = $request->get('fecha_alerta');
        $hito->fecha_hito = $request->get('fecha_hito');
        $hito->contrato_id = $contrato_id;
        $hito->save();
        return redirect()->route('hitoContrato.index', ['contrato' => Contrato::withTrashed()->findOrFail($contrato_id)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     
    public function delete(HitoContrato $hito)
    {
        $hito->delete();

        return redirect()->back();
    }

    public function restore($hito)
    {
        $hito = HitoContrato::withTrashed()->find($hito);
        $hito->restore();
        
        return redirect()->back();
    }

    public function forceDelete($hito)
    {
        $hito = HitoContrato::withTrashed()->find($hito);
        $hito->forceDelete();
        
        return redirect()->back();
    }

    public function visto(HitoContrato $hito)
    {
        $hito = HitoContrato::withTrashed()->firstOrNew(['id' => $hito->id]);
        $hito->estado_alerta = 'visto';
        $hito->save();

        /* $contrato = Contrato::withTrashed()->firstOrNew(['id' => $contrato->id]);
        $contrato->estado_alerta = 'resuelto';
        $contrato->save(); */

        $hito_contrato = HitoContrato::query();
        $hito_contrato = $hito_contrato->where('contrato_id', '=', $hito->contrato_id);
        $hito_contrato = $hito_contrato->where('estado_alerta', '=', null);

        if(strlen($hito_contrato->get()) <= 2){
            //no tiene hitos, se revisa alerta boleta:
            $boleta_contrato = Boleta::query();
            $boleta_contrato = $boleta_contrato->where('id', '=', $hito->contratos->boleta_id);
            $boleta_contrato = $boleta_contrato->where('estado_alerta', '=', null);
            //revisar si tiene alerta de boleta:
            $boleta = Boleta::withTrashed()->firstOrNew(['id' => $hito->contratos->boleta_id]);

            //no tiene hitos, se revisa contratos:
            $contratoEstado = Contrato::query();
            $contratoEstado = $contratoEstado->where('id', '=', $hito->contrato_id);
            $contratoEstado = $contratoEstado->where('estado_alerta', '=', null);

            $contratoAlerta = Contrato::withTrashed()->firstOrNew(['id' => $hito->contrato_id]);

            if((strlen($boleta_contrato->get()) <= 2 || $boleta->alerta_vencimiento == null) && (strlen($contratoEstado->get()) <= 2 || $contratoAlerta->alerta_vencimiento == null)){
                //si la boleta está resuelta o no tenía alerta, cambiar todo a visto.
                $contrato = Contrato::withTrashed()->firstOrNew(['id' => $hito->contrato_id]);
                $contrato->estado_alerta = 'visto';
                $contrato->save();

                $boleta = Boleta::withTrashed()->firstOrNew(['id' => $hito->contratos->boleta_id]);
                $boleta->estado_alerta = 'visto';
                $boleta->save();
            }
        }

        return redirect()->back();
    }

    public function recuperar(HitoContrato $hito)
    {
        $hito = HitoContrato::withTrashed()->firstOrNew(['id' => $hito->id]);
        $hito->estado_alerta = null;
        $hito->save();

        $contrato = Contrato::withTrashed()->firstOrNew(['id' => $hito->contrato_id]);
        $contrato->estado_alerta = null;
        $contrato->save();

        $boleta = Boleta::withTrashed()->firstOrNew(['id' => $contrato->boleta_id]);
        $boleta->estado_alerta = null;
        $boleta->save();

        return redirect()->back();
    }
}