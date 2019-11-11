<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Prestacion;
use App\Convenio;
use App\Proveedor;
use App\ConvenioPrestacion;
use App\Http\Requests\Backend\ConvenioPrestacionesRequest;

class convenioPrestacionesController extends Controller
{
    public function index(Request $request, $convenio_id)
    {  
        $cPrestaciones = ConvenioPrestacion::withTrashed();
        $razon_social = Proveedor::withTrashed()->pluck('razon_social', 'id')->toArray();
        $convenios = Convenio::withTrashed()->pluck('proveedor_id', 'id')->toArray();
        $codigos = Prestacion::withTrashed()->pluck('codigo', 'id')->toArray();
        $nombres = Prestacion::withTrashed()->pluck('nombre', 'id')->toArray();

        $cPrestaciones = $cPrestaciones->where('convenio_id', '=', $convenio_id);

        if ($request->has('codigo') && $request->get('codigo') != null) {
            $cPrestaciones = $cPrestaciones->join('prestaciones','convenio_prestacion.prestacion_id','=','prestaciones.id');
			$cPrestaciones = $cPrestaciones->where('codigo', '=', $request->get('codigo'));
        }
        if ($request->has('nombre') && $request->get('nombre') != null) {
            if($request->get('codigo') == null){
                $cPrestaciones = $cPrestaciones->join('prestaciones','convenio_prestacion.prestacion_id','=','prestaciones.id');
                $cPrestaciones = $cPrestaciones->where('nombre', 'like', $request->get('nombre'));
            }else{
                $cPrestaciones = $cPrestaciones->where('nombre', 'like', $request->get('nombre'));
            }
        }
    
        $cPrestaciones = $cPrestaciones->paginate(15);
        return view('backend.convenioPrestaciones.index', ['convenio' => Convenio::withTrashed()->findOrFail($convenio_id)])
                                                 ->with('cPrestacionesData', $cPrestaciones)
                                                 ->with('razon_socialData', $razon_social)
                                                 ->with('conveniosData', $convenios)
                                                 ->with('codigosData', $codigos)
                                                 ->with('nombresData', $nombres);
    }

    public function form(ConvenioPrestacion $cPrestacion , $convenio_id, $prestacion_id)
    {
        $cPrestacion = $cPrestacion ?: new ConvenioPrestacion;

        $razon_social = Proveedor::withTrashed()->pluck('razon_social', 'id')->toArray();
        $convenios = Convenio::withTrashed()->pluck('proveedor_id', 'id')->toArray();

        return view('backend.convenioPrestaciones.form', ['convenio' => Convenio::withTrashed()->findOrFail($convenio_id)], ['prestacion' => Prestacion::withTrashed()->findOrFail($prestacion_id)])
                                                ->with('cPrestacion', $cPrestacion)
                                                ->with('razon_socialData', $razon_social)
                                                ->with('conveniosData', $convenios);
    }

    public function post(ConvenioPrestacionesRequest $request, ConvenioPrestacion $cPrestacion, $convenio_id, $prestacion_id)
    {
        $cPrestacion = ConvenioPrestacion::withTrashed()->firstOrNew(['id' => $request->get('id')]);
        
        //validar
        $cPrestacion->id = $request->get('id');
        $cPrestacion->convenio_id = $convenio_id;
        $cPrestacion->prestacion_id = $prestacion_id;
        $cPrestacion->valor_seleccionado = $request->get('valor_seleccionado');
        $cPrestacion->factor = $request->get('factor');
        $cPrestacion->valor_total = $request->get('precio_total');

        $cPrestacion->save();

        return redirect()->route('convenioPrestaciones.index', ['convenio' => Convenio::withTrashed()->findOrFail($convenio_id)]);
    }

    public function delete(ConvenioPrestacion $cPrestacion)
    {
        $cPrestacion->delete();

        return redirect()->back();
    }

    public function restore($cPrestacionId)
    {
        $cPrestacion = ConvenioPrestacion::withTrashed()->find($cPrestacionId);
        $cPrestacion->restore();
        
        return redirect()->back();
    }

    public function forceDelete($cPrestacionId)
    {
        $cPrestacion = ConvenioPrestacion::withTrashed()->find($cPrestacionId);
        $cPrestacion->forceDelete();
    
        return redirect()->back();
    }
}
