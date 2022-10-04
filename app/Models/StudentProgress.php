<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProgress extends Model
{
    use HasFactory;


    protected $fillable = [
        'student_id', 'course_id', 'lecture_date', 'attendance', 'assignment_evaluation', 'search', 'interaction'
    ];
}
