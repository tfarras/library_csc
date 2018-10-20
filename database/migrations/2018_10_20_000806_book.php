<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Book extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('books',function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->integer('author_id');
            $table->integer('edition_id');
            $table->date('publication_year');
            $table->string('code');
            $table->integer('category_id');
            $table->integer('status_id');
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
        Schema::dropIfExists('books');
    }
}
