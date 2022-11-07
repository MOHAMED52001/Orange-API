<?php

namespace App\Http\Controllers\Supplier;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\SupplierContract;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{

    //Return All Suppliers
    public function index()
    {
        return Supplier::all();
    }

    //Return Specific Supplier
    public function show($id)
    {
        return Supplier::find($id) ?? ["message" => "Supplier Not Found"];
    }

    //Create New Supplier 
    public function store(Request $request)
    {
        $formFilds = $request->validate([
            'name' => 'string|unique:suppliers,name'
        ]);

        return Supplier::create($formFilds);
    }

    //Update Specific Supplier
    public function update(Request $request, $id)
    {
        $formFilds = $request->validate([
            'name' => 'required|string'
        ]);

        $supplier = Supplier::find($id);

        if ($supplier == null) {
            return ["message" => "Supplier does not exist"];
        }
        $supplier->update($formFilds);

        return $supplier;
    }

    //Delete Specific Supplier
    public function destroy($id)
    {
        Supplier::destroy($id);
    }

    //Get Specific Supplier Contracts
    public function supplierContracts($id)
    {

        $supplier_contracts = Supplier::with('contracts')->find($id);
        if ($supplier_contracts == null) {
            return ["message" => "Supplier does not exist"];
        }
        return $supplier_contracts;
    }

    //Get Supplier Contracts
    public function supplierContractsMoney($id)
    {
        $supplier = Supplier::with('transactions')->find($id);

        if ($supplier == null) {
            return ["message" => "Supplier does not exist"];
        }

        $totalCoursesMoney = 0;

        foreach ($supplier->contracts as $key => $contract) {
            $totalCoursesMoney += $contract->price;
        }

        $totalPaid = 0;
        foreach ($supplier->transactions as $key => $transaction) {
            $totalPaid += $transaction->paid_amount;
        }

        return [
            'Received Money' => $totalPaid,
            'Money Owed' => $totalCoursesMoney
        ];
    }
}
