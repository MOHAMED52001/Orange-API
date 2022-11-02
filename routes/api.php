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
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admins', 'index');
        Route::get('/admins/{id}', 'show');
        Route::post('/admins/register',  'register');
        Route::post('/admins/logout', 'logout');
        Route::delete('/admins/{id}',  'delete');
        Route::put('/admins/{id}',  'update');
    });

    //Student Routes
    Route::controller(StudentController::class)->group(function () {
        Route::get('/students', 'index');
        Route::post('/students', 'store');
        Route::get('/students/{student}', 'show');
        Route::put('/students/{student}', 'update');
        Route::delete('/students/{id}', 'delete');
        Route::post('/students/{id}/addskills', 'attachNewSkills');
        Route::delete('/students/{id}/removeskills', 'detachSkills');
        Route::post('/students/{id}/addcourse/', 'enrollStudentInCourse');
        Route::get('/students/search/{fname}', 'searchByName');
        Route::get('/students/{id}/recommendcourses', 'recommendCourses');
        ////////////Relations////////
        Route::get('/students/{id}/courses',  'getStudentCourses');
        Route::get('/students/{id}/skills',  'getStudentSkills');
    });

    //Course Routes
    Route::controller(CourseController::class)->group(function () {
        Route::get('/courses', 'index');
        Route::post('/courses',  'store');
        Route::put('/courses/{id}',  'update');
        Route::get('/courses/{id}',  'show');
        Route::delete('/courses/{id}',  'delete');
        Route::post('/courses/{id}/requireskills',  'attachCourseRequireSkills');
        Route::post('/courses/{id}/skills',  'attachCourseSkills');
        Route::put('/courses/{id}/skills',  'updateSkills');
        ////////////Relations////////
        Route::get('/courses/{id}/students',  'getCourseStudents');
        Route::get('/courses/{id}/instructor',  'getCourseInstructor');
        Route::get('/courses/{id}/requiredskills',  'checkCourseHasRequiredSkills');
        Route::get('/courses/{id}/skills',  'getSkillsAfterCompletionOfCourse');
    });

    //Skill Routes
    Route::controller(SkillController::class)->group(function () {
        Route::get('/skills', 'index');
        Route::post('/skills', 'store');
        Route::put('/skills/{id}', 'update');
        Route::get('/skills/{id}', 'show');
        Route::delete('/skills/{id}', 'destroy');
        ////////////Relations////////
        Route::get('/skills/{id}/courses', 'getCoursesThatHaveSkill');
        Route::get('/skills/{id}/students', 'getStudentsThatHaveSkill');
    });

    //Instructor Routes
    Route::controller(InstructorController::class)->group(function () {
        Route::get('/instructors',  'index');
        Route::post('/instructors',  'store');
        Route::put('/instructors/{id}',  'update');
        Route::get('/instructors/{id}',  'show');
        Route::delete('/instructors/{id}',  'delete');
        ////////////Relations////////
        Route::get('/instructors/{id}/courses',  'getCoursesThatBelongToInstructor');
    });

    //Supplier Routes
    Route::controller(SupplierController::class)->group(function () {
        Route::get('/suppliers',  'index');
        Route::get('/suppliers/{id}',  'show');
        Route::post('/suppliers',  'store');
        Route::put('/suppliers/{id}',  'update');
        Route::delete('/suppliers/{id}',  'delete');
        //////////Relations//////////////////
        Route::get('/suppliers/{id}/contracts',  'supplierContracts');
        Route::get('/suppliers/{id}/suppliercontractsmoney',  'supplierContractsMoney');
    });

    //Supplier Contracts Routes
    Route::controller(SupplierContractsController::class)->group(function () {
        Route::get('/contracts',  'index');
        Route::get('/contracts/{id}',  'show');
        Route::post('/contracts',  'store');
        Route::delete('/contracts/{id}',  'delete');
    });

    //Transactions Routes
    Route::controller(TransactionController::class)->group(function () {
        Route::get('/transactions',  'index');
        Route::post('/transactions',  'store');
        /////////// Relations/////////
        Route::get('/transactions/contract/{id}',  'getContractTransactions');
    });
});
