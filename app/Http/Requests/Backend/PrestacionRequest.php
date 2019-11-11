<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class PrestacionRequest extends FormRequest
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
            'codigo' => 'required:prestaciones',
            'nombre' => 'required:prestaciones',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Campo Nombre es obligatorio',
            'codigo.required' => 'Campo Código es obligatorio',
        ];
    }
    
}
