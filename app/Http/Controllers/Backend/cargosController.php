<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Cargo;
use App\Http\Requests\Backend\CargoRequest;

class cargosController extends Controller
{
    public function index(Request $request)
    {
        $cargos = Cargo::withTrashed();
        $tipos = \App\Cargo::withTrashed()->pluck('nombre', 'id')->toArray();

        if ($request->has('tipo') && $request->get('tipo') != null) {
			$cargos = $cargos->where('id', '=', $request->get('tipo'));
        }

        $cargos = $cargos->paginate(10);
        return view('backend.cargos.index')->with('cargosData', $cargos)->with('tiposData', $tipos);
    }

    public function form(Cargo $cargo = null)
    {
        $cargo = $cargo ?: new Cargo;
        return view('backend.cargos.form')->with('cargo', $cargo);
    }

    public function post(CargoRequest $request, Cargo $cargo)
    {
        $cargo = Cargo::withTrashed()->firstOrNew(['id' => $request->get('id')]);
        $cargo->id = $request->get('id');
		$cargo->nombre = $request->get('nombre');

        $cargo->save();

        if($cargo->save()){
            return redirect()->route('cargos.index')->with('success','Registro editado satisfactoriamente');
        }
        else{
            return redirect()->route('cargos.index')->with('error','Error al guardar los datos');
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     
    public function delete(Cargo $cargo)
    {
        $cargo->delete();

        return redirect()->back()->with('delete','Registro eliminado');
    }

    public function restore($cargoId)
    {
        $cargo = Cargo::withTrashed()->find($cargoId);
        $cargo->restore();
        
        return redirect()->back();
    }

    public function forceDelete($cargoId)
    {
        $cargo = Cargo::withTrashed()->find($cargoId);
        $cargo->forceDelete();
        
        return redirect()->back();
    } 
}