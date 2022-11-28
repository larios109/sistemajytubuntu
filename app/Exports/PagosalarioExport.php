<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\pagosalario;
use App\Models\colaboradores;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PagosalarioExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('empleados.pagosalario.plantilla', [
            'colaboradores' => DB::table('colaboradores as c')
            ->join('persona as p','c.cod_persona','=','p.cod_persona')
            ->select('c.cod_empleado', 'c.sueldo_bruto', 'p.primer_nom', 'p.segund_nom', 'p.primer_apellido', 'p.segund_apellido', 'p.dni')
            ->where('c.estado', '=', '1')
            ->get()
        ]);
    }

    public function columnWidths(): array
    {
        return [
      
        ];
    }
}
