<?php

namespace App\Http\Interfaces;

use Illuminate\Http\Request;

interface AdminInterface
{
    public function index();
    public function store(Request $request);
    public function show($id);
    public function update(Request $request, $id);
    public function delete($id);

    public function login(Request $request);
    public function logout();
}
