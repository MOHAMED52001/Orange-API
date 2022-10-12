<?php

namespace App\Http\Interfaces;

use Illuminate\Http\Request;

interface StudentInterface
{
    public function index();
    public function store(Request $request);
    public function show($id);
    public function update(Request $request, $id);
    public function delete($id);
    public function getStudentSkills($id);
    public function getStudentCourses($id);
    public function attachNewSkills(Request $request, $id);
    public function detachSkills(Request $request, $id);
    public function enrollStudentInCourse(Request $request, $id);
    public function recommendCourses($id);
}
