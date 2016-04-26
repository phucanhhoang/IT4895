<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('author_id')->unsigned();
            $table->foreign('author_id')->references('id')->on('author');
            $table->integer('publisher_id')->unsigned();
            $table->foreign('publisher_id')->references('id')->on('publisher');
            $table->integer('genre_id')->unsigned();
            $table->foreign('genre_id')->references('id')->on('genre');
            $table->string('image', 200);
            $table->string('isbn', 13);
            $table->text('description_short');
            $table->text('description');
            $table->integer('price')->unsigned();
            $table->tinyInteger('sale')->unsigned();
            $table->smallInteger('quantity')->unsigned();
            $table->boolean('deleted');
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
        Schema::drop('book');
    }
}
