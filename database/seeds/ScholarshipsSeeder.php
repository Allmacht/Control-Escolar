<?php

use Illuminate\Database\Seeder;
Use App\Scholarship;

class ScholarshipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $scholar = new Scholarship();
        
        $scholar->name = 'Beca 1';
        $scholar->description = 'Descripcion de beca 1';

        $scholar->save();

        $scholar1 = new Scholarship();
        
        $scholar1->name = 'Beca 2';
        $scholar1->description = 'Descripcion de beca 2';

        $scholar1->save();
    }
}
