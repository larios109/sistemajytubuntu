<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class solicitudpedido extends Model
{
    protected $table='venta';

    protected $primaryKey='idventa';

    public $timestamps=false;

    protected $fillable =[
     'cod_persona',
     'fecha_hora',
     'impuesto',
     'total_venta',
     'estado',
     'usr_registro',
    ];
    protected $guarded =[
    ];
}