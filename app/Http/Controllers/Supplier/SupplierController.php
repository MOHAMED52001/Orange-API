<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Interfaces\SupplierInterface;
use App\Models\Supplier;
use App\Http\Controllers\Controller;
use App\Http\Requests\Supplier\StoreSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;

class SupplierController extends Controller
{
    private SupplierInterface $supplier;
    public function __construct(SupplierInterface $supplierInterface)
    {
        $this->supplier = $supplierInterface;
    }

    //Return All Suppliers
    public function index()
    {
        return $this->supplier->index();
    }

    //Return Specific Supplier
    public function show(Supplier $supplier)
    {
        return $this->supplier->show($supplier);
    }

    //Create New Supplier 
    public function store(StoreSupplierRequest $request)
    {
        return $this->supplier->store($request);
    }

    //Update Specific Supplier
    public function update(Supplier $supplier, UpdateSupplierRequest $request)
    {
        return $this->supplier->update($supplier, $request);
    }

    //Delete Specific Supplier
    public function destroy(Supplier $supplier)
    {
        return $this->supplier->destroy($supplier);
    }

    //Get Specific Supplier Contracts
    public function supplierContracts($id)
    {
        return $this->supplier->supplierContracts($id);
    }

    //Get Supplier Contracts
    public function supplierContractsMoney($id)
    {
        return $this->supplier->supplierContractsMoney($id);
    }
}
