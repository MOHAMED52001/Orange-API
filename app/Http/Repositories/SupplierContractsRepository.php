<?php

namespace App\Http\Repositories;

use App\Models\SupplierContract;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Interfaces\SupplierContractsInterface;
use App\Http\Requests\Contracts\StoreContractsRequest;
use App\Http\Requests\Contracts\UpdateContractRequest;

class SupplierContractsRepository implements SupplierContractsInterface
{
    use ApiResponseTrait;
    public function index()
    {
        return $this->apiResponse(200, "Found Results", null, SupplierContract::all());
    }
    public function show(SupplierContract $contract)
    {
        return $this->apiResponse(200, "Found Results", null, $contract);
    }
    public function store(StoreContractsRequest $request)
    {
        return $this->apiResponse(201, "Created Successfully", null, SupplierContract::create($request->validated()));
    }
    public function update(SupplierContract $contract, UpdateContractRequest $request)
    {
        $contract->update($request->validated());

        return $this->apiResponse(200, "Updated Successfully", null, $contract);
    }
    public function destroy(SupplierContract $contract)
    {
        SupplierContract::destroy($contract->id);

        return $this->apiResponse(200, "Deleted Successfully", null, $contract);
    }
}
