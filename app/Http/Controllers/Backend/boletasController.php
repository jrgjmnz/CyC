<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Boleta;
use App\Http\Requests\Backend\BoletaRequest;

class boletasController extends Controller
{
    public function index(Request $request)
    {
        $fechas = \App\HitoContrato::pluck('fecha_alerta', 'id')->toArray();

        $now = new \DateTime();
        $now = $now->format('Y-m-d');
        
        $cant = 0;

        foreach( $fechas  as $entityId => $entityValue){
           if ( $entityValue == $now){
                $cant++;
            }
        }

        $boletas = Boleta::withTrashed();
        $numeros = \App\Boleta::withTrashed()->pluck('numero', 'id')->toArray();

        if ($request->has('numero') && $request->get('numero') != null) {
			$boletas = $boletas->where('id', '=', $request->get('numero'));
        }

        $boletas = $boletas->paginate(10);
        return view('backend.boletas.index')->with('boletasData', $boletas)->with('numerosData', $numeros)->with('vencidos', $cant);
    }

    public function form(Boleta $boleta = null)
    {
        $boleta = $boleta ?: new Boleta;
        return view('backend.boletas.form')->with('boleta', $boleta);
    }

    public function post(BoletaRequest $request, Boleta $boleta)
    {
        $boleta = Boleta::withTrashed()->firstOrNew(['id' => $request->get('id')]);
        $boleta->id = $request->get('id');
        $boleta->numero = $request->get('numero');
        $boleta->monto = $request->get('monto');
        $boleta->fecha_vencimiento = $request->get('fecha_vencimiento');
        $boleta->alerta_vencimiento = $request->get('alerta_vencimiento');

        $boleta->save();

        return redirect()->route('boletas.index')->with('success','Registro editado satisfactoriamente');
    }

    public function delete(Boleta $boleta)
    {
        $boleta->delete();

        return redirect()->back();
    }

    public function restore($boletaId)
    {
        $boleta = Boleta::withTrashed()->find($boletaId);
        $boleta->restore();
        
        return redirect()->back();
    }

    public function forceDelete($boletaId)
    {
        $boleta = Boleta::withTrashed()->find($boletaId);
        $boleta->forceDelete();
    
        return redirect()->back();
    }
}
