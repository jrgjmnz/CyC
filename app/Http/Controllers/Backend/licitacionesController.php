<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Licitacion;
use App\Http\Requests\Backend\LicitacionRequest;

class licitacionesController extends Controller
{
    public function index(Request $request)
    {
        $licitacion = Licitacion::withTrashed();
        $nroLicitacion = Licitacion::withTrashed()->pluck('nro_licitacion', 'id')->toArray();

              

        if ($request->has('nro_licitacion') && $request->get('nro_licitacion') !=null) {
            
            $licitacion = $licitacion->where('nro_licitacion', '=', $request->get('nro_licitacion'));
        }

        $licitacion= $licitacion->paginate(10);
        return view('backend.licitaciones.index')->with('licitacionData', $licitacion)
                                                 ->with('nro_licitacionData', $nroLicitacion);
                                                
    }

    public function form(Licitacion $licitacion = null)
    {
        $licitacion = $licitacion ?: new Licitacion;
        $nroLicitacion = \App\Licitacion::withTrashed()->pluck('nro_licitacion');        
       
        return view('backend.licitaciones.form')->with('licitacionData', $licitacion)
                                                ->with('nro_licitacionData', $nroLicitacion);

    }

    public function post(LicitacionRequest $request, Licitacion $licitacion)
    {
        error_log('--------------------------------------ENTRANDO A POST--------------------------------------');
        $licitacion = Licitacion::withTrashed()->firstOrNew(['id' => $request->get('id')]);
        $licitacion->id = $request->get('id');
        $licitacion->nro_licitacion = $request->get('nro_licitacion');
        $licitacion->save();
        error_log('--------------------------------------ENVIANDO A INDEX--------------------------------------');
        return redirect()->route('licitaciones.index');
    }

    public function delete(Licitacion $licitacion)
    {
        $licitacion->delete();

        return redirect()->back;
    }

    public function restore($licitacion)
    {
        $licitacion = Licitacion::withTrashed()->find($licitacion);
        $licitacion->restore();

        return redirect()->back;
    }

    public function forceDelete($licitacion)
    {
        $licitacion = Licitacion::withTrashed()->find($licitacion);
        $licitacion->forceDelete();

        return redirect()->back();
    }

}
