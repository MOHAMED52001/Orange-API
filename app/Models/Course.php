<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Instructor;

class Course extends Model
{
    use HasFactory;


    protected $fillable = [
        'title', 'headline', 'type', 'technologies', 'description', 'duration', 'instructor_id'
    ];

    protected $hidden = ['pivot', 'created_at', 'updated_at'];




    //////////////////////////////////// Relations //////////////////////////////////////////////////////////////////

    //Course Instructor


    //Students In Courses
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_course', 'course_id', 'student_id');
    }

    // Skills That Student Will Gain After Completing The Course
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'course_skills', 'course_id', 'skill_id');
    }

    //Skills That Required To Enroll In Specific Course
    public function reqSkills()
    {
        return $this->belongsToMany(Skill::class, 'course_prerequitse_skills', 'course_id', 'skill_id');
    }

    //Instructor Of Specific Course
    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
}
