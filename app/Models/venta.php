<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class venta extends Model
{
    protected $fillable = ['name','cliente_nombre','fecha_creacion'];
}
