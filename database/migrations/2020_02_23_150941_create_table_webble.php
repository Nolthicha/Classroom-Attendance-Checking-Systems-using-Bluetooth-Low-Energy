<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class CreateTableWebble extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webble', function (Blueprint $table) {

            $table->bigIncrements('id');
            //$table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('tb_subject_id');
            //$table->string('type');
            

            $table->date('date_ble')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->time('time')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            
            $table->foreign('tb_subject_id')->references('id')->on('subject')->onUpdate('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webble');
    }
}
