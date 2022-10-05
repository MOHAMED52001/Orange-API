<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class Instructor extends Model
{
    use HasFactory;

    protected $fillable = ['fname', 'lname', 'national_id', 'email', 'phone', 'password'];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
