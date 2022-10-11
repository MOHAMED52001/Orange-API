<?php

namespace App\Http\Controllers\Transaction;

use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\SupplierContract;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\TransactionsInterface;

class TransactionController extends Controller
{
    private $TransactionInterface;

    public function __construct(TransactionsInterface $transaction)
    {
        $this->TransactionInterface = $transaction;
    }
    //Return All Transaction
    public function index()
    {
        return $this->TransactionInterface->index();
    }

    //Add New Transaction For Specific Contract
    public function store(Request $request)
    {
        return $this->TransactionInterface->store($request);
    }
    //get Contract Transactions
    public function getContractTransactions($id)
    {
        return $this->TransactionInterface->getContractTransactions($id);
    }
}
