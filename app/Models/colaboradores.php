<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class colaboradores extends Model
{
    protected $table = 'colaboradores';
    
    protected $primaryKey = 'cod_empleado';

    public $timestamps=false;

    protected $fillable = ['cod_persona', 'sueldo_bruto', 'fecha_registro', 'fecha_salida', 'motivo_salida', 'usr_registro'];
    protected $guarded =[
    ];
}