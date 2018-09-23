<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
            'users',
            'scholarships',
            'roles',
            'permissions',
            'role_has_permissions',
            'model_has_roles',
            'degrees',
            'offices'

        ]);
        // $this->call(UsersTableSeeder::class);
        $this->call(ScholarshipsSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(officeSeeder::class);
        $this->call(DegreeSeeder::class);
        
       
        
    }
    protected function truncateTables(array $tables){

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        
        foreach($tables as $table):
            DB::table($table)->truncate();
        endforeach;

         DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); 
    }
}
