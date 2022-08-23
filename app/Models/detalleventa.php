<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalleventa extends Model
{
    protected $fillable = ['cod_venta','nombre_producto','cantidad','precio_venta','impuesto_sobre_venta','subtotal'];
}
