<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSubject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject', function (Blueprint $table) {

            //$table->engine = 'InnoDB';

            $table->bigIncrements('id');
            //$table->unsignedBigInteger('subj_id');
            $table->string('subj_id');
            
            $table->string('year');
            $table->string('term');
            $table->string('day');
            $table->string('time_start');
            $table->string('time_end');

            $table->string('room')->index();
          
            $table->timestamps();

            $table->unique(['subj_id', 'year' , 'term' , 'day' ,'time_start']);
            
            $table->foreign('subj_id')->references('subject_id')->on('courses')->onUpdate('cascade');
            
        });

       

    }


    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    
        
        Schema::dropIfExists('subject');
       
    }
}
