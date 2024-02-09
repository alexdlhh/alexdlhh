<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticularTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('particular', function (Blueprint $table) {
            $table->id();
            $table->integer('teacher_id')->nullable();
            $table->string('name');
            $table->string('description');
            $table->date('date');
            $table->time('time_start');
            $table->time('time_end');
            $table->string('status');
            $table->string('max_students');
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
        Schema::dropIfExists('particular');
    }
}
