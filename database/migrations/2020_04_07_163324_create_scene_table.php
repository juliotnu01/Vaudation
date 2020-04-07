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
            $table->longText('dialogue_scene')->nullable();
            $table->longText('dimensioning_scene')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
