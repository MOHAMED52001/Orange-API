<?php

namespace App\Http\Interfaces;

use Illuminate\Http\Request;
use App\Http\Requests\Skills\StoreSkillRequest;

interface SkillInterface
{
    public function index();
    public function show($id);
    public function store(StoreSkillRequest $request);
    public function update(Request $request, $id);
    public function delete($id);
    public function getCoursesThatHaveSkill($id);
    public function getStudentsThatHaveSkill($id);
}
