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
            'name' => 'Admin',
            'names' =>'admin admin',
            'email' => 'ulises.jacob.cr@gmail.com',
            'nip' => '1234',
            'card_id' => 'AAAAAAAAAA123',
            'password' => bcrypt('admin'),
            'maternal_surname' => 'Admin',
            'paternal_surname' => 'admin',
            'gender' => 'masculino',
            'birthdate' => '1999-12-30',
            'curp' => 'AAAAAAAAAAAAAAAAAA',
            'state' => 'state1',
            'municipality' => 'munic1',
            'colony' => 'colony1',
            'street' => 'street1',
            'external_number' => '1234',
            'internal_number' => '5',
            'zipcode' => '12345',
            'cellphone' => '4441000000',
            'local_phone' => '8210000',
            'professional_license' => '12345678',
            'contact_name' => 'admin contact',
            'contact_number' => '4441000000',
            'allergy' => '0',
            'allergy_description' => 'allergy1',
            'controlled_medication' => '0',
            'medication_description' => 'medication1',
            'rfc' => 'AAAA999999AAA'
            
        ]);
        User::create([
            'name' => 'Admin1',
            'names' =>'admin admin',
            'email' => 'ulises.cr@gmail.com',
            'nip' => '1235',
            'card_id' => 'AAAAAAAAAA133',
            'password' => bcrypt('admin'),
            'maternal_surname' => 'Admin',
            'paternal_surname' => 'admin',
            'gender' => 'masculino',
            'birthdate' => '1999-12-30',
            'curp' => 'AAAAAAAAAAAAAAAAAB',
            'state' => 'state1',
            'municipality' => 'munic1',
            'colony' => 'colony1',
            'street' => 'street1',
            'external_number' => '1234',
            'internal_number' => '5',
            'zipcode' => '12345',
            'cellphone' => '4441000001',
            'local_phone' => '8210001',
            'professional_license' => '12315678',
            'contact_name' => 'admin contact',
            'contact_number' => '4441000000',
            'allergy' => '1',
            'allergy_description' => 'allergy1',
            'controlled_medication' => '1',
            'medication_description' => 'medication1',
            'rfc' => 'AAAA999999BAA'
            
        ]);
    }
}
