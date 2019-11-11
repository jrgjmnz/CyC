<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Backend\HitoConvenioRequest;

use App\Convenio;
use App\Proveedor;
use App\Moneda;
use App\Cargo;
use App\Boleta;
use App\HitoConvenio;

class hitoConvenioController extends Controller
{
    public function index(Request $request, $convenio_id)
    {
        $hitos = HitoConvenio::withTrashed();
        $licitaciones = Convenio::withTrashed()->pluck('licitacion', 'id')->toArray();
        $objetos = Convenio::withTrashed()->pluck('objeto_contrato', 'id')->toArray();

        $hitos = $hitos->where('convenio_id', '=', $convenio_id);

        $hitos = $hitos->where('estado_alerta', '=', null);

        $hitos = $hitos->paginate(10);
        return view('backend.hitoConvenio.index', ['convenio' => Convenio::withTrashed()->findOrFail($convenio_id)])
                                              ->with('hitosData', $hitos)
                                              ->with('licitacionesData', $licitaciones)
                                              ->with('objetosData', $objetos);
    }

    public function mostrarTodos(Request $request, $convenio_id)
    {
        $hitos = HitoConvenio::withTrashed();
        $licitaciones = Convenio::withTrashed()->pluck('licitacion', 'id')->toArray();
        $objetos = Convenio::withTrashed()->pluck('objeto_contrato', 'id')->toArray();

        $hitos = $hitos->where('convenio_id', '=', $convenio_id);

        $hitos = $hitos->paginate(10);
        return view('backend.hitoConvenio.index', ['convenio' => Convenio::withTrashed()->findOrFail($convenio_id)])
                                              ->with('hitosData', $hitos)
                                              ->with('licitacionesData', $licitaciones)
                                              ->with('objetosData', $objetos);
    }

    public function form(HitoConvenio $hito, $convenio_id)
    {
        $hito = $hito ?: new HitoConvenio;
        
        return view('backend.hitoConvenio.form', ['convenio' => Convenio::withTrashed()->findOrFail($convenio_id)])
                                                ->with('hitos', $hito);
    }

    public function post(HitoConvenioRequest $request, HitoConvenio $hito, $convenio_id)
    {
        $hito = HitoConvenio::withTrashed()->firstOrNew(['id' => $request->get('id')]);

        if(!$hito->exists){
            $convenio = Convenio::withTrashed()->firstOrNew(['id' => $convenio_id]);
            $convenio->estado_alerta = null;
            $convenio->save();

            $boleta = Boleta::withTrashed()->firstOrNew(['id' => $convenio->boleta_id]);
            $boleta->estado_alerta = null;
            $boleta->save();
        }

        $hito->id = $request->get('id');
        $hito->nombre = $request->get('nombre');
        $hito->fecha_alerta = $request->get('fecha_alerta');
        $hito->fecha_hito = $request->get('fecha_hito');
        $hito->convenio_id = $convenio_id;
        $hito->save();
        return redirect()->route('hitoConvenio.index', ['convenio' => Convenio::withTrashed()->findOrFail($convenio_id)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     
    public function delete(HitoConvenio $hito)
    {
        $hito->delete();

        return redirect()->back();
    }

    public function restore($hito)
    {
        $hito = HitoConvenio::withTrashed()->find($hito);
        $hito->restore();
        
        return redirect()->back();
    }

    public function forceDelete($hito)
    {
        $hito = HitoConvenio::withTrashed()->find($hito);
        $hito->forceDelete();
        
        return redirect()->back();
    }

    public function visto(HitoConvenio $hito)
    {
        $hito = HitoConvenio::withTrashed()->firstOrNew(['id' => $hito->id]);
        $hito->estado_alerta = 'visto';
        $hito->save();

        /* $convenio = Convenio::withTrashed()->firstOrNew(['id' => $convenio->id]);
        $convenio->estado_alerta = 'resuelto';
        $convenio->save(); */

        $hito_convenio = HitoConvenio::query();
        $hito_convenio = $hito_convenio->where('convenio_id', '=', $hito->convenio_id);
        $hito_convenio = $hito_convenio->where('estado_alerta', '=', null);

        if(strlen($hito_convenio->get()) <= 2){
            //no tiene hitos, se revisa alerta boleta:
            $boleta_convenio = Boleta::query();
            $boleta_convenio = $boleta_convenio->where('id', '=', $hito->convenios->boleta_id);
            $boleta_convenio = $boleta_convenio->where('estado_alerta', '=', null);
            //revisar si tiene alerta de boleta:
            $boleta = Boleta::withTrashed()->firstOrNew(['id' => $hito->convenios->boleta_id]);

            //no tiene hitos, se revisa convenios:
            $convenioEstado = Convenio::query();
            $convenioEstado = $convenioEstado->where('id', '=', $hito->convenio_id);
            $convenioEstado = $convenioEstado->where('estado_alerta', '=', null);

            $convenioAlerta = Convenio::withTrashed()->firstOrNew(['id' => $hito->convenio_id]);

            if((strlen($boleta_convenio->get()) <= 2 || $boleta->alerta_vencimiento == null) && (strlen($convenioEstado->get()) <= 2 || $convenioAlerta->alerta_vencimiento == null)){
                //si la boleta está resuelta o no tenía alerta, cambiar todo a visto.
                $convenio = Convenio::withTrashed()->firstOrNew(['id' => $hito->convenio_id]);
                $convenio->estado_alerta = 'visto';
                $convenio->save();

                $boleta = Boleta::withTrashed()->firstOrNew(['id' => $hito->convenios->boleta_id]);
                $boleta->estado_alerta = 'visto';
                $boleta->save();
            }
        }

        return redirect()->back();
    }

    public function recuperar(HitoConvenio $hito)
    {
        $hito = HitoConvenio::withTrashed()->firstOrNew(['id' => $hito->id]);
        $hito->estado_alerta = null;
        $hito->save();

        $convenio = Convenio::withTrashed()->firstOrNew(['id' => $hito->convenio_id]);
        $convenio->estado_alerta = null;
        $convenio->save();

        $boleta = Boleta::withTrashed()->firstOrNew(['id' => $convenio->boleta_id]);
        $boleta->estado_alerta = null;
        $boleta->save();

        return redirect()->back();
    }
}