<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asigned', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id')->unsigned();
            $table->bigInteger('teacher_id')->unsigned();
            $table->bigInteger('course_id')->unsigned()->nullable();
            $table->bigInteger('particular_id')->unsigned()->nullable();
            $table->string('type');
            $table->foreign('client_id')->references('id')->on('client');
            $table->foreign('teacher_id')->references('id')->on('teacher');
            $table->foreign('course_id')->references('id')->on('course');
            $table->foreign('particular_id')->references('id')->on('particular');
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
        Schema::dropIfExists('asigned');
    }
}
