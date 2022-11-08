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
    public function show($id)
    {
        $supplierContract = SupplierContract::findOrFail($id);
        return $this->apiResponse(200, "Found Results", null, $supplierContract);
    }
    public function store(StoreContractsRequest $request)
    {
        return $this->apiResponse(201, "Created Successfully", null, SupplierContract::create($request->validated()));
    }
    public function update($id, UpdateContractRequest $request)
    {
        $contract = SupplierContract::findOrFail($id);

        $contract->update($request->validated());

        return $this->apiResponse(200, "Updated Successfully", null, $contract);
    }
    public function destroy($id)
    {
        $contract = SupplierContract::findOrFail($id);

        SupplierContract::destroy($contract->id);

        return $this->apiResponse(200, "Deleted Successfully", null, $contract);
    }
}
