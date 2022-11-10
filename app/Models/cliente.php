<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    protected $table='cliente';
    
    protected $primaryKey='cod_cliente';

    public $timestamps=false;

    protected $fillable = [
        'primer_nom',
        'segund_nom', 
        'primer_apellido', 
        'segund_apellido', 
        'dni', 
        'genero', 
        'fecha_registro', 
        'usr_registro',
    ];

    protected $guarded =[
    ];
}
