<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class otrosinsumos extends Model
{
    protected $table='otros_insumos';
    
    protected $primaryKey='cod_insumos';

    public $timestamps=false;

    protected $fillable = [
        'insumo',
        'descripcion', 
        'precio', 
        'cant', 
        'tip_medida', 
        'estado', 
        'fecha_registro', 
        'usr_registro', 
    ];

    protected $guarded =[
    ];
}
