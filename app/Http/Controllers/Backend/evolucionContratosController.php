<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\EvolucionContrato;
use App\Contrato;
use App\User;
use App\Http\Requests\Backend\evolucionContratoRequest;

class evolucionContratosController extends Controller
{
    public function index(Request $request, $contrato_id)
    {
        $bitacoras = EvolucionContrato::withTrashed();

        $bitacoras = $bitacoras->where('contrato_id','=',$contrato_id);
        
        $bitacoras = $bitacoras->paginate(10);
        return view('backend.bitacoraContrato.index', ['contrato' => Contrato::withTrashed()->findOrFail($contrato_id)])
                                                    ->with('bitacorasData', $bitacoras);
    }

    public function form(EvolucionContrato $bitacora, $contrato_id)
    {
        $bitacora = $bitacora ?: new EvolucionContrato;

        
        return view('backend.bitacoraContrato.form',['contrato' => Contrato::withTrashed()->findOrFail($contrato_id)])
                                                    ->with('bitacora', $bitacora);
    }

    public function post(evolucionContratoRequest $request, $contrato_id)
    {
        $bitacora = EvolucionContrato::withTrashed()->firstOrNew(['id' => $request->get('id')]);

        $bitacora->id = $request->get('id');
        $bitacora->fecha = new \DateTime();
        $bitacora->texto = $request->get('texto');
        $bitacora->contrato_id = $contrato_id;
        $bitacora->user_id = \Auth::user()->id;
        
        $bitacora->save();

        return redirect()->route('bitacoraContrato.index',['contrato' => Contrato::withTrashed()->findOrFail($contrato_id)])
                                                     ->with('success','Registro editado satisfactoriamente');
    }   
}
