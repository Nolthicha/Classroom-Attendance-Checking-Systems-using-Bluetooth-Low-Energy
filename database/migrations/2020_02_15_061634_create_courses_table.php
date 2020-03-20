<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            //$table->engine = 'InnoDB';

            
            //$table->bigIncrements('subject_id');
            $table->string('subject_id')->primary();
            $table->string('subject_name');
            $table->string('user_email');
           
            
            $table->timestamps();

            $table->foreign('user_email')->references('email')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');


    }
}
