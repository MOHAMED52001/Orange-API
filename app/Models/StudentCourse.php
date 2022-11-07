<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    use HasFactory;

    protected $table = 'student_course_registration';

    protected $fillable = ['student_id', 'course_id', 'finished_at'];

    public $timestamps = false;
}
