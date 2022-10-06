<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $courses = Course::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);

        if ($course != null) {
            return $course;
        } else {
            return json_encode([
                'message' => 'Course Not Found'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //Get Skills That Student Will Gain After Completing The Course
    public function getSkillsAfterCompletionOfCourse($id)
    {
        $course = Course::find($id);

        if ($course != null) {
            return json_encode([
                'Skills' => $course->skills
            ]);
        } else {
            return json_encode([
                'message' => 'Course Not Found'
            ]);
        }
    }

    //Get The Skills That Required To Enroll In Specific Course
    public function checkCourseHasRequiredSkills($id)
    {
        $course = Course::find($id);

        if ($course != null) {
            if ($course->type == "PreRequiste") {
                return json_encode([
                    'RequiredSkills' => $course->reqSkills
                ]);
            } else {
                return json_encode([
                    'message' => 'Course Has No PreRequiste Skills'
                ]);
            }
        } else {
            return json_encode([
                'message' => 'Course Not Found'
            ]);
        }
    }

    //Get Course Students
    public function getCourseStudents($id)
    {
        $course = Course::with(['students' => function ($query) {
            $query->select('students.id', 'fname', 'lname', 'email');
        }])->find($id);

        if ($course != null) {

            $students = $course->students;

            if (count($students) == 0) {
                return json_encode([
                    'message' => 'Course Has No Students'
                ]);
            } else {
                return json_encode([
                    'Students' => $students
                ]);
            }
        } else {
            return json_encode([
                'message' => 'Course Not Found'
            ]);
        }
    }

    //Get Instructor Of Course
    public function getCourseInstructor($id)
    {
        $course = Course::with(['instructor' => function ($query) {
            $query->select('instructors.id', 'fname', 'lname', 'email');
        }])->find($id);

        if ($course != null) {

            $instructor = $course->instructor;

            return json_encode([
                'instructor' => $instructor
            ]);
        } else {
            return json_encode([
                'message' => 'Course Not Found'
            ]);
        }
    }
}
