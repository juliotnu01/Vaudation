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
            $table->boolean('status_public_audition')->nullable();
            $table->boolean('status_available_audition')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
