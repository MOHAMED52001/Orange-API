<?php

namespace App\Http\Repositories;

use App\Models\Skill;
use Illuminate\Http\Request;
use function PHPSTORM_META\map;
use App\Http\Traits\ApiResponseTrait;
use PhpParser\Node\Expr\Cast\String_;
use App\Http\Interfaces\SkillInterface;

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Skills\StoreSkillRequest;

class SkillRepository implements SkillInterface
{
    use ApiResponseTrait;

    public function index()
    {
        // return all Admins
        $skills = Skill::all();

        if (!is_null($skills)) {
            return $this->apiResponse(200, "Success", null, $skills);
        }
        return  $this->apiResponse(404, "There Is No Records In Database");
    }

    public function show($id)
    {
        $skill = Skill::find($id);

        if (!is_null($skill)) {
            return $this->apiResponse(200, "Success", null, $skill);
        }
        return  $this->apiResponse(404, "There Is No Records That Match The Given Id In Database");
    }

    public function store(StoreSkillRequest $request)
    {

        $skill = Skill::create($request->validated());

        $response = [
            'Skill' => $skill,
        ];

        return $this->apiResponse(201, "Created Successfully", null, $response);
    }

    public function update(Request $request, $id)
    {
        $skill = Skill::find($id);

        if ($skill != null) {
            //Create New Skill
            $formFilds = $request->validate([
                'skill' => 'string',
            ]);

            $skill->update($formFilds);

            $response = [
                'Skill' => $skill,
            ];

            return $this->apiResponse(200, "Updated Successfully", null, $response);
        } else {
            return  $this->apiResponse(404, "There Is No Records That Match The Given Id In Database");
        }
    }

    public function delete($id)
    {
        $skill = Skill::find($id);

        if ($skill != null) {
            Skill::destroy($id);
            $response = [
                'Skill Removed' => $skill
            ];
            return $this->apiResponse(200, "Removed Successfully", null, $response);
        } else {
            return  $this->apiResponse(404, "There Is No Records That Match The Given Id In Database");
        }
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
