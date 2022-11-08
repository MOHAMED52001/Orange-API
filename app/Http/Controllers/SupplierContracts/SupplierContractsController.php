<?php

namespace App\Http\Controllers\SupplierContracts;

use Illuminate\Http\Request;
use App\Models\SupplierContract;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\SupplierContractsInterface;
use App\Http\Requests\Contracts\StoreContractsRequest;
use App\Http\Requests\Contracts\UpdateContractRequest;

class SupplierContractsController extends Controller
{

    private SupplierContractsInterface $supplierContract;

    public function __construct(SupplierContractsInterface $supplierContract)
    {
        $this->supplierContract = $supplierContract;
    }

    public function index()
    {
        return $this->supplierContract->index();
    }

    //Return Specific Contract
    public function show($id)
    {
        return $this->supplierContract->show($id);
    }

    //Create New Contract
    public function store(StoreContractsRequest $request)
    {
        return $this->supplierContract->store($request);
    }

    public function update($id, UpdateContractRequest $request)
    {
        return $this->supplierContract->update($id, $request);
    }

    //Delete A Contract
    public function destroy($id)
    {
        return $this->supplierContract->destroy($id);
    }
}
