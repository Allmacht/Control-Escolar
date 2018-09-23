<?php

use Illuminate\Database\Seeder;

use App\office;
use App\User;

class officeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::whereActive('1')->get();
        foreach ($users as $user):
            if($user->hasRole('Administrador')):
                $id = $user->id;
                break;
            endif;
        endforeach;

        $office = new office();
        $office->card_id = "AAAAAAAAA123";
        $office->name = "sucursal1";
        $office->country = "country1";
        $office->state = "state1";
        $office->municipality = "municipio1";
        $office->street = "calle1";
        $office->external_number ="111";
        $office->internal_number ="111";
        $office->zipcode = "11111";
        $office->user_id = $id;

        $office->save();

    }
}
