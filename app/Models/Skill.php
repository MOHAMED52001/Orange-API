<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['skill'];

    protected $hidden = ['pivot'];

    //////////////////// Relations /////////////////

    //Skills That Belongs To Students
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_skills', 'skill_id', 'student_id');
    }
}
