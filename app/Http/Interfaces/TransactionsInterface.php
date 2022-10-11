<?php

namespace App\Http\Interfaces;

use Illuminate\Http\Request;

interface TransactionsInterface
{
    public function index();
    public function store(Request $request);
    public function getContractTransactions($id);
}
