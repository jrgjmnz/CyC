<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Prestacion;
use App\Convenio;
use App\Http\Requests\Backend\SeleccionarPrestacionesRequest;

class seleccionarPrestacionesController extends Controller
{
    public function index(Request $request, $convenio_id)
    {  
        $prestaciones = Prestacion::withTrashed();
        
        if ($request->has('codigo') && $request->get('codigo') != null) {
            $prestaciones = $prestaciones->where('codigo', 'like', '%'.$request->get('codigo').'%')
                                         ->orWhere('nombre', 'like', '%'.$request->get('codigo').'%');
        }else{
            $prestaciones = $prestaciones->where('codigo', '=', '9999999999999999999999');
        }

        $prestaciones = $prestaciones->paginate(15);
        return view('backend.seleccionarPrestaciones.index', ['convenio' => Convenio::withTrashed()->findOrFail($convenio_id)])
                                                 ->with('prestacionesData', $prestaciones);
    }
}