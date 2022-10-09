<?php

namespace App\Http\Controllers\SupplierContracts;

use Illuminate\Http\Request;
use App\Models\SupplierContract;
use App\Http\Controllers\Controller;

class SupplierContractsController extends Controller
{
    public function index()
    {
        return SupplierContract::all();
    }

    //Return Specific Contract
    public function show($id)
    {
        return SupplierContract::find($id) ?? ["message" => "Contract Not Found"];
    }

    //Create New Contract
    public function store(Request $request)
    {
        $formFilds = $request->validate([
            'supplier_id' => 'required|integer',
            'course_id' => 'required|integer|unique:course_supplier_contract,course_id',
            'price' => 'required|numeric|between:0,99999.99',
            'course_state' => 'string|required',
            'course_place' => 'string|required',
        ]);


        return SupplierContract::create($formFilds);
    }

    //Delete A Contract
    public function delete($id)
    {
        if (SupplierContract::destroy($id)) {
            return ["message" => "Contract Deleted"];
        }
        return ["message" => "Contract Not Found"];
    }
}
