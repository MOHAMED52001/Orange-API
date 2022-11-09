<?php

namespace App\Http\Interfaces;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Requests\Courses\StoreCourseRequest;
use App\Http\Requests\Courses\UpdateCourseRequest;


interface CourseInterface
{
    public function index();
    public function show(Course $course);
    public function store(StoreCourseRequest $request);
    public function update(Course $course, UpdateCourseRequest $request);
    public function delete(Course $course);
    public function attachCourseSkills(Request $request, $id);
    public function updateCourseSkills($id);
    public function getSkillsAfterCompletionOfCourse($id);
    public function checkCourseHasRequiredSkills($id);
    public function getCourseStudents($id);
    public function getCourseInstructor($id);
    public function attachCourseRequireSkills(Request $request, $id);
}
