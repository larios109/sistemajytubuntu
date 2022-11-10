<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detallesolicitudpedido extends Model
{
    protected $table='detalle_venta';

    protected $primaryKey='iddetalle_venta';

    public $timestamps=false;

    protected $fillable =[
     'idventa',
     'idarticulo',
     'cantidad',
     'precio_venta',
    ];
    protected $guarded =[
    ];
}