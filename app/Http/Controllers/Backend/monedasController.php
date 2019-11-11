<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Moneda;
use App\Http\Requests\Backend\MonedaRequest;

class monedasController extends Controller
{
    public function index(Request $request)
    {
        $monedas = Moneda::withTrashed();
        $tipos = \App\Moneda::withTrashed()->pluck('nombre', 'id')->toArray();

        if ($request->has('tipo') && $request->get('tipo') != null ) {
			$monedas = $monedas->where('id', '=', $request->get('tipo'));
        }

        $monedas = $monedas->paginate(10);
        return view('backend.monedas.index')->with('monedasData', $monedas)->with('tiposData', $tipos);
    }

    public function form(Moneda $moneda = null)
    {
        $moneda = $moneda ?: new Moneda;
        return view('backend.monedas.form')->with('moneda', $moneda);
    }

    public function post(MonedaRequest $request, Moneda $moneda)
    {
        $moneda = Moneda::withTrashed()->firstOrNew(['id' => $request->get('id')]);

        if (!$moneda->exists) {
            $this->validate($request,array(
                'nombre' => 'required|unique:monedas',
                'codigo' => 'required|unique:monedas',
                'factor_conversion' => 'required:monedas',
            ));    
        }else{
            $monedaNombre = Moneda::withTrashed()->pluck('nombre', 'id')->toArray();
            foreach($monedaNombre as $entityId => $entityValue){
                if($entityId != $request->get('id') && $entityValue == $request->get('nombre')){
                    $this->validate($request,array(
                        'nombre' => 'required|unique:monedas',
                        'factor_conversion' => 'required:monedas',
                    ));  
                }
            }
            $monedaCodigo = Moneda::withTrashed()->pluck('codigo', 'id')->toArray();
            foreach($monedaCodigo as $entityId => $entityValue){
                if($entityId != $request->get('id') && $entityValue == $request->get('codigo')){
                    $this->validate($request,array(
                        'codigo' => 'required|unique:monedas',
                        'factor_conversion' => 'required:monedas',
                    ));  
                }
            }
        }
        $moneda->id = $request->get('id');
        $moneda->codigo = $request->get('codigo');
        $moneda->nombre = $request->get('nombre');
        $moneda->factor_conversion = $request->get('factor_conversion');

        $moneda->save();

        return redirect()->route('monedas.index')->with('success','Registro editado satisfactoriamente');
    }

    public function delete(Moneda $moneda)
    {
        $moneda->delete();

        return redirect()->back();
    }

    public function restore($monedaId)
    {
        $moneda = Moneda::withTrashed()->find($monedaId);
        $moneda->restore();
        
        return redirect()->back();
    }

    public function forceDelete($monedaId)
    {
        $moneda = Moneda::withTrashed()->find($monedaId);
        $moneda->forceDelete();
    
        return redirect()->back();
    }
}