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
            'borrar persona',

            //tabla direccion
            'visualizar direcciones',
            'Registrar direccion',
            'editar direccion',
            'borrar direccion',

            //tabla correos
            'visualizar correos',
            'Registrar correo',
            'editar correo',
            'borrar correo',
            
            //tabla telefonos
            'visualizar telefonos',
            'Registrar telefono',
            'editar telefono',
            'borrar telefono',

            //tabla usuarios
            'visualizar Colaboradores',
            'Registrar Colaborador',
            'editar Colaborador',
            'borrar Colaborador',
                        
            //tabla pago salario
            'visualizar pago salario',
            'Registrar pago salario',
            'editar pago salario',
            'borrar pago salario',

            //tabla materia entrante
            'visualizar materia entrante',
            'Registrar materia entrante',
            'editar materia entrante',
            'borrar materia entrante',
            
            //tabla materia saliente
            'visualizar materia saliente',
            'Registrar materia saliente',
            'editar materia saliente',
            'borrar materia saliente',

            //tabla categoria productos
            'visualizar categorias',
            'Registrar categoria',
            'editar categoria',
            'borrar categoria',

            //tabla productos
            'visualizar productos',
            'Registrar producto',
            'editar producto',
            'borrar producto',

            //tabla otros insumos
            'visualizar otros insumos',
            'Registrar otros insumos',
            'editar otros insumos',
            'borrar otros insumos',

            //tabla solicitud pedidos
            'visualizar solicitud pedidos',
            'Registrar solicitud',
            'borrar solicitud',
            'visualizar detalle solicitud pedidos',

            //Modulo Reportes
            'visualizar reportes',

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
            'borrar pregunta',

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
