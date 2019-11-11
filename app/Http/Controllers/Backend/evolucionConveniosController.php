<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\EvolucionConvenio;
use App\Convenio;
use App\User;
use App\Http\Requests\Backend\evolucionConvenioRequest;

class evolucionConveniosController extends Controller
{
    public function index(Request $request, $convenio_id)
    {
        $bitacoras = EvolucionConvenio::withTrashed();

        $bitacoras = $bitacoras->where('convenio_id','=',$convenio_id);
        
        $bitacoras = $bitacoras->paginate(10);
        return view('backend.bitacoraConvenio.index', ['convenio' => Convenio::withTrashed()->findOrFail($convenio_id)])
                                                    ->with('bitacorasData', $bitacoras);
    }

    public function form(EvolucionConvenio $bitacora, $convenio_id)
    {
        $bitacora = $bitacora ?: new EvolucionConvenio;

        
        return view('backend.bitacoraConvenio.form',['convenio' => Convenio::withTrashed()->findOrFail($convenio_id)])
                                                    ->with('bitacora', $bitacora);
    }

    public function post(evolucionConvenioRequest $request, $convenio_id)
    {
        $bitacora = EvolucionConvenio::withTrashed()->firstOrNew(['id' => $request->get('id')]);

        $bitacora->id = $request->get('id');
        $bitacora->fecha = new \DateTime();
        $bitacora->texto = $request->get('texto');
        $bitacora->convenio_id = $convenio_id;
        $bitacora->user_id = \Auth::user()->id;
        
        $bitacora->save();

        return redirect()->route('bitacoraConvenio.index',['convenio' => Convenio::withTrashed()->findOrFail($convenio_id)])
                                                     ->with('success','Registro editado satisfactoriamente');
    }
}
