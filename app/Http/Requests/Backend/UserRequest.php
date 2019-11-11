<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class UserRequest extends FormRequest
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
            'nombre' => 'required:users',
            'apellidos' => 'required:users',
            'rol' => 'required:users',
            'email' => 'required|email:users',
            'password' => 'required|same:password2',
            'password2' => 'required:users',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Campo email es obligatorio',
            'email.unique' => 'El email ingresado ya existe en el sistema',
            'nombre.required' => 'Campo nombre es obligatorio',
            'apellidos.required' => 'Campo apellidos es obligatorio',
            'rol.required' => 'Campo rol es obligatorio',
            'password.required' => 'Campo contraseña es obligatorio',
            'password2.required' => 'Confirme contraseña',
            'password.same' => 'Las contraseñas no coinciden',
        ];
    }
}
