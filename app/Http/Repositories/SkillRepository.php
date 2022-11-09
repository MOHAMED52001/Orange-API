<?php

namespace App\Http\Repositories;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Interfaces\SkillInterface;
use App\Http\Requests\Skills\StoreSkillRequest;

class SkillRepository implements SkillInterface
{
    use ApiResponseTrait;

    public function index()
    {
        return $this->apiResponse(200, "Success", null, Skill::all());
    }

    public function show(Skill $skill)
    {
        return $this->apiResponse(200, "Success", null, $skill);
    }

    public function store(StoreSkillRequest $request)
    {
        $skill = Skill::create($request->validated());

        return $this->apiResponse(201, "Created Successfully", null, $skill);
    }

    public function update(Skill $skill, Request $request)
    {
        $formFilds = $request->validate([
            'skill' => 'string',
        ]);

        $skill->update($formFilds);

        return $this->apiResponse(200, "Updated Successfully", null, $skill);
    }

    public function delete(Skill $skill)
    {
        Skill::destroy($skill->id);
        return $this->apiResponse(200, "Removed Successfully", null, $skill);
    }
    public function getCoursesThatHaveSkill($id)
    {
        $skill = Skill::find($id);

        if ($skill != null) {
            $courses = $skill->courses;

            if (count($courses) == 0) {

                return $this->apiResponse(200, "This Skill does not BelongsTo Any Courses");
            } else {
                $response = [
                    'Courses' => $courses
                ];
                return $this->apiResponse(200, "Found Records Successfully", null, $response);
            }
        } else {
            return  $this->apiResponse(404, "There Is No Records That Match The Given Id In Database");
        }
    }

    public function getStudentsThatHaveSkill($id)
    {
        $skill = Skill::find($id);

        if ($skill != null) {
            $students = $skill->students;

            if (count($students) == 0) {
                return $this->apiResponse(200, "This Skill does not BelongsTo Any Students");
            } else {
                $response = [
                    'Students' => $students
                ];
                return $this->apiResponse(200, "Found Records Successfully", null, $response);
            }
        } else {
            return  $this->apiResponse(404, "There Is No Records That Match The Given Id In Database");
        }
    }
}
