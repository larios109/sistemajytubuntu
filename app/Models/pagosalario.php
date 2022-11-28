<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pagosalario extends Model
{
    protected $table='pago_salario';
    
    protected $primaryKey='cod_pago';

    public $timestamps=false;

    protected $fillable = [
        'cod_empleado',
        'sueldo_bruto', 
        'IHSS', 
        'RAP', 
        'otras_deducciones', 
        'vacaciones', 
        'descripcion_vacaciones', 
        'salario', 
        'usr_registro',
        'fecha_registro',
    ];

    protected $guarded =[
    ];
}
