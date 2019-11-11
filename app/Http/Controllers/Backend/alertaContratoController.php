<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Backend\HitoContratoRequest;

use App\Contrato;
use App\Proveedor;
use App\Moneda;
use App\Cargo;
use App\Boleta;
use App\HitoContrato;

class alertaContratoController extends Controller
{
    public function index(Request $request)
    {
        $contratos = Contrato::withTrashed();

        $contratos = $contratos->where('estado_alerta', '=', 'resuelto')
                                ->orWhere('estado_alerta', '=', null);

        $contratos = $contratos->paginate(10);
        return view('backend.alertaContrato.index')->with('contratosData', $contratos);
    }

    public function mostrarTodos(Request $request)
    {
        $contratos = Contrato::withTrashed();

        $contratos = $contratos->paginate(9999999);
        return view('backend.alertaContrato.index')->with('contratosData', $contratos);
    }

    public function resolverContrato(Contrato $contrato)
    {
        $contrato = Contrato::withTrashed()->firstOrNew(['id' => $contrato->id]);
        $contrato->estado_alerta = 'resuelto';
        $contrato->save();

        $hito_contrato = HitoContrato::query();
        $hito_contrato = $hito_contrato->where('contrato_id', '=', $contrato->id);
        $hito_contrato = $hito_contrato->where('estado_alerta', '=', null);

        if(strlen($hito_contrato->get()) <= 2){
            //no tiene hitos, se revisa alerta boleta:
            $boleta_contrato = Boleta::query();
            $boleta_contrato = $boleta_contrato->where('id', '=', $contrato->boleta_id);
            $boleta_contrato = $boleta_contrato->where('estado_alerta', '=', null);
            //revisar si tiene alerta de boleta:
            $boleta = Boleta::withTrashed()->firstOrNew(['id' => $contrato->boleta_id]);

            if(strlen($boleta_contrato->get()) <= 2 || $boleta->alerta_vencimiento == null){
                //si la boleta está resuelta o no tenía alerta, cambiar todo a visto.
                $contrato = Contrato::withTrashed()->firstOrNew(['id' => $contrato->id]);
                $contrato->estado_alerta = 'visto';
                $contrato->save();

                $boleta = Boleta::withTrashed()->firstOrNew(['id' => $contrato->boleta_id]);
                $boleta->estado_alerta = 'visto';
                $boleta->save();
            }
        }

        return redirect()->back();
    }

    public function resolverBoletaContrato(Contrato $contrato)
    {
        $boleta = Boleta::withTrashed()->firstOrNew(['id' => $contrato->boleta_id]);
        $boleta->estado_alerta = 'resuelto';
        $boleta->save();

        $hito_contrato = HitoContrato::query();
        $hito_contrato = $hito_contrato->where('contrato_id', '=', $contrato->id);
        $hito_contrato = $hito_contrato->where('estado_alerta', '=', null);

        if(strlen($hito_contrato->get()) <= 2){
            //no tiene hitos, se revisa alerta contrato:
            $contratoEstado = Contrato::query();
            $contratoEstado = $contratoEstado->where('id', '=', $contrato->id);
            $contratoEstado = $contratoEstado->where('estado_alerta', '=', null);

            $contratoAlerta = Contrato::withTrashed()->firstOrNew(['id' => $contrato->id]);

            if(strlen($contratoEstado->get()) <= 2 || $contratoAlerta->alerta_vencimiento == null){
                //si el contrato está resuelto o no tenía alerta, cambiar todo a visto.
                $contratoEstado = Contrato::withTrashed()->firstOrNew(['id' => $contrato->id]);
                $contratoEstado->estado_alerta = 'visto';
                $contratoEstado->save();

                $boleta = Boleta::withTrashed()->firstOrNew(['id' => $contrato->boleta_id]);
                $boleta->estado_alerta = 'visto';
                $boleta->save();
            }
        }

        return redirect()->back();
    }

    public function recuperarContrato(Contrato $contrato)
    {
        $contrato = Contrato::withTrashed()->firstOrNew(['id' => $contrato->id]);
        $contrato->estado_alerta = null;
        $contrato->save();

        $boleta = Boleta::withTrashed()->firstOrNew(['id' => $contrato->boleta_id]);
        $boleta->estado_alerta = null;
        $boleta->save();

        return redirect()->back();
    }

    public function recuperarBoletaContrato(Contrato $contrato)
    {
        $contrato = Contrato::withTrashed()->firstOrNew(['id' => $contrato->id]);
        $contrato->estado_alerta = null;
        $contrato->save();

        $boleta = Boleta::withTrashed()->firstOrNew(['id' => $contrato->boleta_id]);
        $boleta->estado_alerta = null;
        $boleta->save();

        return redirect()->back();
    }
}
