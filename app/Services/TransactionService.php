<?php

namespace App\Services;

use App\Models\Agent;
use App\Models\Transaction;
use App\Models\SessionStorage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransactionService
{
    public $transactionId;

    public  function handleTransaction($customerId)
    {
        DB::transaction(function () use ($customerId) {

            // temporarily use this agent 
            $agentId = Agent::find(1)->id;
            $route = strval(request()->path());
            $id = session('transaction_id') ?? "";
            
            // dd(request()->path());

            $transaction = Transaction::updateOrCreate(
                ['id' => $id ,'customer_id' => $customerId , 'agent_id' => $agentId],
                ['page_route' => $route , 'pdpa' => session()->get('customer_details.pdpa') ?? "Accepted"]
            );
           
            // $sessionStorage = new SessionStorage();
            // $route = strval(request()->path());
            // $sessionId = $request->session()->getId();
            // $transactionId = $request->input('transaction_id') ?? '';

            // $sessionStorage->data = $customerDetails;
            // $sessionStorage->page_route = $route;
            // $sessionStorage->session_id = $sessionId;
            // $sessionStorage->customer_name = $customerDetails['basic_details']['full_name'] ??'';

            //check transaction id ,if not found ,use  session id        
            // if(!empty($transactionId))
            // {
            //     $formData = SessionStorage::findTransactionId($transactionId)->get();
            // }
            // else
            // {
            //     $formData = SessionStorage::findSessionId($sessionId)->get();
            // }

            // if ($formData->isNotEmpty()) {
            //     static::updateTransaction($formData, $sessionStorage,$customerDetails);
            // } else {
            //     static::insertTransaction($sessionStorage);
            // }

            $this->transactionId = $transaction->id;
        });

        return $this->transactionId;
    }

    // private static function updateTransaction($formData, $sessionStorage,$customerDetails)
    // {
    //     $decodedForm = json_decode($formData,true);

    //     foreach ($decodedForm[0]['data'] as $databaseExistingKey => $databaseValue) {
            
    //         if (array_key_exists($databaseExistingKey, $customerDetails)) {
    //             // Update only if the key exists in the first array
    //             $decodedForm[0]['data'][$databaseExistingKey] = $customerDetails[$databaseExistingKey];
    //         }  
    //         else
    //         {
    //             $decodedForm[0]['data'][$databaseExistingKey] = $databaseValue;
    //         }
    //     }

    //     foreach($customerDetails as $customerKey => $customerValue)
    //     {
    //         if(!array_key_exists ($customerKey,$decodedForm[0]['data']))
    //         {
    //             $decodedForm[0]['data'][$customerKey] = $customerValue;
    //         }
    //     }

    //     SessionStorage::where('transaction_id', $formData[0]['transaction_id'])
    //         ->update([
    //             'data' => $decodedForm[0]['data'],
    //             'page_route' => $sessionStorage->page_route,
    //             'session_id' => $sessionStorage->session_id,
    //             'customer_name' => $decodedForm[0]['data']['basic_details']['full_name'] ?? "",
    //             'customer_id' => $formData[0]['customer_id'] && isset($sessionStorage->data['identity_details']['id_number'])  
    //                              ? $sessionStorage->data['identity_details']['id_number'] 
    //                              : NULL,
    //         ]);
    // }

    // private static function insertTransaction($sessionStorage)
    // {
    //     $currentValue = SessionStorage::withTrashed()->max('transaction_id', 1000) ?? 1000;
    //     $newValue = $currentValue + 1;
    //     $sessionStorage->transaction_id = $newValue;

    //     // $maxId = SessionStorage::withTrashed()->max('id');
        
    //     $sessionStorage->save();
    // }
}
