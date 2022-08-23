<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario=User::create([
            'name'=>'Super Admin',
            'email'=>'superadmin@gmail.com',
            'password'=>bcrypt('admin12345')
        ]);

    $rol=Role::create(['name'=>'Administrador']);

    $permisos=Permission::pluck('id','id')->all();

    $rol->syncPermissions($permisos);

    $usuario->assingRole('Administrador');
    }
}
