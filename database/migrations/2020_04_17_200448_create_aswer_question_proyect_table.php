<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAswerQuestionProyectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aswer_question_proyect', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('question_proyect_id')->unsigned()->nullable();
            $table->foreign('question_proyect_id')->references('id')->on('question_proyect');
            $table->bigInteger('aswer_id')->unsigned()->nullable();
            $table->foreign('aswer_id')->references('id')->on('aswers');
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
        Schema::dropIfExists('aswer_question_proyect');
    }
}
