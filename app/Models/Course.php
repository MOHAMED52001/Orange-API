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

    protected $hidden = ['pivot', 'created_at', 'updated_at', 'instructor_id'];




    //////////////////////////////////// Relations //////////////////////////////////////////////////////////////////

    //Course Instructor
    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }


    //Students In Courses
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_course', 'course_id', 'student_id');
    }
}
