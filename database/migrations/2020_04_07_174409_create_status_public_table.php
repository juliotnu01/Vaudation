<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusPublicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_public', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->nullable();
            $table->bigInteger('id_audition')->unsigned()->nullable();
            $table->bigInteger('id_scene')->unsigned()->nullable();
            
            $table->foreign('id_audition')->references('id')->on('audition');
            $table->foreign('id_scene')->references('id')->on('scene');
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
        Schema::dropIfExists('status_public');
    }
}
