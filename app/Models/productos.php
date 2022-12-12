<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productos extends Model
{
    protected $table='articulo';

    protected $primaryKey='idarticulo';

    public $timestamps=false;

    protected $fillable =[
        'idcategoria',
        'nombre',
        'precio_producto',
        'stock',
        'tip_medida',
        'descripcion',
        'usr_registro',
        'estado',
        'fec_registro',
    ];
   
    protected $guarded =[
   
    ];

    public function kardex()
    {
        return $this->hasOne('App\Models\kardex', 'cod_kardex', 'movimiento', 'cant', 'usr_registro', 'fecha_registro');
    }
}
