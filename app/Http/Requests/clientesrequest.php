<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class clientesrequest extends FormRequest
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
            'Nombre'=>'required',
            'Nombre2'=>'required',
            'Apellido'=>'required',
            'Apellido2'=>'required',
            'DNI'=>'unique:cliente,dni',
            'Genero'=>'required',
        ];
    }
}
