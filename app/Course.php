<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //

    protected $table = 'courses';

    //protected $primaryKey = 'subject_id';
    //public $incrementing = false;
    

    protected $fillable=['subject_id','subject_name','user_email'];
    
    
    //protected $primaryKey = null;



    
}
