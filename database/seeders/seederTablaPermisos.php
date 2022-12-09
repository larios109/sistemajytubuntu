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
            //tabla personas
            'visualizar personas',
            'Registrar persona',
            'editar persona',
            'editar estado persona',

            //tabla colaboradores
            'visualizar Colaboradores',
            'Registrar Colaborador',
            'editar Colaborador',
            'editar estado colaborador',
                        
            //tabla pago salario
            'visualizar pago salario',
            'Registrar pago salario',
            'editar pago salario',
            'editar estado pago',

            //tabla materia entrante
            'visualizar materia entrante',
            'Registrar materia entrante',
            'editar materia entrante',
            'editar estado materia',
            
            //tabla materia saliente
            'visualizar materia saliente',
            'Registrar materia saliente',
            'editar materia saliente',
            'borrar materia saliente',

            //tabla categoria productos
            'visualizar categorias',
            'Registrar categoria',
            'editar categoria',
            'editar estado categoria',

            //tabla productos
            'visualizar productos',
            'Registrar producto',
            'editar producto',
            'editar estado producto',

            //tabla kardex
            'visualizar kardex',
            'Registrar kardex',
            'editar kardex',

            //tabla otros insumos
            'visualizar otros insumos',
            'Registrar otros insumos',
            'editar otros insumos',
            'editar estado insumos',

            //tabla solicitud pedidos
            'visualizar solicitud pedidos',
            'Registrar solicitud',
            'Editar estado solicitud',
            'visualizar detalle solicitud pedidos',

            //tabla bitacora
            'visualizar bitacora',

            //tabla roles
            'visualizar roles',
            'crear rol',
            'editar rol',
            'borrar rol',

            //tabla preguntas
            'visualizar preguntas',
            'crear pregunta',
            'editar pregunta',
            'editar estado preguntas',

            //tabla backup
            'visualizar backup',
            'crear backup',
            'borrar backup',

            //tabla usuario
            'visualizar usuarios',
            'crear usuario',
            'editar usuario',
            'borrar usuario',
        ];
        foreach($permisos as $permiso){
            Permission::create(['name'=>$permiso]);
        }
    }
}
