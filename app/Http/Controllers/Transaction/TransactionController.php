<?php

namespace App\Http\Controllers\Transaction;

use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\SupplierContract;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    //Return All Transaction
    public function index()
    {
        return Transaction::all();
    }

    //Add New Transaction For Specific Contract
    public function store(Request $request)
    {

        $formFilds = $request->validate([
            'contract_id' => 'required|integer',
            'paid_amount' => 'required|numeric|between:0,99999.99',
        ]);

        $contract = SupplierContract::find($request->contract_id);

        $last_transaction = Transaction::where('contract_id', $request->contract_id)
            ->orderBy('paid_at', 'desc')
            ->first();


        //Check If The Price Of The Course Is Paid
        if ($last_transaction != null && $last_transaction->amount_left == 0) {
            return [
                "message" => "The Price Of The Contract Had Been Paid"
            ];
        } else {

            //Load The Transactions of The Contract And Get The Sum Of The Amount Paid

            $last_transactions = Transaction::where('contract_id', $request->contract_id)->get('paid_amount');
            $sum = 0;
            foreach ($last_transactions as $transaction) {
                $sum += $transaction->paid_amount;
            }

            //If The Money Paid Is Grater than The Price Of The Course
            if ($request->paid_amount > $contract->price) {

                $formFilds['amount_left'] = 0;

                Transaction::create($formFilds);

                return [
                    "message" => "The Price Of The Contract Had Been Paid And There Was Extra Paid Money: "
                        . $request->paid_amount - $contract->price . "$"
                ];
            }
            //There Some Clculation
            else {

                //Calculate The Money Left Amount Of The Course
                if ($last_transaction == null) {
                    //
                    $amount_left = $contract->price - $formFilds['paid_amount'];
                } else {

                    $amount_left = $contract->price - ($formFilds['paid_amount'] + $sum);
                }


                if ($amount_left <= 0) {
                    $formFilds['amount_left'] = 0;

                    return [
                        "Transaction" => Transaction::create($formFilds),
                        "message" => "The Price Of The Contract Had Been Paid And There Was Extra Paid Money: "
                            . ($amount_left * -1) . "$"
                    ];
                } else {
                    $formFilds['amount_left'] = $amount_left;
                    return Transaction::create($formFilds);
                }
            }
        }
    }
    //get Contract Transactions
    public function getContractTransactions($id)
    {
        $ContractInfo =  SupplierContract::with('transactions')->find($id);

        if ($ContractInfo == null) {
            return [
                "message" => "There Is No Contract Available For This Id"
            ];
        }

        if (count($ContractInfo->transactions) == 0)
            return [
                "message" => "There Is No Contract Transactions Available For This Id"
            ];

        else {
            return $ContractInfo;
        }
    }
}
