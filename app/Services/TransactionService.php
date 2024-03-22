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
            $previousRoute = session('_previous') ?? NULL;

            if (isset($previousRoute)) {
                $url = $previousRoute['url'];
                $path = parse_url($url, PHP_URL_PATH);
                $cleanPath = ltrim($path, '/'); // Remove leading slash
                $route = $cleanPath;
            }

            $id = session('transaction_id') ?? session('customer_details.transaction_id') ?? "";
            
            $transaction = Transaction::updateOrCreate(
                ['id' => $id ,'customer_id' => $customerId , 'agent_id' => $agentId],
                ['page_route' => $route , 'pdpa' => session()->get('customer_details.pdpa') ?? "Accepted"]
            );
            $this->transactionId = $transaction->id;
        });

        // return true;

        return $this->transactionId;
    }

}
