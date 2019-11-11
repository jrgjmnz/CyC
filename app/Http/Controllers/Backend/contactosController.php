<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Contacto;
use App\Proveedor;
use App\Http\Requests\Backend\ContactoRequest;
use App\Http\Requests\Backend\ProveedorRequest;

class contactosController extends Controller
{
    public function index(Request $request, $proveedor_id)
    {
        $contactos = Contacto::withTrashed();
        $nombres = Contacto::withTrashed()->pluck('nombre', 'id')->toArray();
        $telefonos = Contacto::withTrashed()->pluck('telefono', 'id')->toArray();
        $emails = Contacto::withTrashed()->pluck('email', 'id')->toArray();
        $direcciones = Contacto::withTrashed()->pluck('direccion_postal', 'id')->toArray();

        if ($request->has('nombre') && $request->get('nombre') != null) {
			$contactos = $contactos->where('nombre', '=', $request->get('nombre'));
        }
        if ($request->has('telefono') && $request->get('telefono') != null) {
			$contactos = $contactos->where('telefono', 'like', $request->get('telefono'));
        }
        if ($request->has('email') && $request->get('email') != null) {
			$contactos = $contactos->where('email', '=', $request->get('email'));
        }
        if ($request->has('direccion_postal') && $request->get('direccion_postal') != null) {
			$contactos = $contactos->where('direccion_postal', 'like', $request->get('direccion_postal'));
        }

        function mostrar(){
            $id_cargo = Auth::user()->cargo_id;
            $data['data'] = DB::table('contratos')->where('cargo_id','=',$id_cargo)->first();
            if(count($data) > 0 ){
                return view('contratos.index',compact('data'));
            }else{
                return view('contratos.index');
            }
        }

        $contactos = $contactos->paginate(10);
        return view('backend.contactos.index', ['proveedor' => Proveedor::withTrashed()->findOrFail($proveedor_id)])
                                                ->with('contactosData', $contactos)
                                                ->with('nombresData', $nombres)
                                                ->with('telefonosData', $telefonos)
                                                ->with('emailsData', $emails)
                                                ->with('direccionesData', $direcciones);


    }

    public function form(Contacto $contacto , $proveedor_id)
    {
        $contacto = $contacto ?: new Contacto;
        return view('backend.contactos.form', ['proveedor' => Proveedor::withTrashed()->findOrFail($proveedor_id)])->with('contacto', $contacto);
    }

    public function post(ContactoRequest $request, Contacto $contacto, $proveedor_id)
    {
        $contacto = Contacto::withTrashed()->firstOrNew(['id' => $request->get('id')]);
        if (!$contacto->exists) {
            $this->validate($request,array(
                'telefono' => 'required|unique:contacto_proveedores',
                'email' => 'required|email|unique:contacto_proveedores',
            ));    
        }else{
            $contactoTelefono = Contacto::withTrashed()->pluck('telefono', 'id')->toArray();
            foreach($contactoTelefono as $entityId => $entityValue){
                if($entityId != $request->get('id') && $entityValue == $request->get('telefono')){
                    $this->validate($request,array(
                        'telefono' => 'required|unique:contacto_proveedores',
                    ));  
                }
            }
            $contactoEmail = Contacto::withTrashed()->pluck('email', 'id')->toArray();
            foreach($contactoEmail as $entityId => $entityValue){
                if($entityId != $request->get('id') && $entityValue == $request->get('email')){
                    $this->validate($request,array(
                        'email' => 'required|email|unique:contacto_proveedores',
                    ));  
                }
            }
        }
        $contacto->id = $request->get('id');
        $contacto->nombre = $request->get('nombre');
        $contacto->telefono = $request->get('telefono');
        $contacto->email = $request->get('email');
        $contacto->direccion_postal = $request->get('direccion_postal');
        $contacto->proveedor_id = $proveedor_id;

        $contacto->save();

        return redirect()->route('contactos.index', ['proveedor' => Proveedor::findOrFail($proveedor_id)])->with('success','Registro editado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     
    public function delete(Contacto $contacto)
    {
        $contacto->delete();

        return redirect()->back();
    }

    public function restore($contactoId)
    {
        $contacto = Contacto::withTrashed()->find($contactoId);
        $contacto->restore();
        
        return redirect()->back();
    }

    public function forceDelete($contactoId)
    {
        $contacto = Contacto::withTrashed()->find($contactoId);
        $contacto->forceDelete();
        
        return redirect()->back();
    } 
}
