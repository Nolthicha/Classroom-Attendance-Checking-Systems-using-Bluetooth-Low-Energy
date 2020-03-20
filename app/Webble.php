<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Webble extends Model
{
    //
    protected $table = 'webble';
    
    protected $fillable = [
        'id',
        'subject_id',
        'year',
        'term',
        'day',
        'time_start',
        'time_end',
        'room',
    
    ];
}
