<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class HitoContratoRequest extends FormRequest
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
            'nombre' => 'required:hito_contrato',
            'fecha_alerta' => 'required|date:hito_contrato',
            'fecha_hito' => 'required|date:hito_contrato',
            'contrato_id' => 'numeric:hito_contrato',
        ];
    }
}
