<?php

namespace App\Http\Controllers\Course;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\CourseInterface;
use App\Http\Requests\Courses\StoreCourseRequest;
use App\Http\Requests\Courses\UpdateCourseRequest;

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

    public function store(StoreCourseRequest $request)
    {
        return $this->CourseInterface->store($request);
    }

    public function show(Course $course)
    {
        return $this->CourseInterface->show($course);
    }

    public function update(Course $course, UpdateCourseRequest $request)
    {
        return $this->CourseInterface->update($course, $request);
    }

    public function destroy(Course $course)
    {
        return $this->CourseInterface->delete($course);
    }

    //Add New Skills To Course
    public function attachCourseSkills(Request $request, $id)
    {
        return $this->CourseInterface->attachCourseSkills($request, $id);
    }

    //Add Required Skills To Course
    public function attachCourseRequireSkills(Request $request, $id)
    {
        return $this->CourseInterface->attachCourseRequireSkills($request, $id);
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
