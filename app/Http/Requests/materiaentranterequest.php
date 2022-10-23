<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class materiaentranterequest extends FormRequest
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
            'Materia'=>'required|unique:materia_prima_entrante,nom_materia',
            'Descripcion'=>'required',
            'Medida'=>'required',
            'Precio'=>'required',
            'cantidad'=>'required',
            'caducidad'=>'required',
        ];
    }
}
