<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionProyectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_proyect', function (Blueprint $table) {
            $table->id();
            $table->longText('question_proyect')->nullable();
            $table->longText('answer_question')->nullable();
            $table->bigInteger('id_proyect')->unsigned()->nullable();
            $table->foreign('id_proyect')->references('id')->on('proyect');
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
        Schema::dropIfExists('question_proyect');
    }
}
