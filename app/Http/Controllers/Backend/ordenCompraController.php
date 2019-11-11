<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OrdenCompra;
use App\Contrato;
use View;
use App\Exports\OrdenesCompraExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\Backend\OrdenCompraRequest;


class ordenCompraController extends Controller
{
    public function index(Request $request)
    {
        $ordenCompra = OrdenCompra::withTrashed();
        $numeroOrden = OrdenCompra::withTrashed()->pluck('id')->toArray();
        $numeroOrden2 = OrdenCompra::withTrashed()->pluck('numero_orden_compra')->toArray();
        $licitaciones = Contrato::withTrashed()->pluck('licitacion_id', 'id')->toArray();
        
        $estado = OrdenCompra::withTrashed()->pluck('estado')->toArray();
        
        //****** */

        if ($request->has('numeroLicitacion') && $request->get('numeroLicitacion') !=null) {
            //dd($request->get('numeroLicitacion'));
            $ordenCompra = $ordenCompra->where('numero_licitacion', '=', $request->get('numeroLicitacion'));
        }

        if ($request->has('estado') && $request->get('estado') !=null) {
            $ordenCompra = $ordenCompra->where('estado', '=', $request->get('estado'));
        }

        if ($request->has('numeroOrden') && $request->get('numeroOrden')!=null) {
            $ordenCompra = $ordenCompra->where('numero_orden_compra', '=', $request->get('numeroOrden'));
        }
        //****** */
    
        $ordenCompra = $ordenCompra->paginate(10);
        return view('backend.ordenCompra.index')->with('ordenCompraData', $ordenCompra)
                                                ->with('licitacionesData', $licitaciones)
                                                ->with('numeroOrdenData', $numeroOrden)
                                                
                                                ->with('numeroOrdenesData', $numeroOrden2)
                                                ->with('estadoData', $estado);
    }

    public function export()
    {
        return Excel::download(new OrdenesCompraExport, 'OrdenesCompra.xlsx');
    }

    public function form(OrdenCompra $ordenCompra = null){
        $ordenCompra = $ordenCompra ?: new OrdenCompra;
        $contratos = Contrato::withTrashed()->pluck('licitacion_id', 'id', 'precio');
        return view('backend.ordenCompra.form')->with('ordenCompraData', $ordenCompra)
                                               ->with('contratos', $contratos);
    }

    public function post(OrdenCompraRequest $request, OrdenCompra $ordenCompra)
    {
        
        $ordenCompra = OrdenCompra::withTrashed()->firstOrNew(['id' => $request->get('id')]);
         //$ordenCompra->id = $request->get('id'); 
        $ordenCompra->contrato_id = $request->get('numeroLicitacion');
        $ordenCompra->numero_licitacion = $request->get('numeroLicitacion');
        $ordenCompra->numero_orden_compra = $request->get('numeroOrdenCompra');
        $ordenCompra->fecha_envio = $request->get('fecha_envio');
        $ordenCompra->total = $request->get('total');
        $ordenCompra->estado = $request->get('estado');
        
       
        //**** */
        //$usuario=Auth()->user()->id;        
        //$ordenCompra->usuario_id=$usuario;
        

        $Contrato = Contrato::where('id', $ordenCompra->contrato_id)->first();
        $diferencial = Contrato::where('id', $ordenCompra->contrato_id)->value('diferencial');
        if ($diferencial - $ordenCompra->total < 0 ) {
            return redirect()->route('ordenCompra.form')->with('total', "El monto excede el total diferencial");
        } else {
            $ordenCompra->save();
            $Contrato->diferencial -= $ordenCompra->total;
            $Contrato->save();
            return redirect()->route('ordenCompra.index')->with('success','Registro editado satisfactoriamente');
        }
        
        



    }

    public function delete(OrdenCompra $ordenCompra)
    {
        $ordenCompra->delete();
        return redirect()->back();

    }

    public function restore($numeroOrden)
    {
        $ordenCompra = OrdenCompra::withTrashed()->find($numeroOrden);
        $ordenCompra->restore();
        return redirect()->back();

    }
    

    public function forceDelete($numeroOrden)
    {
        $ordenCompra = OrdenCompra::withTrashed()->find($numeroOrden);
        $ordenCompra->forceDelete();
        return redirect()->back();

        
    }

    
}
