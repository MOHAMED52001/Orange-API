<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangeSupplierContract extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier', 'course_id', 'course_cost', 'course_state', 'course_place'
    ];
}
