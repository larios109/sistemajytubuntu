<?php

namespace App\Imports;

use App\Models\pagosalario;
use Illuminate\Support\Facades\auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithValidation;

class PagosalarioImport implements ToModel, WithHeadingRow, WithCalculatedFormulas, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new pagosalario([
            'cod_empleado'  => $row['codigo'],
            'sueldo_bruto' => $row['sueldo_bruto'],
            'IHSS'    => $row['ihss'],
            'RAP'  => $row['rap'],
            'otras_deducciones' => $row['otras_deducciones'],
            'vacaciones'    => $row['vacaciones'],
            'descripcion_vacaciones'    => $row['descripcion_vacaciones'],
            'periodo_pago' => $row['periodo_pago'],
            'salario'    => $row['sueldo'],
            'estado'    => 1,
            'usr_registro'    => auth()->user()->name,
            'fecha_registro'    => now(),
        ]);
    }

    public function rules(): array
    {
        return [
            '*.codigo' => ['integer', 'required'],
            '*.sueldo_bruto' => ['numeric', 'required'],
            '*.ihss' => ['numeric', 'required'],
            '*.rap' => ['numeric', 'required'],
            '*.otras_deducciones' => ['numeric', 'required'],
            '*.vacaciones' => ['numeric', 'required'],
            '*.descripcion_vacaciones' => ['string', 'required'],
            '*.periodo_pago' => ['string', 'required'],
            '*.sueldo' => ['numeric', 'required'],
        ];
    }
}
