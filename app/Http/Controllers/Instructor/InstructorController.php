<?php

namespace App\Http\Controllers\Instructor;

use App\Models\Skill;
use App\Models\Course;
use App\Models\Instructor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\InstructorInterface;
use App\Http\Requests\Instructors\StoreInstructorRequest;
use App\Http\Requests\Instructors\UpdateInstructorRequest;

class InstructorController extends Controller
{
    public $InstructorInterface;

    public function __construct(InstructorInterface $instructor)
    {
        $this->InstructorInterface = $instructor;
    }

    public function index()
    {
        return $this->InstructorInterface->index();
    }

    public function store(StoreInstructorRequest $request)
    {
        return $this->InstructorInterface->store($request);
    }

    public function show(Instructor $instructor)
    {
        return $this->InstructorInterface->show($instructor);
    }

    public function update(Instructor $instructor, UpdateInstructorRequest $request)
    {
        return $this->InstructorInterface->update($instructor, $request);
    }

    public function destroy(Instructor $instructor)
    {
        return $this->InstructorInterface->destroy($instructor);
    }

    //Get Courses That Belongs To Instructor
    public function getCoursesThatBelongToInstructor($id)
    {
        return $this->InstructorInterface->getCoursesThatBelongToInstructor($id);
    }
}
