<?php

namespace App\Http\Interfaces;

use Illuminate\Http\Request;


interface CourseInterface
{
    public function index();
    public function show($id);
    public function store(Request $request);
    public function update(Request $request, $id);
    public function delete($id);
    public function attachCourseSkills(Request $request, $id);
    public function updateCourseSkills($id);
    public function getSkillsAfterCompletionOfCourse($id);
    public function checkCourseHasRequiredSkills($id);
    public function getCourseStudents($id);
    public function getCourseInstructor($id);
    public function attachCourseRequireSkills(Request $request, $id);
}
