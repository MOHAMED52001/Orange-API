<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['skill'];

    protected $hidden = ['pivot', 'created_at', 'updated_at'];

    //////////////////// Relations /////////////////

    //Skills That Belongs To Students
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_skills', 'skill_id', 'student_id');
    }

    //Skills That Required To Enroll in Course
    public function courseReqSkills()
    {
        return $this->belongsToMany(Course::class, 'course_prerequitse_skills', 'skill_id', 'course_id');
    }

    //Skills That Student Will Gain After Completing The Course
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_skills', 'skill_id', 'course_id');
    }
}
