<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTbCheckback extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_checkback', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('std_id');
            //$table->unsignedBigInteger('std_subject');
            //$table->string('std_subject');
            $table->unsignedBigInteger('tb_subject');

            $table->date('date_ble')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->time('time_check');

            $table->timestamps();
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
        Schema::dropIfExists('tb_checkback');
    }
}
