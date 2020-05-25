<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character', function (Blueprint $table) {
            $table->id();
            $table->longText('character_name')->nullable();
            $table->longText('description_character')->nullable();
            $table->longText('script_attached_audition')->nullable();
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
        Schema::dropIfExists('character');
    }
}
