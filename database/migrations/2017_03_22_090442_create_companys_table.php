<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Name');
            $table->string('Cert')->nullable();
            $table->string('Pin')->nullable();
            $table->string('Email')->unique();
            $table->string('Password');
            $table->string('Location')->nullable();
            $table->string('Box');
            $table->string('Phone')->unique();
            $table->string('Landline')->nullable();
            $table->string('FirstName')->nullable();
            $table->string('SecondName')->nullable();
            $table->string('LastName')->nullable();
            $table->string('Position')->nullable(); 
            $table->string('Code');
            $table->rememberToken();
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
         Schema::drop('companys');
    }
}
