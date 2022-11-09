<?php

namespace App\Http\Interfaces;

use App\Models\Instructor;
use Illuminate\Http\Request;
use App\Http\Requests\Instructors\StoreInstructorRequest;
use App\Http\Requests\Instructors\UpdateInstructorRequest;


interface InstructorInterface
{
    public function index();
    public function store(StoreInstructorRequest $request);
    public function show(Instructor $instructor);
    public function update(Instructor $instructor, UpdateInstructorRequest $request);
    public function destroy(Instructor $instructor);
    public function getCoursesThatBelongToInstructor($id);
}
