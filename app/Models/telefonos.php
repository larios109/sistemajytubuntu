<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class telefonos extends Model
{
    protected $table='telefonos';
    
    protected $primaryKey='cod_telefono';

    public $timestamps=false;

    protected $fillable = [
        'cod_persona',
        'tip_telefono', 
        'telefono', 
        'usr_registro',
        'fec_registro',
    ];

    protected $guarded =[
    ];
}
