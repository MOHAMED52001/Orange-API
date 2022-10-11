<?php

namespace App\Http\Repositories;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\SupplierContract;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Validator;
use App\Http\Interfaces\TransactionsInterface;

class TransactionsRepository implements TransactionsInterface
{
    use ApiResponseTrait;

    public function index()
    {
        $tarnsactions = Transaction::all();
        if (!is_null($tarnsactions)) {
            return $this->apiResponse(200, "Success", null, $tarnsactions);
        }
        return  $this->apiResponse(200, "There Is No Records That Match The Given Id In Database");
    }

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
            return  $this->apiResponse(200, "The Price Of The Contract Had Been Paid");
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

                $transaction = Transaction::create($formFilds);
                return  $this->apiResponse(200, "The Price Of The Contract Had Been Paid And There Was Extra Paid Money: "
                    . $request->paid_amount - $contract->price . "$", null, $transaction);
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

                    $transaction = Transaction::create($formFilds);

                    return  $this->apiResponse(200, "The Price Of The Contract Had Been Paid And There Was Extra Paid Money: "

                        .  ($amount_left * -1) . "$", null, $transaction);
                } else {

                    $formFilds['amount_left'] = $amount_left;

                    $transaction =  Transaction::create($formFilds);

                    return  $this->apiResponse(200, "Money Paid Successfully", $transaction);
                }
            }
        }
    }

    public function getContractTransactions($id)
    {
        $ContractInfo =  SupplierContract::with('transactions')->find($id);

        if ($ContractInfo == null) {
            return  $this->apiResponse(200, "There Is No Records That Match The Given Id In Database");
        }

        if (count($ContractInfo->transactions) == 0)

            return  $this->apiResponse(200, "There Is No Contract Transactions Available For This Id");

        else {
            return  $this->apiResponse(200, "We Found Transactions Of This Contract", null, $ContractInfo);
        }
    }
}
