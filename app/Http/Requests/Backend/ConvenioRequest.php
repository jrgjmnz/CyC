<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ConvenioRequest extends FormRequest
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
            'proveedor_id' => 'required:contratos',
            'licitacion' => 'required:contratos',
            'fecha_inicio' => 'date|required:contratos',
            'fecha_termino' => 'date|required:contratos',
            'objeto_contrato' => 'required:contratos',
        ];
    }

    public function messages()
    {
        return [
            'proveedor_id.required' => 'Campo Proveedor es obligatorio',
            'licitacion.required' => 'Campo Licitacion es obligatorio',
            'fecha_inicio.required' => 'Campo Fecha de inicio es obligatorio',
            'fecha_termino.required' => 'Campo Fecha de término es obligatorio',
            'objeto_contrato.required' => 'Campo Objeto del Contrato es obligatorio',
        ];
    }
}
