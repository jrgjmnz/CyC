<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class MonedaRequest extends FormRequest
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
            'nombre' => 'required:monedas',
            'codigo' => 'required:monedas',
            'factor_conversion' => 'required:monedas',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Campo Nombre es obligatorio',
            'nombre.unique' => 'La Moneda ingresada ya existe en el sistema',
            'codigo.required' => 'Campo Código es obligatorio',
            'codigo.unique' => 'La Código ingresada ya existe en el sistema',
            'factor_conversion.required' => 'Campo Factor Converión es obligatorio',
        ];
    }
}
