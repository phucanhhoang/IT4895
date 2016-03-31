<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('book_id')->unsigned();
            $table->foreign('book_id')->references('id')->on('book');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customer');
            $table->integer('review')->unsigned();
            $table->text('comment');
            $table->date('review_date');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('review');
    }
}
