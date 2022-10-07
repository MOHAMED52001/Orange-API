<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentEnrollCourse extends Model
{
    use HasFactory;
    protected $table = 'student_enroll_course';
    protected $fillable = ['student_id', 'course_id', 'start_date', 'end_date'];
    public $timestamps = false;
}
