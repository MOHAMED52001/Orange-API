<?php

namespace App\Http\Controllers\Student;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\StudentCourse;
use App\Models\StudentEnrollCourse;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\StudentInterface;

class StudentController extends Controller
{

    private $StudentInterface;

    public function __construct(StudentInterface $StudentInterface)
    {
        $this->StudentInterface = $StudentInterface;
    }

    public function index()
    {
        return $this->StudentInterface->index();
    }

    public function store(Request $request)
    {
        return $this->StudentInterface->store($request);
    }

    public function show($id)
    {
        return $this->StudentInterface->show($id);
    }

    public function update(Request $request, $id)
    {
        return $this->StudentInterface->update($request, $id);
    }

    public function delete($id)
    {
        return $this->StudentInterface->delete($id);
    }

    public function getStudentSkills($id)
    {
        return $this->StudentInterface->getStudentSkills($id);
    }

    //Get Student Courses 
    public function getStudentCourses($id)
    {
        return $this->StudentInterface->getStudentCourses($id);
    }

    //Add New Skills To Student
    public function attachNewSkills(Request $request, $id)
    {
        return $this->StudentInterface->attachNewSkills($request, $id);
    }

    //Add New Skills To Student
    public function detachSkills(Request $request, $id)
    {
        return $this->StudentInterface->detachSkills($request, $id);
    }

    //Enroll Student Into Course
    public function enrollStudentInCourse(Request $request, $id)
    {
        return $this->StudentInterface->enrollStudentInCourse($request, $id);
    }

    public function searchByName($fname)
    {
        return Student::where('fname', 'like', '%' . $fname . '%')->get();
    }

    public function recommendCourses($id)
    {
        return $this->StudentInterface->recommendCourses($id);
    }
}
