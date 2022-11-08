<?php

namespace App\Http\Interfaces;

use App\Models\SupplierContract;
use App\Http\Requests\Contracts\StoreContractsRequest;
use App\Http\Requests\Contracts\UpdateContractRequest;

interface SupplierContractsInterface
{
    public function index();
    public function show($id);
    public function store(StoreContractsRequest $request);
    public function update($id, UpdateContractRequest $request);
    public function destroy($id);
}
