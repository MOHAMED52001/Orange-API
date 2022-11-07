<?php

namespace App\Models;

use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['fname', 'lname', 'national_id', 'email', 'phone', 'password'];

    protected $hidden = ['pivot', 'password', 'email_verified_at', 'remember_token', 'created_at', 'updated_at'];




    ///////////////////////////////   Relations //////////////////////////

    //Student Skills 
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'student_skills', 'student_id', 'skill_id');
    }

    //Student Courses
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'student_course_registration', 'student_id', 'course_id');
    }
}
