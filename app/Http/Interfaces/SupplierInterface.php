<?php

namespace App\Http\Interfaces;

use App\Http\Requests\Supplier\StoreSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;
use App\Models\Supplier;

interface SupplierInterface
{
    public function index();
    public function show(Supplier $supplier);
    public function store(StoreSupplierRequest $request);
    public function update(Supplier $supplier, UpdateSupplierRequest $request);
    public function destroy(Supplier $supplier);
    public function supplierContracts($id);
    public function supplierContractsMoney($id);
}
