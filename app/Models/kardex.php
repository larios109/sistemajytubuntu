<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kardex extends Model
{
    protected $table = 'kardex';
    
    protected $primaryKey = 'cod_kardex';

    public $timestamps=false;

    protected $fillable = ['idarticulo', 'movimiento', 'cant', 'usr_registro', 'fecha_registro',];
    protected $guarded =[
    ];
}