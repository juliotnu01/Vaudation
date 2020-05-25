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
        Schema::create('question_character', function (Blueprint $table) {
            $table->id();
            $table->longText('question_proyect')->nullable();
            $table->longText('answer_question')->nullable();
            $table->bigInteger('character_id')->unsigned()->nullable();
            $table->foreign('character_id')->references('id')->on('character');
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
