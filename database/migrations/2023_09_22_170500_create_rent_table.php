<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('client_id')->unsigned();
            $table->date('date');
            $table->time('time_start');
            $table->time('time_end');
            $table->string('status');
            $table->string('price');
            $table->foreign('product_id')->references('id')->on('product');
            $table->foreign('client_id')->references('id')->on('client');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rent');
    }
}
