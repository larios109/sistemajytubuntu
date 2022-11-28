<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materiasaliente extends Model
{
    protected $table='materia_prima_saliente';
    
    protected $primaryKey='cod_materia_s';

    public $timestamps=false;

    protected $fillable = [
        'cod_materia_e',
        'descripcion_s', 
        'cant_saliente', 
    ];

    protected $guarded =[
    ];
}
