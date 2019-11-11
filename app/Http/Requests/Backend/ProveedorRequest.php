<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ProveedorRequest extends FormRequest
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
            'rut' => 'required:proveedores',
            'razon_social' => 'required:proveedores',
            'ubicacion' => 'required:proveedores',
        ];
    }

    public function messages()
    {
        return [
            'rut.required' => 'Campo RUT es obligatorio',
            'razon_social.required' => 'Campo Razón Social es obligatorio',
            'ubicacion.required' => 'Campo Ubicación es obligatorio',
            
        ];
    }
}
