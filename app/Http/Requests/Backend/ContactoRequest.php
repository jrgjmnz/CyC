<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ContactoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required:contacto_proveedores',
            'telefono' => 'required:contacto_proveedores',
            'email' => 'required|email:contacto_proveedores',
            'direccion_postal' => 'required:contacto_proveedores',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Campo email es obligatorio',
            'telefono.required' => 'Campo telefono es obligatorio',
            'email.unique' => 'El email ingresado ya existe en el sistema',
            'direccion_postal.required' => 'Campo direccion postal es obligatorio',
        ];
    }
}