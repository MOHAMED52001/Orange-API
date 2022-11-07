<?php

namespace App\Http\Interfaces;

use App\Models\Transaction;
use Illuminate\Http\Request;

interface TransactionsInterface
{
    public function index();
    public function store(Request $request);
    public function show(Transaction $transaction);
    public function getContractTransactions($id);
}
