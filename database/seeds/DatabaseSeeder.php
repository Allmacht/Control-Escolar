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

            'scholarships',
            'users'

        ]);
        // $this->call(UsersTableSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(ScholarshipsSeeder::class);


    }
    protected function truncateTables(array $tables){

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        
        foreach($tables as $table):
            DB::table($table)->truncate();
        endforeach;

         DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); 
    }
}
