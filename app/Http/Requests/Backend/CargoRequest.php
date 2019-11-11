<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CargoRequest extends FormRequest
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
            'nombre' => 'required|unique:cargos',

        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Campo Nombre es obligatorio',
            'nombre.unique' => 'El cargo ingresado ya existe en el sistema',
            
        ];
    }
}
