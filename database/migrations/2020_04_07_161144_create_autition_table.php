<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutitionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autition', function (Blueprint $table) {
            $table->id();
            $table->longText('title_autition')->nullable();
            $table->longText('description_autition')->nullable();
            $table->longText('banner_autition')->nullable();
            $table->longText('script_attached_autition')->nullable();
            $table->longText('script_text_autition')->nullable();
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
        Schema::dropIfExists('autition');
    }
}
