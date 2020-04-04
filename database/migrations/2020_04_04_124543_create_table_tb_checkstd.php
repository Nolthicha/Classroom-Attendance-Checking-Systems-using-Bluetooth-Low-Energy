<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTableTbCheckstd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_checkstd', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('std_id');
            $table->string('std_token');
            $table->string('std_esp32');
            //$table->unsignedBigInteger('std_subject');
            //$table->string('std_subject');
            $table->unsignedBigInteger('tb_subject');
            
            $table->date('date_ble')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->time('time')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            

            //$table->foreign('std_subject')->references('subj_id')->on('subject')->onUpdate('cascade');
            $table->foreign('std_id')->references('id')->on('tb_login');

            $table->foreign('tb_subject')->references('id')->on('subject');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_checkstd');
    }
}
