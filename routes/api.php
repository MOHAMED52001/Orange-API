<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Skill\SkillController;
use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Supplier\SupplierController;
use App\Http\Controllers\Instructor\InstructorController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\SupplierContracts\SupplierContractsController;

//Public Routes
Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware(['guest']);

//Protected Routes
Route::group(['middleware' => ['auth:sanctum', 'is_admin']], function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //Admins Routes
    Route::controller(AdminController::class)->group(function () {
        Route::apiResource('/admins', AdminController::class);
    });
    //Student Routes
    Route::controller(StudentController::class)->group(function () {
        Route::post('/students/{id}/addskills', 'attachNewSkills');
        Route::delete('/students/{id}/removeskills', 'detachSkills');
        Route::post('/students/{id}/addcourse/', 'enrollStudentInCourse');
        Route::get('/students/search/{fname}', 'searchByName');
        Route::get('/students/{id}/recommendcourses', 'recommendCourses');
        ////////////Relations////////
        Route::get('/students/{id}/courses',  'getStudentCourses');
        Route::get('/students/{id}/skills',  'getStudentSkills');

        Route::apiResource('/students', StudentController::class);
    });

    //Course Routes
    Route::controller(CourseController::class)->group(function () {
        Route::post('/courses/{id}/requireskills',  'attachCourseRequireSkills');
        Route::post('/courses/{id}/skills',  'attachCourseSkills');
        Route::put('/courses/{id}/skills',  'updateSkills');
        ////////////Relations////////
        Route::get('/courses/{id}/students',  'getCourseStudents');
        Route::get('/courses/{id}/instructor',  'getCourseInstructor');
        Route::get('/courses/{id}/requiredskills',  'checkCourseHasRequiredSkills');
        Route::get('/courses/{id}/skills',  'getSkillsAfterCompletionOfCourse');

        Route::apiResource('/courses', CourseController::class);
    });

    //Skill Routes
    Route::controller(SkillController::class)->group(function () {
        ////////////Relations////////
        Route::get('/skills/{id}/courses', 'getCoursesThatHaveSkill');
        Route::get('/skills/{id}/students', 'getStudentsThatHaveSkill');

        Route::apiResource('skills', SkillController::class);
    });

    //Instructor Routes
    Route::controller(InstructorController::class)->group(function () {
        ////////////Relations////////
        Route::get('/instructors/{id}/courses',  'getCoursesThatBelongToInstructor');

        Route::apiResource('/instructors', InstructorController::class);
    });

    //Supplier Routes
    Route::controller(SupplierController::class)->group(function () {
        //////////Relations//////////////////
        Route::get('/suppliers/{id}/contracts',  'supplierContracts');
        Route::get('/suppliers/{id}/suppliercontractsmoney',  'supplierContractsMoney');

        Route::apiResource('/suppliers', SupplierController::class);
    });

    //Supplier Contracts Routes
    Route::apiResource('/contracts', SupplierContractsController::class);

    //Transactions Routes
    Route::controller(TransactionController::class)->group(function () {
        Route::get('/transactions',  'index');
        Route::get('/transactions/{transaction}',  'show');
        Route::post('/transactions',  'store');
        /////////// Relations/////////
        Route::get('/transactions/contract/{id}',  'getContractTransactions');
    });
});