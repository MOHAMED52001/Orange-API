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

    public function show($id)
    {
        return $this->SkillInterface->show($id);
    }

    public function update(Request $request, $id)
    {
        return $this->SkillInterface->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->SkillInterface->delete($id);
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
