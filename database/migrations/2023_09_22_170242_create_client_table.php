<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('dni');
            $table->string('address');
            $table->string('email');
            $table->string('phone');
            $table->string('height');
            $table->string('weight');
            $table->string('shoe_size')->nullable();
            $table->string('ski_level')->nullable();
            $table->string('snow_level')->nullable();
            $table->string('snow_front')->nullable();
            $table->string('birthdate')->nullable();
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
        Schema::dropIfExists('client');
    }
}
