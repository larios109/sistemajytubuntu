<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bitacora extends Model
{
    protected $table = 'bitacora';
    
    protected $primaryKey = 'cod_operacion';

    public $timestamps=false;

    protected $fillable = ['usr','tabla','evento', 'fecha_registro', 'campo_1'];
    protected $guarded =[
    ];
}
