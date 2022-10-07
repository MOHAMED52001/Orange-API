<?php

namespace App\Http\Controllers\Student;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\StudentCourse;
use App\Models\StudentEnrollCourse;
use App\Http\Controllers\Controller;

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
        //Create New Student
        $formFilds = $request->validate([
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|email|unique:students,email|string',
            'phone' => 'required|unique:students,phone|string',
            'national_id' => 'required|unique:students,national_id|string',
            'password' => 'required|confirmed|string',
        ]);


        $formFilds['password'] = bcrypt($formFilds['password']);

        $student = Student::create($formFilds);


        $response = [
            'Student' => $student,
        ];

        return response($response, 201);
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

        $student = Student::find($id);

        if ($student != null) {
            $formFilds = $request->validate([
                'fname' => 'string',
                'lname' => 'string',
                'email' => 'email|unique:students,email|string',
                'phone' => 'unique:students,phone|string',
                'national_id' => 'unique:students,national_id|string',
            ]);
            $student->update($formFilds);
            $response = [
                'Student' => $student,
            ];

            return response($response, 201);
        } else {
            return json_encode([
                'message' => 'Student Not Found'
            ]);
        }
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

    //Add New Skills To Student
    public function attachNewSkills(Request $request, $id)
    {
        $student = Student::find($id);

        if ($student != null) {

            $student->skills()->syncWithoutDetaching($request->Skills);

            return $student->skills;
        } else {
            return json_encode([
                'message' => 'Student Not Found'
            ]);
        }
    }

    //Add New Skills To Student
    public function detachSkills(Request $request, $id)
    {
        $student = Student::find($id);

        $student->skills()->detach($request->Skills);

        return $student->skills;
    }

    //Remove Student From Talbe
    public function removeStudent($id)
    {
        $student = Student::find($id);

        if ($student != null) {
            Student::destroy($id);
            return [
                'Student Removed' => $student
            ];
        } else {
            return json_encode([
                'message' => 'Student Not Found'
            ]);
        }
    }

    //Enroll Student Into Course
    public function enrollStudentInCourse(Request $request, $id)
    {
        //Check if the student is already in the course
        $student_course_record = StudentEnrollCourse::where('student_id', $id)->first();

        if ($student_course_record != null) {

            $current_date_time = \Carbon\Carbon::now()->toDateTimeString();
            if ($student_course_record->end_date <= $current_date_time) {


                StudentEnrollCourse::destroy($student_course_record->id);

                // Add The Finished Course To StudentCourse Records
                $record_to_save_in_student_course = [
                    'student_id' => $student_course_record->student_id,
                    'course_id' => $student_course_record->course_id
                ];
                StudentCourse::create($record_to_save_in_student_course);



                $Enroll_The_student_in_new_course = [
                    'student_id' => $id,
                    'course_id' => $request->course_id
                ];

                StudentEnrollCourse::create($Enroll_The_student_in_new_course);

                return response(["Enrolled In Course" => [
                    "StudentFinshedCourse" => $record_to_save_in_student_course,
                    "Student Enrolled In New Course" => $Enroll_The_student_in_new_course
                ]], 201);
            } else {
                return [
                    'message' => "This Student Is Enrolled In Unfinished Course"
                ];
            }
        } else {

            $Enroll_The_student_in_new_course = [
                'student_id' => $id,
                'course_id' => $request->course_id
            ];
            StudentEnrollCourse::create($Enroll_The_student_in_new_course);
            return [
                "Student Enrolled In New Course" => $Enroll_The_student_in_new_course
            ];
        }
    }
}
