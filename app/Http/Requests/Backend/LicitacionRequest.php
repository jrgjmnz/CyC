<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class LicitacionRequest extends FormRequest
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
            //'id' => 'required:id',
            'nro_licitacion' => 'required:nro_licitacion|unique:licitaciones',            
        ];
    }

    public function messages()
    {
        return [
            'nro_licitacion.required' => 'Número de licitación es obligatorio',
            'nro_licitacion.unique' => 'El ID de licitación ya existe en el sistema',
        ];
    }
}