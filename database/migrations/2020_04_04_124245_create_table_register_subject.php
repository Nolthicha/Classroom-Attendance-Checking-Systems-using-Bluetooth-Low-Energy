<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRegisterSubject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_subject', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('std_id');
            //$table->unsignedBigInteger('std_subject');
            $table->string('std_subject');
            $table->string('year');
            $table->string('term');
            $table->timestamps();

            $table->foreign('std_subject')->references('subj_id')->on('subject')->onUpdate('cascade');
            $table->foreign('std_id')->references('id')->on('tb_login');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('register_subject');
    }
}
