<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublisherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publisher', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200);
            $table->string('country', 30);
            $table->text('short_intro')->nullable();
            $table->boolean('deleted');
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
        Schema::drop('publisher');
    }
}
