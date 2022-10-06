<?php

namespace App\Http\Controllers\Skill;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return json_encode([
            'Skills' =>  Skill::all()
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
        $skill = Skill::find($id);

        if ($skill != null) {
            return json_encode([
                'Skill' => $skill
            ]);
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

    //get Courses That BelongsTo Skill
    public function getCoursesThatHaveSkill($id)
    {
        $skill = Skill::find($id);

        if ($skill != null) {
            $courses = $skill->courses;

            if (count($courses) == 0) {
                return json_encode([
                    'message' => "This Skill does not BelongsTo Any Courses"
                ]);
            } else {
                return json_encode([
                    'Courses' => $courses
                ]);
            }
        } else {
            return json_encode([
                'message' => 'Skill Not Found'
            ]);
        }
    }

    //Get Students That BelongsTo Skill
    public function getStudentsThatHaveSkill($id)
    {
        $skill = Skill::find($id);

        if ($skill != null) {
            $students = $skill->students;

            if (count($students) == 0) {
                return json_encode([
                    'message' => "This Skill does not BelongsTo Any Students"
                ]);
            } else {
                return json_encode([
                    'Students' => $students
                ]);
            }
        } else {
            return json_encode([
                'message' => 'Skill Not Found'
            ]);
        }
    }
}
