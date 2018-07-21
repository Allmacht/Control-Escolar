<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = new Permission();
        $permission->name = 'Crear';
        $permission->save();

        $permission2 = new Permission();
        $permission2->name = 'Editar';        
        $permission2->save();

        $permission3 = new Permission();
        $permission3->name = 'Ver';
        $permission3->save();

        $permission4 = new Permission();
        $permission4->name = 'Eliminar';        
        $permission4->save();

    }
}
