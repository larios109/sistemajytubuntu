<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class productorequest extends FormRequest
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
            'idcategoria'=>'required',
            'nombre'=>'required|unique:articulo,nombre',
            'precio_producto'=>'required|numeric|max:100',
            'stock'=>'required|numeric',
            'descripcion'=>'required',
        ];
    }
}
