<?php

namespace App\Http\Controllers\Instructor;

use App\Models\Skill;
use App\Models\Course;
use App\Models\Instructor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\InstructorInterface;

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

    public function store(Request $request)
    {
        return $this->InstructorInterface->store($request);
    }

    public function show($id)
    {
        return $this->InstructorInterface->show($id);
    }

    public function update(Request $request, $id)
    {
        return $this->InstructorInterface->update($request, $id);
    }

    public function delete($id)
    {
        return $this->InstructorInterface->delete($id);
    }

    //Get Courses That Belongs To Instructor
    public function getCoursesThatBelongToInstructor($id)
    {
        return $this->InstructorInterface->getCoursesThatBelongToInstructor($id);
    }
}
