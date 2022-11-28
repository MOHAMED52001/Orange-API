<?php

namespace App\Http\Interfaces;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;

interface AdminInterface
{
    public function index();
    public function show(User $user);
    public function store(StoreAdminRequest $request);
    public function update(User $admin, UpdateAdminRequest $request);
    public function destroy(User $admin);
}