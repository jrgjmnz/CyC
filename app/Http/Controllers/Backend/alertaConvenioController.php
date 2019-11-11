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

class alertaConvenioController extends Controller
{
    public function index(Request $request)
    {
        $convenios = Convenio::withTrashed();

        $convenios = $convenios->where('estado_alerta', '=', 'resuelto')
                                ->orWhere('estado_alerta', '=', null);

        $convenios = $convenios->paginate(10);
        return view('backend.alertaConvenio.index')->with('conveniosData', $convenios);
    }

    public function mostrarTodos(Request $request)
    {
        $convenios = Convenio::withTrashed();

        $convenios = $convenios->paginate(9999999);
        return view('backend.alertaConvenio.index')->with('conveniosData', $convenios);
    }

    public function resolverConvenio(Convenio $convenio)
    {
        $convenio = Convenio::withTrashed()->firstOrNew(['id' => $convenio->id]);
        $convenio->estado_alerta = 'resuelto';
        $convenio->save();

        $hito_convenio = HitoConvenio::query();
        $hito_convenio = $hito_convenio->where('convenio_id', '=', $convenio->id);
        $hito_convenio = $hito_convenio->where('estado_alerta', '=', null);

        if(strlen($hito_convenio->get()) <= 2){
            //no tiene hitos, se revisa alerta boleta:
            $boleta_convenio = Boleta::query();
            $boleta_convenio = $boleta_convenio->where('id', '=', $convenio->boleta_id);
            $boleta_convenio = $boleta_convenio->where('estado_alerta', '=', null);
            //revisar si tiene alerta de boleta:
            $boleta = Boleta::withTrashed()->firstOrNew(['id' => $convenio->boleta_id]);

            if(strlen($boleta_convenio->get()) <= 2 || $boleta->alerta_vencimiento == null){
                //si la boleta está resuelta o no tenía alerta, cambiar todo a visto.
                $convenio = Convenio::withTrashed()->firstOrNew(['id' => $convenio->id]);
                $convenio->estado_alerta = 'visto';
                $convenio->save();

                $boleta = Boleta::withTrashed()->firstOrNew(['id' => $convenio->boleta_id]);
                $boleta->estado_alerta = 'visto';
                $boleta->save();
            }
        }

        return redirect()->back();
    }

    public function resolverBoletaConvenio(Convenio $convenio)
    {
        $boleta = Boleta::withTrashed()->firstOrNew(['id' => $convenio->boleta_id]);
        $boleta->estado_alerta = 'resuelto';
        $boleta->save();

        $hito_convenio = HitoConvenio::query();
        $hito_convenio = $hito_convenio->where('convenio_id', '=', $convenio->id);
        $hito_convenio = $hito_convenio->where('estado_alerta', '=', null);

        if(strlen($hito_convenio->get()) <= 2){
            //no tiene hitos, se revisa alerta convenio:
            $convenioEstado = Convenio::query();
            $convenioEstado = $convenioEstado->where('id', '=', $convenio->id);
            $convenioEstado = $convenioEstado->where('estado_alerta', '=', null);

            $convenioAlerta = Convenio::withTrashed()->firstOrNew(['id' => $convenio->id]);

            if(strlen($convenioEstado->get()) <= 2 || $convenioAlerta->alerta_vencimiento == null){
                //si el convenio está resuelto o no tenía alerta, cambiar todo a visto.
                $convenioEstado = Convenio::withTrashed()->firstOrNew(['id' => $convenio->id]);
                $convenioEstado->estado_alerta = 'visto';
                $convenioEstado->save();

                $boleta = Boleta::withTrashed()->firstOrNew(['id' => $convenio->boleta_id]);
                $boleta->estado_alerta = 'visto';
                $boleta->save();
            }
        }

        return redirect()->back();
    }

    public function recuperarConvenio(Convenio $convenio)
    {
        $convenio = Convenio::withTrashed()->firstOrNew(['id' => $convenio->id]);
        $convenio->estado_alerta = null;
        $convenio->save();

        $boleta = Boleta::withTrashed()->firstOrNew(['id' => $convenio->boleta_id]);
        $boleta->estado_alerta = null;
        $boleta->save();

        return redirect()->back();
    }

    public function recuperarBoletaConvenio(Convenio $convenio)
    {
        $convenio = Convenio::withTrashed()->firstOrNew(['id' => $convenio->id]);
        $convenio->estado_alerta = null;
        $convenio->save();

        $boleta = Boleta::withTrashed()->firstOrNew(['id' => $convenio->boleta_id]);
        $boleta->estado_alerta = null;
        $boleta->save();

        return redirect()->back();
    }
}
