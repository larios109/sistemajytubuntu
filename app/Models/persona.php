<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class persona extends Model
{
    protected $table='persona';
    
    protected $primaryKey='cod_persona';

    public $timestamps=false;

    protected $fillable = [
        'primer_nom',
        'segund_nom', 
        'primer_apellido', 
        'segund_apellido',
        'dni', 
        'genero', 
        'tipo_persona',
        'estado', 
        'usr_registro',
        'fecha_registro',
    ];

    protected $guarded =[
    ];

    public function telefonos()
    {
        return $this->hasOne('App\Models\telefonos', 'cod_telefono', 'cod_persona', 'tip_telefono', 'telefono');
    }

    public function correo()
    {
        return $this->hasOne('App\Models\correo', 'cod_correo', 'cod_persona', 'correo');
    }

    public function direccion()
    {
        return $this->hasOne('App\Models\direcciones', 'cod_direccion', 'cod_persona', 'ref_direccion', 'departamento_id', 'municipio_id');
    }
}
