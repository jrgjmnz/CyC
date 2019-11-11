<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class BoletaRequest extends FormRequest
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
            'numero' => 'required|numeric:boletas',
            'monto' => 'required|numeric:boletas',
            'fecha_vencimiento' => 'date|required:boletas',
        ];
    }

    public function messages()
    {
        return [
            'numero.required' => 'Campo Numero de boleta es obligatorio',
            'numero.unique' => 'El Numero de Boleta ingresado ya existe en el sistema',
            'monto.required' => 'Campo Monto es obligatorio',
            'fecha_vencimiento.required' => 'Campo Fecha de Vencimiento es obligatorio',
        ];
    }
}
