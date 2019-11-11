<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ConvenioPrestacionesRequest extends FormRequest
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
            'precio_total' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'precio_total.required' => 'Seleccione una opción para valor prestación',
        ];
    }
    
}
