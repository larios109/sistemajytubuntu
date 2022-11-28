<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class direcciones extends Model
{
    protected $table='direcciones';
    
    protected $primaryKey='cod_direccion';

    public $timestamps=false;

    protected $fillable = [
        'cod_persona',
        'ref_direccion', 
        'departamento_id', 
        'municipio_id',
        'usr_registro',
    ];

    protected $guarded =[
    ];
}
