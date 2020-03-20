<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //

    protected $table = 'subject';


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

    public function scopeSearch($query, $q)
    {
        return $query->where('year','LIKE','%'.$q.'%')
        ->orWhere('term','LIKE','%'.$q.'%')
        ->orWhere('day','LIKE','%'.$q.'%')
        ->orWhere('time_start','LIKE','%'.$q.'%')
        ->orWhere('time_end','LIKE','%'.$q.'%')
        ->orWhere('room','LIKE','%'.$q.'%');
    }


}
