<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mateiraentrante extends Model
{
    protected $table='materia_prima_entrante';
    
    protected $primaryKey='cod_materia_e';

    public $timestamps=false;

    protected $fillable = [
        'nom_materia',
        'descripcion', 
        'tip_medida', 
        'pre_compra',
        'cant', 
        'fec_compra', 
        'fec_caducidad',
        'estado', 
        'usr_registro',
    ];

    protected $guarded =[
    ];

    public function kardexmateria()
    {
        return $this->hasOne('App\Models\kardexmateria', 'cod_kardex_materia', 'movimiento', 'cant', 'usr_registro', 'fecha_registro');
    }
}
