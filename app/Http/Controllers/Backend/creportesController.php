<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Contrato;
use App\Proveedor;
use App\Moneda;
use App\Cargo;
use App\Boleta;
use App\HitoContrato;
use App\Exports\ReportesContratoExport;
use Maatwebsite\Excel\Facades\Excel;

class creportesController extends Controller
{
    public function index(Request $request)
    {
        $contratos = Contrato::withTrashed();
        $proveedores = Proveedor::withTrashed()->pluck('rut', 'id')->toArray();
        $licitaciones = Contrato::withTrashed()->pluck('licitacion_id', 'id')->toArray();
        //$nombres_admin = Contrato::withTrashed()->pluck('nombre_admin_tecnico', 'id')->toArray();
        $objetos = Contrato::withTrashed()->pluck('objeto_contrato', 'id')->toArray();
        $razonSocial = Proveedor::withTrashed()->pluck('razon_social', 'id')->toArray();

        if ($request->has('proveedores') && $request->get('proveedores') != null) {
			$contratos = $contratos->where('proveedor_id', '=', $request->get('proveedores'));
        }

        if ($request->has('licitaciones') && $request->get('licitaciones') != null) {
			$contratos = $contratos->where('id', '=', $request->get('licitaciones'));
        }

        if ($request->has('nombres_admin') && $request->get('nombres_admin') != null) {
			$contratos = $contratos->where('id', '=', $request->get('nombres_admin'));
        }

        if ($request->has('objetos') && $request->get('objetos') != null) {
			$contratos = $contratos->where('id', '=', $request->get('objetos'));
        }

        if ($request->has('razonSocial') && $request->get('razonSocial') != null) {
			$contratos = $contratos->where('proveedor_id', '=', $request->get('razonSocial'));
        }

       
        $contratos = $contratos->paginate(10);
        return view('backend.creportes.index')->with('contratosData', $contratos)
                                              ->with('proveedoresData', $proveedores)
                                              ->with('licitacionesData', $licitaciones)
                                              //->with('nombres_adminData', $nombres_admin)
                                              ->with('objetosData', $objetos)
                                              ->with('razonSocialData', $razonSocial);
    }

    public function export()
    {
        return Excel::download(new ReportesContratoExport, 'ReporteContrato.xlsx');
    }

}

