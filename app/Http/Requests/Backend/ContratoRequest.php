<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ContratoRequest extends FormRequest
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
            'moneda_id' => 'required:contratos',
            'precio' => 'required|numeric:contratos',
            'cargo_id' => 'required:contratos',            
            'fecha_inicio' => 'date|required:contratos',
            'fecha_termino' => 'date|required:contratos',
            'fecha_aprobacion' => 'date|required:contratos',
            'objeto_contrato' => 'required:contratos',
            'selectContrato' => 'required:contratos',
        ];
    }

    public function messages()
    {
        return [
            'proveedor_id.required' => 'Campo Proveedor es obligatorio',
            'licitacion.required' => 'Campo Licitacion es obligatorio',
            'moneda_id.required' => 'Campo Moneda es obligatorio',
            'precio.required' => 'Campo Precio es obligatorio',
            'cargo_id.required' => 'Campo Cargo es obligatorio',            
            'fecha_inicio.required' => 'Campo Fecha de inicio es obligatorio',
            'fecha_termino.required' => 'Campo Fecha de Termino es obligatorio',
            'fecha_aprobacion.required' => 'Campo Fecha de Aprobación es obligatorio',
            'alerta_vencimiento.required' => 'Campo Alerta de Vencimiento es obligatorio',
            'objeto_contrato.required' => 'Campo Objeto del Contrato es obligatorio',
            'boleta_id.required' => 'Campo N° de Boleta es obligatorio',
            
        ];
    }
}
