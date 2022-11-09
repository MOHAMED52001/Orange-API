<?php

namespace App\Http\Controllers\Skill;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\SkillInterface;
use App\Http\Requests\Skills\StoreSkillRequest;

class SkillController extends Controller
{

    private $SkillInterface;

    public function __construct(SkillInterface $SkillInterface)
    {
        $this->SkillInterface = $SkillInterface;
    }
    public function index()
    {
        return $this->SkillInterface->index();
    }

    public function store(StoreSkillRequest $request)
    {
        return $this->SkillInterface->store($request);
    }

    public function show(Skill $skill)
    {
        return $this->SkillInterface->show($skill);
    }

    public function update(Skill $skill, Request $request)
    {
        return $this->SkillInterface->update($skill, $request);
    }

    public function destroy(Skill $skill)
    {
        return $this->SkillInterface->delete($skill);
    }

    //get Courses That BelongsTo Skill
    public function getCoursesThatHaveSkill($id)
    {
        return $this->SkillInterface->getCoursesThatHaveSkill($id);
    }

    //Get Students That BelongsTo Skill
    public function getStudentsThatHaveSkill($id)
    {
        return $this->SkillInterface->getStudentsThatHaveSkill($id);
    }
}
