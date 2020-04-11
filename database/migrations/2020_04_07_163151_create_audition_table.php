<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audition', function (Blueprint $table) {
            $table->id();
            $table->longText('title_audition')->nullable();
            $table->longText('description_audition')->nullable();
            $table->longText('banner_audition')->nullable();
            $table->longText('script_attached_audition')->nullable();
            $table->longText('script_text_audition')->nullable();
            $table->date('end_date_available')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users');

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
        Schema::dropIfExists('audition');
    }
}
