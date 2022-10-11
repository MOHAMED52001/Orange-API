<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Skill\SkillController;
use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Supplier\SupplierController;
use App\Http\Controllers\Instructor\InstructorController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\SupplierContracts\SupplierContractsController;

//Public Routes
Route::post('/admins/login', [AdminController::class, 'login'])->name('login');

//Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    //Admins Routes
    Route::get('/admins', [AdminController::class, 'index']); //
    Route::get('/admins/{id}', [AdminController::class, 'show']); //
    Route::post('/admins/register', [AdminController::class, 'register']); //
    Route::post('/admins/logout', [AdminController::class, 'logout']); //
    Route::delete('/admins/{id}', [AdminController::class, 'delete']); //
    Route::put('/admins/{id}', [AdminController::class, 'update']); //

    //Student Routes
    Route::get('/students', [StudentController::class, 'index']); //
    Route::post('/students', [StudentController::class, 'store']); //
    Route::get('/students/{id}', [StudentController::class, 'show']); //
    Route::put('/students/{id}', [StudentController::class, 'update']); //
    Route::delete('/students/{id}', [StudentController::class, 'removeStudent']); //
    Route::post('/students/{id}/addskills', [StudentController::class, 'attachNewSkills']); //
    Route::delete('/students/{id}/removeskills', [StudentController::class, 'detachSkills']); //
    Route::post('/students/{id}/addcourse/', [StudentController::class, 'enrollStudentInCourse']); //
    Route::get('/students/search/{fname}', [StudentController::class, 'searchByName']); //
    Route::get('/students/{id}/recommendcourses', [StudentController::class, 'recommendCourses']); //

    ////////////Relations////////
    Route::get('/students/{id}/courses', [StudentController::class, 'getStudentCourses']); //
    Route::get('/students/{id}/skills', [StudentController::class, 'getStudentSkills']); //

    //Course Routes
    Route::get('/courses', [CourseController::class, 'index']); //
    Route::post('/courses', [CourseController::class, 'store']); //
    Route::put('/courses/{id}', [CourseController::class, 'update']); //
    Route::get('/courses/{id}', [CourseController::class, 'show']); //
    Route::delete('/courses/{id}', [CourseController::class, 'delete']); //
    Route::post('/courses/{id}/requireskills', [CourseController::class, 'attachCourseRequireSkills']); //
    Route::post('/courses/{id}/skills', [CourseController::class, 'attachCourseSkills']); //
    Route::put('/courses/{id}/skills', [CourseController::class, 'updateSkills']); //
    ////////////Relations////////
    Route::get('/courses/{id}/students', [CourseController::class, 'getCourseStudents']); //
    Route::get('/courses/{id}/instructor', [CourseController::class, 'getCourseInstructor']); //
    Route::get('/courses/{id}/requiredskills', [CourseController::class, 'checkCourseHasRequiredSkills']); //
    Route::get('/courses/{id}/skills', [CourseController::class, 'getSkillsAfterCompletionOfCourse']); //

    //Skill Routes
    Route::get('/skills', [SkillController::class, 'index']); //
    Route::post('/skills', [SkillController::class, 'store']); //
    Route::put('/skills/{id}', [SkillController::class, 'update']); //
    Route::get('/skills/{id}', [SkillController::class, 'show']); //
    Route::delete('/skills/{id}', [SkillController::class, 'removeSkill']); //

    ////////////Relations////////
    Route::get('/skills/{id}/courses', [SkillController::class, 'getCoursesThatHaveSkill']); //
    Route::get('/skills/{id}/students', [SkillController::class, 'getStudentsThatHaveSkill']); //

    //Instructor Routes
    Route::get('/instructors', [InstructorController::class, 'index']); //
    Route::post('/instructors', [InstructorController::class, 'store']); //
    Route::put('/instructors/{id}', [InstructorController::class, 'update']); //
    Route::get('/instructors/{id}', [InstructorController::class, 'show']); //
    Route::delete('/instructors/{id}', [InstructorController::class, 'removeInstructor']); //
    Route::post('/instructors/{id}/addskills', [InstructorController::class, 'attachNewSkills']); //
    Route::post('/instructors/{id}/addReqskills', [InstructorController::class, 'attachPreRequisteSkills']); //

    ////////////Relations////////
    Route::get('/instructors/{id}/courses', [InstructorController::class, 'getCoursesThatBelongToInstructor']); //

    //Supplier Routes
    Route::get('/suppliers', [SupplierController::class, 'index']);
    Route::get('/suppliers/{id}', [SupplierController::class, 'show']);
    Route::post('/suppliers', [SupplierController::class, 'store']);
    Route::put('/suppliers/{id}', [SupplierController::class, 'update']);
    Route::delete('/suppliers/{id}', [SupplierController::class, 'delete']);

    //////////Relations//////////////////
    Route::get('/suppliers/{id}/contracts', [SupplierController::class, 'supplierContracts']);
    Route::get('/suppliers/{id}/suppliercontractsmoney', [SupplierController::class, 'supplierContractsMoney']);

    //Supplier Contracts Routes
    Route::get('/contracts', [SupplierContractsController::class, 'index']);
    Route::get('/contracts/{id}', [SupplierContractsController::class, 'show']);
    Route::post('/contracts', [SupplierContractsController::class, 'store']);
    Route::delete('/contracts/{id}', [SupplierContractsController::class, 'delete']);

    //Transactions Routes
    Route::get('/transactions', [TransactionController::class, 'index']);
    Route::post('/transactions', [TransactionController::class, 'store']);

    /////////// Relations/////////
    Route::get('/transactions/contract/{id}', [TransactionController::class, 'getContractTransactions']);
});
