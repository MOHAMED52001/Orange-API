<?php

namespace App\Http\Repositories;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Interfaces\CourseInterface;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Courses\StoreCourseRequest;
use App\Http\Requests\Courses\UpdateCourseRequest;


class CourseRepository implements CourseInterface
{
    use ApiResponseTrait;

    public function index()
    {
        return $this->apiResponse(200, "Success", null, Course::all());
    }
    public function show(Course $course)
    {
        return $this->apiResponse(200, "Course Found", null, $course);
    }

    public function store(StoreCourseRequest $request)
    {
        $course = Course::create($request->validated());
        return $this->apiResponse(201, "Course Created Successfully", null, $course);
    }

    public function update(Course $course, UpdateCourseRequest $request)
    {
        $course->update($request->all());

        return  $this->apiResponse(200, "Course updated successfully", null, $course);
    }

    public function delete(Course $course)
    {

        Course::destroy($course->id);
        return $this->apiResponse(200, "Course Deleted", null, $course);
    }






    //Add New Skills To Course
    public function attachCourseSkills(Request $request, $id)
    {
        $course = Course::find($id);

        if ($course != null) {

            $course->skills()->syncWithoutDetaching($request->skills);

            return $this->apiResponse(200, "Skills Added Successfully", null, $course->skills);
        } else {
            return  $this->apiResponse(200, "There Is No Records That Match The Given Id In Database");
        }
    }

    //Update Course Skills 
    public function updateCourseSkills($id)
    {
        $course = Course::find($id);

        if ($course != null) {

            $skills = Course::with(['skills' => function ($q) {
                $q->select('skill');
            }])->find($id)["skills"];

            $tech = "";
            foreach ($skills as $skill) {

                $tech .= " " . $skill['skill'] . " ,";
            }
            $course->course_skills = rtrim($tech, ',');
            $course->save();

            return  $this->apiResponse(200, "Course Skills Updated Successfully", null, $course);
        } else {
            return  $this->apiResponse(200, "There Is No Records That Match The Given Id In Database");
        }
    }

    //Get Course Skills / Skills That Student Will Gain After Completing The Course
    public function getSkillsAfterCompletionOfCourse($id)
    {
        $course = Course::find($id);

        if ($course != null) {
            $response = [
                'Skills' => $course->skills
            ];
            return  $this->apiResponse(200, "Course Skills", null, $response);
        } else {
            return  $this->apiResponse(200, "There Is No Records That Match The Given Id In Database");
        }
    }

    //Get The Skills That Required To Enroll In Specific Course
    public function checkCourseHasRequiredSkills($id)
    {
        $course = Course::find($id);

        if ($course != null) {
            if ($course->type == "PreRequiste") {
                $response = [
                    'RequiredSkills' => $course->reqSkills
                ];
                return  $this->apiResponse(200, "Course Has PreRequiste Skills", null, $response);
            } else {
                return  $this->apiResponse(200, "Course Has No PreRequiste Skills");
            }
        } else {
            return  $this->apiResponse(200, "There Is No Records That Match The Given Id In Database");
        }
    }

    public function getCourseStudents($id)
    {
        $course = Course::with(['students' => function ($query) {
            $query->select('students.id', 'fname', 'lname', 'email');
        }])->find($id);

        if ($course != null) {

            $students = $course->students;

            if (count($students) == 0) {
                return  $this->apiResponse(200, "Course Has No Students");
            } else {
                $response = [
                    'Students' => $students
                ];
                return  $this->apiResponse(200, "Course Has Students", null, $response);
            }
        } else {
            return  $this->apiResponse(200, "There Is No Records That Match The Given Id In Database");
        }
    }

    public function getCourseInstructor($id)
    {
        $course = Course::with(['instructor' => function ($query) {
            $query->select('instructors.id', 'fname', 'lname', 'email');
        }])->find($id);

        if ($course != null) {
            $instructor = $course->instructor;
            $response = [
                'instructor' => $instructor
            ];
            return  $this->apiResponse(200, "Instructor Of The Course", null, $response);
        } else {
            return  $this->apiResponse(200, "There Is No Records That Match The Given Id In Database");
        }
    }

    //Add Required Skills To Course
    public function attachCourseRequireSkills(Request $request, $id)
    {
        $course = Course::find($id);

        if ($course != null) {

            $course->reqSkills()->syncWithoutDetaching($request->skills);

            return $this->apiResponse(200, "Skills Added Successfully", null, $course->reqSkills);
        } else {
            return  $this->apiResponse(200, "There Is No Records That Match The Given Id In Database");
        }
    }
}
