<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSceneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scene', function (Blueprint $table) {
            $table->id();
            $table->longText('act_scene')->nullable();
            $table->longText('numbre_scene')->nullable();
            $table->longText('scene_direction')->nullable();
            $table->longText('character_scene')->nullable();
            $table->longText('descripction_character_scene')->nullable();
            $table->longText('dialogue_scene')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->bigInteger('id_audition')->unsigned()->nullable();
            $table->foreign('id_audition')->references('id')->on('audition');
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
        Schema::dropIfExists('scene');
    }
}
