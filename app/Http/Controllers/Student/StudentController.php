<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return $students;
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
        $student = Student::find($id);

        if ($student != null) {
            return $student;
        } else {
            return json_encode([
                'message' => 'Student Not Found'
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


    public function getStudentSkills($id)
    {
        $student = Student::with(['skills' => function ($query) {
            $query->select('skill');
        }])->find($id);

        if ($student != null) {
            $skills = $student->skills;

            if (count($skills) == 0) {
                return json_encode([
                    'message' => 'Student Has No Skills'
                ]);
            } else {

                return $skills;
            }
        } else {
            return json_encode([
                'message' => 'Student Not Found'
            ]);
        }
    }


    //Get Student Courses 
    public function getStudentCourses($id)
    {
        $student = Student::with(['courses' => function ($query) {
            $query->select('title');
        }])->find($id);

        if ($student != null) {
            $courses = $student->courses;

            if (count($courses) == 0) {
                return json_encode([
                    'message' => 'Student Has No courses'
                ]);
            } else {

                return $courses;
            }
        } else {
            return json_encode([
                'message' => 'Student Not Found'
            ]);
        }
    }
}
