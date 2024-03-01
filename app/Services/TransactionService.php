<?php

namespace App\Services;

use App\Models\Agent;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransactionService
{
    public $transactionId;

    public  function handleTransaction($customerId)
    {
        DB::transaction(function () use ($customerId) {

            if (!isset($customerId)) {
                return false;
            }

            // temporarily use this agent 
            $agentId = Agent::find(1)->id;
            $route = strval(request()->path());
            $id = session('transaction_id') ?? "";
            
            $transaction = Transaction::updateOrCreate(
                ['id' => $id ,'customer_id' => $customerId , 'agent_id' => $agentId],
                ['page_route' => $route , 'pdpa' => session()->get('customer_details.pdpa') ?? "Accepted"]
            );
            $this->transactionId = $transaction->id;
        });

        return true;

        // return $this->transactionId;
    }

}
