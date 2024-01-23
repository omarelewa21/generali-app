<?php

namespace App\Services;

use App\Models\SessionStorage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransactionService
{
    public static function handleTransaction($request, $customerDetails)
    {
        try {
            DB::transaction(function () use ($request, $customerDetails) {
                $sessionStorage = new SessionStorage();
                $route = strval(request()->path());
                $sessionId = $request->session()->getId();

                $sessionStorage->data = $customerDetails;
                $sessionStorage->page_route = $route;
                $sessionStorage->session_id = $sessionId; 

                $formData = SessionStorage::findTransactionId($request->input('transaction_id'))->get();
                //form data is initial data
                //sesionstorage is new data


                if ($formData->isNotEmpty()) {
                    static::updateTransaction($formData, $sessionStorage,$customerDetails);
                } else {
                    static::insertTransaction($sessionStorage);
                }
            });
        } catch (\Exception $e) {
            Log::debug($e);
            DB::rollBack();
        }
    }

    private static function updateTransaction($formData, $sessionStorage,$customerDetails)
    {
        $decodedForm = json_decode($formData,true);
      
        foreach ($customerDetails as $key => $value) {
            
            if (array_key_exists($key, $decodedForm[0]['data'])) {
                // Update only if the key exists in the first array
                $decodedForm[0]['data'][$key] = $value;
            }
        }

        SessionStorage::where('transaction_id', $formData[0]['transaction_id'])
            ->update([
                'data' => $decodedForm ? $sessionStorage->data : "",
                'page_route' => $sessionStorage->page_route,
                'customer_name' => $sessionStorage->data['basic_details']['full_name'] ?? "",
                'customer_id' => $formData[0]['customer_id'] ? $sessionStorage->data['identity_details']['id_number'] : "",
            ]);
    }

    private static function insertTransaction($sessionStorage)
    {
        $currentValue = SessionStorage::withTrashed()->max('transaction_id', 1000) ?? 1000;
        $newValue = $currentValue + 1;
        $sessionStorage->transaction_id = $newValue;

        // $maxId = SessionStorage::withTrashed()->max('id');
        
        $sessionStorage->save();
    }
}
