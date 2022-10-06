<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Skill\SkillController;
use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Instructor\InstructorController;




//Student Routes
Route::get('/students', [StudentController::class, 'index']);
Route::get('/students/{id}', [StudentController::class, 'show']);
Route::get('/students/{id}/courses', [StudentController::class, 'getStudentCourses']);
Route::get('/students/{id}/skills', [StudentController::class, 'getStudentSkills']);


//Course Routes
Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{id}', [CourseController::class, 'show']);
Route::get('/courses/{id}/students', [CourseController::class, 'getCourseStudents']);
Route::get('/courses/{id}/instructor', [CourseController::class, 'getCourseInstructor']);
Route::get('/courses/{id}/requiredskills', [CourseController::class, 'checkCourseHasRequiredSkills']);
Route::get('/courses/{id}/skills', [CourseController::class, 'getSkillsAfterCompletionOfCourse']);


//Skill Routes
Route::get('/skills', [SkillController::class, 'index']);
Route::get('/skills/{id}', [SkillController::class, 'show']);
Route::get('/skills/{id}/courses', [SkillController::class, 'getCoursesThatHaveSkill']);
Route::get('/skills/{id}/students', [SkillController::class, 'getStudentsThatHaveSkill']);


//Instructor Routes
Route::get('/instructors', [InstructorController::class, 'index']);
Route::get('/instructors/{id}/courses', [InstructorController::class, 'getCoursesThatBelongToInstructor']);


//Protected Routes
Route::group(['middleware' => 'auth:sanctum'], function () {
});
