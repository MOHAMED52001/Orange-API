<?php

namespace App\Http\Repositories;

use App\Models\Supplier;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Interfaces\SupplierInterface;
use App\Http\Requests\Supplier\StoreSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;

class SupplierRepository implements SupplierInterface
{

    use ApiResponseTrait;

    public function index()
    {
        return $this->apiResponse(200, "Found Suppliers", null, Supplier::all());
    }

    public function show(Supplier $supplier)
    {
        return $this->apiResponse(200, "Found Supplier", null, $supplier);
    }

    public function store(StoreSupplierRequest $request)
    {
        $supplier = Supplier::create($request->validated());
        return $this->apiResponse(201, "Created Supplier", null, $supplier);
    }

    public function update(Supplier $supplier, UpdateSupplierRequest $request)
    {
        $supplier->update($request->validated());
        return $this->apiResponse(200, "updated Supplier", null, $supplier);
    }

    public function destroy(Supplier $supplier)
    {
        Supplier::destroy($supplier->id);
        return $this->apiResponse(200, "Deleted Supplier", null, $supplier->name);
    }

    public function supplierContracts($id)
    {
        $supplier = Supplier::find($id);
        if ($supplier == null) {
            return $this->apiResponse(404, "Not Found", null, "Object not found");
        }

        if (count($supplier->contracts) == 0) {
            return $this->apiResponse(404, "No Contracts", null, "There Is No Contracts Available");
        }

        return $this->apiResponse(200, "Found Contracts", null, $supplier->contracts);
    }

    public function supplierContractsMoney($id)
    {
        $supplier = Supplier::with('transactions')->find($id);

        if ($supplier == null) {
            return $this->apiResponse(404, "Not Found", null, "Object not found");
        }

        $totalCoursesMoney = 0;

        foreach ($supplier->contracts as $key => $contract) {
            $totalCoursesMoney += $contract->price;
        }

        $totalPaid = 0;
        foreach ($supplier->transactions as $key => $transaction) {
            $totalPaid += $transaction->paid_amount;
        }

        $response =  [
            'Received Money' => $totalPaid,
            'Money Owed' => $totalCoursesMoney
        ];
        return $this->apiResponse(200, "Found Transactions", null, $response);
    }
}
