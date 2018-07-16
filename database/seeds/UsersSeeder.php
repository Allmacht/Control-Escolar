<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'names' => 'Admin',
            'email' => 'ulises.jacob.cr@gmail.com',
            'password' => bcrypt('admin'),
            'maternal_surname' => 'Admin',
            'paternal_surname' => 'admin',
            'gender' => 'M',
            'birthdate' => '1999-12-30',
            'curp' => 'AAAAAAAAAAAAAAAAAA',
            'state' => 'state1',
            'municipality' => 'munic1',
            'colony' => 'colony1',
            'street' => 'street1',
            'number' => '1234',
            'zipcode' => '123456',
            'cellphone' => '4441000000',
            'contact_name' => 'admin',
            'contact_number' => '4441000000',
            'allergy' => '0',
            'controlled_medication' => '0',
            
        ]);
    }
}
