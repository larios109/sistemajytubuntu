<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//spatie
use Spatie\Permission\Models\Permission;

class seederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos=[
            //tabla roles
            'ver->rol',
            'crear->rol',
            'editar->rol',
            'borrar->rol',

            //tabla bitacora
            'ver->bitacora',

            //tabla correos
            'ver->correo',
            'crear->correo',
            'editar->correo',
            'borrar->correo',

            //tabla telefonos
            'ver->telefonos',
            'crear->telefonos',
            'editar->telefonos',
            'borrar->telefonos',

            //tabla ventas
            'ver->venta',
            'crear->venta',
            'editar->venta',
            'borrar->venta',

            //tabla detalle ventas
            'ver->detalleventa',
            'crear->detalleventa',
            'editar->detalleventa',
            'borrar->detalleventa',

            //tabla materia entrante
            'ver->materiaentrante',
            'crear->materiaentrante',
            'editar->materiaentrante',
            'borrar->materiaentrante',

            //tabla materia entrante
            'ver->materiasaliente',
            'crear->materiasaliente',
            'editar->materiasaliente',
            'borrar->materiasaliente',

            //tabla materia entrante
            'ver->otrosinsumos',
            'crear->otrosinsumos',
            'editar->otrosinsumos',
            'borrar->otrosinsumos',

            //tabla lista productos
            'ver->listaproductos',
            'crear->listaproductos',
            'editar->listaproductos',
            'borrar->listaproductos',

            //tabla inventario
            'ver->inventario',
            'crear->inventario',
            'editar->inventario',
            'borrar->inventario',

            //tabla clientes
            'ver->cliente',
            'crear->cliente',
            'editar->cliente',
            'borrar->cliente',

            //tabla direccion
            'ver->direccion',
            'crear->direccion',
            'editar->direccion',
            'borrar->direccion',

            //tabla compania
            'ver->compania',
            'crear->compania',
            'editar->compania',
            'borrar->compania',

            //tabla usuarios
            'ver->usuarios',
            'crear->usuarios',
            'editar->usuarios',
            'borrar->usuarios',

            //tabla pago salario
            'ver->pagosalario',
            'crear->pagosalario',
            'editar->pagosalario',
            'borrar->pagosalario',

            //tabla categoria productos
            'ver->categoria',
            'crear->categoria',
            'editar->categoria',
            'borrar->categoria',

            //tabla personas
            'ver->personas',
            'crear->personas',
            'editar->personas',
            'borrar->personas',

            //tabla preguntas
            'ver->preguntas',
            'crear->preguntas',
            'editar->preguntas',
            'borrar->preguntas',

            //Modulo Reportes
            'ver->reportes',
        ];
        foreach($permisos as $permiso){
            Permission::create(['name'=>$permiso]);
        }
    }
}
