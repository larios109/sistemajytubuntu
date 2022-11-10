<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class persona extends Model
{
    protected $table='persona';
    
    protected $primaryKey='cod_persona';

    public $timestamps=false;

    protected $fillable = [
        'primer_nom',
        'segund_nom', 
        'primer_apellido', 
        'segund_apellido',
        'tipo_persona',
        'dni', 
        'genero', 
        'fecha_nacimiento', 
        'usr_registro',
    ];

    protected $guarded =[
    ];
}
