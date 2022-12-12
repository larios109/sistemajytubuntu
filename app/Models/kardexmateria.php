<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kardexmateria extends Model
{
    protected $table = 'kardex_materia';
    
    protected $primaryKey = 'cod_kardex_materia';

    public $timestamps=false;

    protected $fillable = ['cod_materia_e', 'movimiento', 'cant', 'usr_registro', 'fecha_registro',];
    protected $guarded =[
    ];
}