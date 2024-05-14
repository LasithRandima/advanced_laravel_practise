<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledClass extends Model
{
    use HasFactory;

    protected $guarded = null;

    //Convert To DateTime when storing data in database
    protected $casts = [
        'date_time' => 'datetime'
    ];

    public function instructor(){
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function classType(){
        return $this->belongsTo(ClassType::class);
    }
}
