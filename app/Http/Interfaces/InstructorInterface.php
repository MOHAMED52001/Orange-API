<?php

namespace App\Http\Interfaces;

use Illuminate\Http\Request;


interface InstructorInterface
{
    public function index();
    public function store(Request $request);
    public function show($id);
    public function update(Request $request, $id);
    public function delete($id);
    public function getCoursesThatBelongToInstructor($id);
}
