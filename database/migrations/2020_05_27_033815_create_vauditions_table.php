<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVauditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vauditions', function (Blueprint $table) {
            $table->id();
            $table->string('url_video_redsocial')->nullable();
            $table->string('type_redsocial')->nullable();
            $table->string('url_video_upload')->nullable();
            $table->string('title_url_video_upload')->nullable();
            
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('vauditions');
    }
}
