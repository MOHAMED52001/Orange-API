<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\CourseInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CourseRepository implements CourseInterface
{
    use ApiResponseTrait;

    public function index()
    {
        $courses = Course::all();
        if (!is_null($courses)) {
            return $this->apiResponse(200, "Success", null, $courses);
        }
        return  $this->apiResponse(200, "There Is No Records That Match The Given Id In Database");
    }

    public function show($id)
    {
        $course = Course::find($id);

        if ($course != null) {
            return $this->apiResponse(200, "Course Found", null, $course);
        } else {
            return  $this->apiResponse(200, "There Is No Records That Match The Given Id In Database");
        }
    }

    public function store(Request $request)
    {
        //Create New Course
        $formFilds = Validator::make($request->all(), [
            'title' => 'required|string',
            'headline' => 'required|string',
            'type' => 'required|string',
            'technologies' => 'required|string',
            'description' => 'required|string',
            'duration' => 'required|string',
            'instructor_id' => 'required',
        ]);

        if ($formFilds->fails()) {
            return $this->apiResponse(400, "Validation Error", $formFilds->errors());
        }

        $course = Course::create($request->all());

        $response = [
            'Course' => $course,
        ];

        return $this->apiResponse(201, "Course Created Successfully", null, $response);
    }

    public function update(Request $request, $id)
    {
        $course = Course::find($id);

        if ($course != null) {
            //Create New Course
            $formFilds = Validator::make($request->all(), [
                'title' => 'string',
                'headline' => 'string',
                'type' => 'string',
                'technologies' => 'string',
                'description' => 'string',
                'duration' => 'string',
                'instructor_id' => 'Integer',
            ]);

            if ($formFilds->fails()) {
                return $this->apiResponse(400, "Validation Error", $formFilds->errors());
            }

            $course->update($request->all());

            $response = [
                'Course' => $course,
            ];

            return  $this->apiResponse(200, "Course updated successfully", null, $response);
        } else {
            return  $this->apiResponse(200, "There Is No Records That Match The Given Id In Database");
        }
    }

    public function delete($id)
    {
        $course = Course::find($id);

        if ($course != null) {
            Course::destroy($course->id);
            return $this->apiResponse(200, "Course Deleted", null, $course);
        } else {
            return  $this->apiResponse(200, "There Is No Records That Match The Given Id In Database");
        }
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
}
