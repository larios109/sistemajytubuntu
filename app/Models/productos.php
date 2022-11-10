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
        'descripcion',
        'usr_registro',
       ];
   
       protected $guarded =[
   
       ];
}
