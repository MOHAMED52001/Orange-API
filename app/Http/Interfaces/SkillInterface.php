<?php

namespace App\Http\Interfaces;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Requests\Skills\StoreSkillRequest;

interface SkillInterface
{
    public function index();
    public function show(Skill $skill);
    public function store(StoreSkillRequest $request);
    public function update(Skill $skill, Request $request);
    public function delete(Skill $skill);
    public function getCoursesThatHaveSkill($id);
    public function getStudentsThatHaveSkill($id);
}
