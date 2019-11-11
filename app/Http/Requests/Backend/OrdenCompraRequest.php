<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Descuento;
use App\Contrato;

class OrdenCompraRequest extends FormRequest
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

            'numeroLicitacion' =>'required',
            'numeroOrdenCompra' =>'required',
            'fecha_envio'=>'required',
            'total' => ['required', new Descuento]
            
        ];
    }

 /*    public function withValidator($validator){
        $validator->after(function($validator){
            $Contrato = Contrato::where('id', $ordenCompra->contrato_id)->value('precio');
            if($Contrato - $ordenCompra->total < 0 ){
                $validator->errors()->add('total',"El monto excede el total del contrato");
            }
        });
    } */

    public function messages()
    {
        return [
            
            'numeroLicitacion.required' =>'Campo Número Licitación es obigatorio',
            'numeroOrdenCompra.required' => 'Campo Número Orden de Compra es obligatorio',
            'fecha_envio.required'=>'Campo Fecha de Envío es obligatorio',
            'total.required' => 'Campo total es obligatorio',            
        ];
    }
}
