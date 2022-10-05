<?php

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Course\CourseController;




//Student Routes
Route::get('/students', [StudentController::class, 'index']);
Route::get('/students/{id}', [StudentController::class, 'show']);
Route::get('/students/skills/{id}', [StudentController::class, 'getStudentSkills']);
Route::get('/students/courses/{id}', [StudentController::class, 'getStudentCourses']);








//Course Routes
Route::get('/courses', [CourseController::class, 'index']);










//Protected Routes
Route::group(['middleware' => 'auth:sanctum'], function () {
});
