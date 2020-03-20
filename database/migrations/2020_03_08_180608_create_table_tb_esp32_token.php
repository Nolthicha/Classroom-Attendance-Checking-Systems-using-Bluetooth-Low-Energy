<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTbEsp32Token extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_esp32_token', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('esp32_token');
            $table->string('esp32_name');
            $table->string('room');

            $table->date('date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->time('time')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->timestamps();

            $table->foreign('room')->references('room')->on('subject')->onUpdate('cascade');


            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_esp32_token');
    }
}
