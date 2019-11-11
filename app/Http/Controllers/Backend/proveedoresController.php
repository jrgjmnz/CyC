<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Proveedor;
use App\Http\Requests\Backend\ProveedorRequest;

class proveedoresController extends Controller
{
    public function index(Request $request)
    {
        $proveedores = Proveedor::withTrashed();
        $ruts = Proveedor::withTrashed()->pluck('rut', 'id')->toArray();
        $nombres = Proveedor::withTrashed()->pluck('razon_social', 'id')->toArray();
        $ubicaciones = Proveedor::withTrashed()->pluck('ubicacion', 'id')->toArray();

        if ($request->has('rut')&& $request->get('rut') != null) {
			$proveedores = $proveedores->where('id', '=', $request->get('rut'));
        }
        if ($request->has('razon_social')&& $request->get('razon_social') != null) {
			$proveedores = $proveedores->where('razon_social', '=', $request->get('razon_social'));
        }
        if ($request->has('ubicacion')&& $request->get('ubicacion') != null) {
			$proveedores = $proveedores->where('ubicacion', '=', $request->get('ubicacion'));
        }

        $proveedores = $proveedores->paginate(10);
        return view('backend.proveedores.index')->with('proveedoresData', $proveedores)
                                                ->with('rutData', $ruts)
                                                ->with('nombresData', $nombres)
                                                ->with('ubicacionesData', $ubicaciones);
    }
    public function form(Proveedor $proveedor = null)
    {
        $proveedor = $proveedor ?: new Proveedor;
        return view('backend.proveedores.form')->with('proveedor', $proveedor);
    }

    public function post(ProveedorRequest $request, Proveedor $proveedor)
    {
        $proveedor = Proveedor::withTrashed()->firstOrNew(['id' => $request->get('id')]);
        if (!$proveedor->exists) {
            $this->validate($request,array(
                'rut' => 'required:proveedores',
                'razon_social' => 'required:proveedores',
            ));    
        }else{
            $proveedorNombre = Proveedor::withTrashed()->pluck('rut', 'id')->toArray();
            foreach($proveedorNombre as $entityId => $entityValue){
                if($entityId != $request->get('id') && $entityValue == $request->get('rut')){
                    $this->validate($request,array(
                        'rut' => 'required|unique:proveedores',
                    ));  
                }
            }
            $proveedorRazon_social = Proveedor::withTrashed()->pluck('razon_social', 'id')->toArray();
            foreach($proveedorRazon_social as $entityId => $entityValue){
                if($entityId != $request->get('id') && $entityValue == $request->get('razon_social')){
                    $this->validate($request,array(
                        'razon_social' => 'required|unique:proveedores',
                    ));  
                }
            }
        }

        $proveedor->id = $request->get('id');
        $proveedor->rut = $request->get('rut');
        $proveedor->razon_social = $request->get('razon_social');
        $proveedor->ubicacion = $request->get('ubicacion');

        $proveedor->save();

        return redirect()->route('proveedores.index')->with('success','Registro editado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     
    public function delete(Proveedor $proveedor)
    {
        $proveedor->delete();

        return redirect()->back();
    }

    public function restore($proveedorId)
    {
        $proveedor = Proveedor::withTrashed()->find($proveedorId);
        $proveedor->restore();
        
        return redirect()->back();
    }

    public function forceDelete($proveedorId)
    {
        $proveedor = Proveedor::withTrashed()->find($proveedorId);
        $proveedor->forceDelete();
        
        return redirect()->back();
    } 
}
