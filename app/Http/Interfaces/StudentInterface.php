<?php

namespace App\Http\Interfaces;

use Illuminate\Http\Request;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;

interface StudentInterface
{
    public function index();
    public function store(StoreStudentRequest $request);
    public function show(Student $student);
    public function update(Student $student, UpdateStudentRequest $request);
    public function delete($id);
    public function getStudentSkills($id);
    public function getStudentCourses($id);
    public function attachNewSkills(Request $request, $id);
    public function detachSkills(Request $request, $id);
    public function enrollStudentInCourse(Request $request, $id);
    public function recommendCourses($id);
}
