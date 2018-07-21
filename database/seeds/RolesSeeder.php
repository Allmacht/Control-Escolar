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
        $role = new Role();
        $role->name = 'Administrador';
        $role->guard_name = 'Web';
        $role->save();

        $role2 = new Role();
        $role2->name = 'Coordinador';
        $role2->guard_name = 'Web';
        $role2->save();

        $role3 = new Role();
        $role3->name = 'Maestro';
        $role3->guard_name = 'Web';
        $role3->save();

        $role4 = new Role();
        $role4->name = 'Alumno';
        $role4->guard_name = 'Web';
        $role4->save();

        
    }
}
