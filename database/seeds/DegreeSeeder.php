<?php

use Illuminate\Database\Seeder;
use App\Degree;
use App\User;

class DegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coord = User::all();
        foreach($coord as $coor):
            if($coor->hasRole('Coordinador') == true):
                $id = $coor->id;
                break;
            endif;
        endforeach;
        
        $degree = new Degree();
        $degree->card_id = "AAAAAAAAA123";
        $degree->rvoe = "AAAAAAAAA123";
        $degree->degree_name = "Carrera1";
        $degree->semesters = 6;
        $degree->description = "Descripción de carrera1";
        $degree->mode = "Licenciatura";
        $degree->user_id = $id;

        $degree->save();
    }
}
