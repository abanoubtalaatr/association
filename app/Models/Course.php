<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function users()
    {
        return $this->belongsToMany(User::class, 'course_users', 'course_id')->withPivot('pass_course', 'attend_course');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function certification()
    {
        return $this->hasOne(Certification::class);
    }
}
