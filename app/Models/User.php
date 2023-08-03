<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_users', 'user_id')->withPivot('attend_course', 'pass_course');
    }

    public function getTotalTrainingHoursAttribute()
    {
        $idsForCourses=  CourseUser::query()
            ->where('user_id', $this->id)
            ->where('pass_course', 1)
            ->where('attend_course', 1)->pluck('course_id');

        return Course::query()->whereIn('id', $idsForCourses)->sum('training_hours');
    }

    //JWT
    public function getJWTIdentifier()
    {
        dd($this->getKey());
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
