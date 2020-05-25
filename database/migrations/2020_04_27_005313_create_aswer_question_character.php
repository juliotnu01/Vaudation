<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAswerQuestionCharacter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aswer_question_character', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('aswer_id')->unsigned()->nullable();
            $table->foreign('aswer_id')->references('id')->on('aswers');
            $table->bigInteger('question_character_id')->unsigned()->nullable();
            $table->foreign('question_character_id')->references('id')->on('question_character');
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
        Schema::dropIfExists('aswer_question_character');
    }
}
