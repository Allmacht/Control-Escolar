<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create([
            'name'=>'Administrador'
        ]);
        $role1->givePermissionTo('Crear');
        $role1->givePermissionTo('Editar');
        $role1->givePermissionTo('Ver');
        $role1->givePermissionTo('Eliminar');
        
        $role2 = Role::create([
            'name' => 'Coordinador'
        ]);

        $role2->givePermissionTo('Crear');
        $role2->givePermissionTo('Editar');
        $role2->givePermissionTo('Ver');
        $role2->givePermissionTo('Eliminar');

        $role3 = Role::create([
            'name' => 'Alumno'
        ]);

        $role3->givePermissionTo('Crear');
        $role3->givePermissionTo('Editar');
        $role3->givePermissionTo('Ver');
        $role3->givePermissionTo('Eliminar');

        $role4 = Role::create([
            'name' => 'Docente'
        ]);

        $role4->givePermissionTo('Crear');
        $role4->givePermissionTo('Editar');
        $role4->givePermissionTo('Ver');
        $role4->givePermissionTo('Eliminar');

        $role5 = Role::create([
            'name' => 'Estandar'
        ]);
    }
}
