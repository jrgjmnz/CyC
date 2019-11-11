<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class AlertaContratoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required:hito_contrato',
            'fecha_alerta' => 'nullable:hito_contrato',
            'alerta' => 'required:hito_contrato',
            'contrato_id' => 'numeric:hito_contrato',
        ];
    }

    public function messages()
    {
        return [
            'numero.required' => 'Campo nombre de boleta es obligatorio',
            'fecha_alerta.required' => 'Campo fecha de la alerta es obligatorio',
            'alerta.required' => 'Campo alerta es obligatorio',
            'contrato_id.required' => 'Campo licitación es obligatorio',
        ];
    }
}

