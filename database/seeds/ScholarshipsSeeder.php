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
        $scholar->level = 'Universidad';
        $scholar->provider = 'Proveedor1';

        $scholar->save();

        $scholar1 = new Scholarship();
        
        $scholar1->name = 'Beca 2';
        $scholar1->description = 'Descripcion de beca 2';
        $scholar1->level = 'Preparatoria';
        $scholar1->provider = 'Proveedor1';

        $scholar1->save();
    }
}
