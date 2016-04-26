<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('payment', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('name', 100);
        // });

        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customer');
            $table->string('note', 500);
            $table->string('ship_time', 41);
            $table->boolean('shipped')->default(0);
            $table->boolean('seen')->default(0);
            $table->boolean('deleted');
            // $table->integer('total_price')->unsigned();
            // $table->tinyInteger('payment')->unsigned();
            // $table->foreign('payment')->references('id')->on('payment');
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
        // Schema::drop('payment');
        Schema::drop('order');
    }
}
