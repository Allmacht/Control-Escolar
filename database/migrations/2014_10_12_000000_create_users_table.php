<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nip')->nullable()->unique(); //Administrativo
            $table->string('card_id')->nullable()->unique(); //Administrativo , Docente, Mátricula
            $table->string('name')->unique(); 
            $table->string('names');
            $table->string('maternal_surname');
            $table->string('paternal_surname');
            $table->string('gender');
            $table->date('birthdate');
            $table->string('curp')->unique();
            $table->string('state');
            $table->string('municipality');
            $table->string('colony');
            $table->string('street');
            $table->string('external_number');
            $table->string('internal_number')->nullable();
            $table->integer('zipcode');
            $table->string('cellphone');
            $table->string('local_phone')->nullable();
            $table->string('professional_license')->nullable()->unique(); //Administrativo, docente
            $table->string('rfc')->nullable()->unique(); //Administrativo , docente
            $table->string('contact_name');
            $table->string('contact_number');
            $table->boolean('allergy');
            $table->string('allergy_description')->nullable();
            $table->boolean('controlled_medication');
            $table->string('medication_description')->nullable();
            $table->string('email')->unique();
            $table->string('level')->nullable(); //Estudiante
            $table->integer('semester')->nullable();
            $table->string('password');
            $table->unsignedInteger('scholarship_id')->nullable(); //Estudiante
            $table->foreign('scholarship_id')->references('id')->on('scholarships');
            $table->rememberToken();
            $table->string('profile_picture')->nullable();
            $table->boolean('active')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
