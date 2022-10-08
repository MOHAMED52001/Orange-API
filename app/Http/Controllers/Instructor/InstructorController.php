<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Skill;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return json_encode([
            'Instructors' => Instructor::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Create New Instructor
        $formFilds = $request->validate([
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|email|unique:instructors,email|string',
            'phone' => 'required|unique:instructors,phone|string',
            'national_id' => 'required|unique:instructors,national_id|string',
            'password' => 'required|confirmed|string',
        ]);


        $formFilds['password'] = bcrypt($formFilds['password']);

        $instructor = Instructor::create($formFilds);


        $response = [
            'Instructor' => $instructor,
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
        $instructor = Instructor::find($id);

        if ($instructor != null) {
            return $instructor;
        } else {
            return json_encode([
                'message' => 'Instructor Not Found'
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

        $instructor = Instructor::find($id);

        if ($instructor != null) {
            $formFilds = $request->validate([
                'fname' => 'string',
                'lname' => 'string',
                'email' => 'email|unique:instructors,email|string',
                'phone' => 'unique:instructors,phone|string',
                'national_id' => 'unique:instructors,national_id|string',
            ]);
            $instructor->update($formFilds);
            $response = [
                'Instructor' => $instructor,
            ];

            return response($response, 201);
        } else {
            return json_encode([
                'message' => 'Instructor Not Found'
            ]);
        }
    }



    //Get Courses That Belongs To Instructor
    public function getCoursesThatBelongToInstructor($id)
    {
        $instructor = Instructor::find($id);
        if ($instructor != null) {

            $courses = $instructor->courses;

            if (count($courses) == 0) {
                return json_encode([
                    'message' => "This Instructor does not Has Any Courses"
                ]);
            } else {
                return json_encode([
                    'Courses' => $courses
                ]);
            }
        } else {
            return json_encode([
                'message' => 'Instructor Not Found'
            ]);
        }
    }

    //Adding Required Skills To Course
    public function attachPreRequisteSkills(Request $request, $id)
    {
        $course = Course::find($id);
        if ($course != null) {

            $course->reqSkills()->syncWithoutDetaching($request->Skills);

            return $course->reqSkills;
        } else {
            return json_encode([
                'message' => 'Course Not Found'
            ]);
        }
    }

    //Adding Skills To Course
    public function attachNewSkills(Request $request, $id)
    {
        $course = Course::find($id);
        if ($course != null) {

            $course->skills()->syncWithoutDetaching($request->Skills);

            return $course->skills;
        } else {
            return json_encode([
                'message' => 'Course Not Found'
            ]);
        }
    }

    //Remove Instructor From Table
    public function removeInstructor($id)
    {
        $instructor = Instructor::find($id);

        if ($instructor != null) {
            Instructor::destroy($id);
            return [
                'Instructor Removed' => $instructor
            ];
        } else {
            return json_encode([
                'message' => 'Instructor Not Found'
            ]);
        }
    }
}
