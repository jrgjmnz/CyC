<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Prestacion;
use App\Http\Requests\Backend\PrestacionRequest;

class prestacionesController extends Controller
{
    public function index(Request $request)
    {  
        $prestaciones = Prestacion::withTrashed();
        $codigos = Prestacion::withTrashed()->pluck('codigo', 'id')->toArray();
        $nombres = Prestacion::withTrashed()->pluck('nombre', 'id')->toArray();

        if ($request->has('codigo') && $request->get('codigo') != null) {
			$prestaciones = $prestaciones->where('codigo', '=', $request->get('codigo'));
        }
        if ($request->has('nombre') && $request->get('nombre') != null) {
			$prestaciones = $prestaciones->where('nombre', 'like', $request->get('nombre'));
        }
        if ($request->has('fonasa') && $request->get('fonasa') != null) {
            if($request->get('fonasa') == 1){
                $prestaciones = $prestaciones->where('valor_1', '=', null);
                $prestaciones = $prestaciones->where('valor_2', '=', null);
                $prestaciones = $prestaciones->where('valor_3', '=', null);
            }else{
                $prestaciones = $prestaciones->where('valor_1', '!=', null)
                                             ->orWhere('valor_2', '!=', null)
                                             ->orWhere('valor_3', '!=', null);
            }
        }
    
    
        $prestaciones = $prestaciones->paginate(15);
        return view('backend.prestaciones.index')->with('prestacionesData', $prestaciones)
                                                 ->with('codigosData', $codigos)
                                                 ->with('nombresData', $nombres);
    }

    public function form(prestacion $prestacion = null)
    {
        $prestacion = $prestacion ?: new Prestacion;
        return view('backend.prestaciones.form')->with('prestacion', $prestacion);
    }

    public function post(PrestacionRequest $request, prestacion $prestacion)
    {
        $prestacion = Prestacion::withTrashed()->firstOrNew(['id' => $request->get('id')]);
        if (!$prestacion->exists) {
            $this->validate($request,array(
                'codigo' => 'required|unique:prestaciones',
                'nombre' => 'required|unique:prestaciones',
            ));    
        }else{
            $prestacionNombre = Prestacion::withTrashed()->pluck('nombre', 'id')->toArray();
            foreach($prestacionNombre as $entityId => $entityValue){
                if($entityId != $request->get('id') && $entityValue == $request->get('nombre')){
                    $this->validate($request,array(
                        'nombre' => 'required|unique:prestaciones',
                    ));  
                }
            }
            $prestacionCodigo = Prestacion::withTrashed()->pluck('codigo', 'id')->toArray();
            foreach($prestacionCodigo as $entityId => $entityValue){
                if($entityId != $request->get('id') && $entityValue == $request->get('codigo')){
                    $this->validate($request,array(
                        'codigo' => 'required|unique:prestaciones',
                    ));  
                }
            }
        }
        $prestacion->id = $request->get('id');
        $prestacion->codigo = $request->get('codigo');
        $prestacion->nombre = $request->get('nombre');
        if($request->get('fonasa') == 0){
            $prestacion->valor_1 = null;
            $prestacion->valor_2 = null;
            $prestacion->valor_3 = null;
        }else{
            $prestacion->valor_1 = $request->get('valor_1');
            $prestacion->valor_2 = $request->get('valor_2');
            $prestacion->valor_3 = $request->get('valor_3');
        }

        $prestacion->save();

        return redirect()->route('prestaciones.index')->with('success','Registro editado satisfactoriamente');
    }

    public function delete(prestacion $prestacion)
    {
        $prestacion->delete();

        return redirect()->back();
    }

    public function restore($prestacionId)
    {
        $prestacion = Prestacion::withTrashed()->find($prestacionId);
        $prestacion->restore();
        
        return redirect()->back();
    }

    public function forceDelete($prestacionId)
    {
        $prestacion = Prestacion::withTrashed()->find($prestacionId);
        $prestacion->forceDelete();
    
        return redirect()->back();
    }
}