<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    //we have do define attributes that are not in the table as a primary key with that particular name (instructor_id vs id in user table)
    //if it was user_id we don't need to define it
    public function scheduledClasses(){
        return $this->hasMany(ScheduledClass::class, 'instructor_id');
    }

    //define many to many relationship. we have to define the intermediate table name as second parameter
    public function bookings(){
        return $this->belongsToMany(ScheduledClass::class, 'bookings');
    }
}
