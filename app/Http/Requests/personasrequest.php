<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class personasrequest extends FormRequest
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
            'Apellido'=>'required',
            'tipo'=>'required',
            'DNI'=>'required|unique:persona,dni',
            'Genero'=>'required',
            'Telefono'=>'required',
            'tipotelefono'=>'required',
            'Correo'=>'required',
            'direccion'=>'required',
            'Departamento'=>'required',
            'Municipio'=>'required',
        ];
    }
}
