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
        
    }
}
