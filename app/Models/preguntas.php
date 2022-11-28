<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class preguntas extends Model
{
    protected $table='preguntas';
    
    protected $primaryKey='cod_pregunta';

    public $timestamps=false;

    protected $fillable = [
        'pregunta',
        'respuesta', 
        'estado', 
        'usr_registro',
    ];

    protected $guarded =[
    ];
}
