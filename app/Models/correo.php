<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class correo extends Model
{
    protected $table='correos';
    
    protected $primaryKey='cod_correo';

    public $timestamps=false;

    protected $fillable = [
        'cod_persona',
        'correo', 
        'usr_registro', 
        'fec_registro',
    ];

    protected $guarded =[
    ];
}
