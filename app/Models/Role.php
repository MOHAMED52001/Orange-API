<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public const SUPER_ADMIN = 1;
    public const ADMIN = 2;
    public const Instructor = 3;
    public const Student = 4;

    protected $fillable = [
        'role'
    ];
}