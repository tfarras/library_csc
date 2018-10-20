<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Beneficiar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('beneficiar',function (Blueprint $table){
            $table->increments('id');
            $table->string('fist_name');
            $table->string('last_name');
            $table->integer('study_year');
            $table->string('address');
            $table->string('idnp');
            $table->string('tel_number');
            $table->string('email');
            $table->date('birthday');
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
        //
        Schema::dropIfExists('beneficiar');
    }
}
