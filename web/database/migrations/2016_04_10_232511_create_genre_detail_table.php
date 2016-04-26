<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenreDetailTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genre_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->integer('genre_id')->unsigned();
            $table->foreign('genre_id')->references('id')->on('genre');
            $table->boolean('deleted');
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
    }

}
