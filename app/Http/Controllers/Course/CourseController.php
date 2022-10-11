<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\CourseInterface;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{

    private $CourseInterface;

    public function __construct(CourseInterface $CourseInterface)
    {
        $this->CourseInterface = $CourseInterface;
    }

    public function index()
    {
        return $this->CourseInterface->index();
    }

    public function store(Request $request)
    {
        return $this->CourseInterface->store($request);
    }

    public function show($id)
    {
        return $this->CourseInterface->show($id);
    }

    public function update(Request $request, $id)
    {
        return $this->CourseInterface->update($request, $id);
    }

    public function delete($id)
    {
        return $this->CourseInterface->delete($id);
    }

    //Add New Skills To Course
    public function attachCourseSkills(Request $request, $id)
    {
        return $this->CourseInterface->attachCourseSkills($request, $id);
    }

    //Update Skills In Course
    public function updateSkills($id)
    {
        return $this->CourseInterface->updateCourseSkills($id);
    }

    //Get Skills That Student Will Gain After Completing The Course
    public function getSkillsAfterCompletionOfCourse($id)
    {
        return $this->CourseInterface->getSkillsAfterCompletionOfCourse($id);
    }

    //Get The Skills That Required To Enroll In Specific Course
    public function checkCourseHasRequiredSkills($id)
    {
        return $this->CourseInterface->checkCourseHasRequiredSkills($id);
    }

    //Get Course Students
    public function getCourseStudents($id)
    {
        return $this->CourseInterface->getCourseStudents($id);
    }

    //Get Instructor Of Course
    public function getCourseInstructor($id)
    {
        return $this->CourseInterface->getCourseInstructor($id);
    }
}
