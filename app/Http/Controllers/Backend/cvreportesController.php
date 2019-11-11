<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Convenio;
use App\Proveedor;
use App\Moneda;
use App\Cargo;
use App\Boleta;
use App\HitoContrato;
use App\Prestacion;
use App\ConvenioPrestacion;
use App\Exports\ReportesConvenioExport;
use Maatwebsite\Excel\Facades\Excel;

class cvreportesController extends Controller
{
    public function index(Request $request)
    {
        $convenios = Convenio::withTrashed();
        $proveedores = Proveedor::withTrashed()->pluck('rut', 'id')->toArray();
        $licitaciones = Convenio::withTrashed()->pluck('licitacion', 'id')->toArray();
        
        $objetos = Convenio::withTrashed()->pluck('objeto_contrato', 'id')->toArray();
        $razonSocial = Proveedor::withTrashed()->pluck('razon_social', 'id')->toArray();
        
        $prestaciones = Prestacion::withTrashed()->pluck('codigo', 'id')->toArray();

        if ($request->has('licitaciones') && $request->get('licitaciones') != null) {
			$convenios = $convenios->where('id', '=', $request->get('licitaciones'));
        }

        if ($request->has('nombres_admin') && $request->get('nombres_admin') != null) {
			$convenios = $convenios->where('id', '=', $request->get('nombres_admin'));
        }

        if ($request->has('objetos') && $request->get('objetos') != null) {
			$convenios = $convenios->where('id', '=', $request->get('objetos'));
        }

        if ($request->has('razonSocial') && $request->get('razonSocial') != null) {
			$convenios = $convenios->where('proveedor_id', '=', $request->get('razonSocial'));
        }

        if ($request->has('proveedores') && $request->get('proveedores') != null) {
            $convenios = $convenios->where('proveedor_id', '=', $request->get('proveedores'));
        }
        
        if ($request->has('prestacion') && $request->get('prestacion') != null) {
            $convenios = $convenios->join('convenio_prestacion', 'convenio_prestacion.convenio_id', '=', 'convenios.id')
                                    ->where('prestacion_id', '=', $request->get('prestacion'))
                                    ;
        }

        $convenios = $convenios->paginate(10);
        return view('backend.cvreportes.index')->with('conveniosData', $convenios)
                                              ->with('proveedoresData', $proveedores)
                                              ->with('licitacionesData', $licitaciones)
                                              ->with('objetosData', $objetos)
                                              ->with('razonSocialData', $razonSocial)
                                              ->with('prestacionesData', $prestaciones);
    }

    public function export()
    {
        return Excel::download(new ReportesConvenioExport, 'ReportesConvenio.xlsx');
    }

}
