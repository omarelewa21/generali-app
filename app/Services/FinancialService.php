<?php

namespace App\Services;

use App\Models\FinancialStatement;
use Illuminate\Support\Facades\DB;



class FinancialService
{
    public $financialId;

    public function handleFinancialStatement($customerId,$transactionId,$customerDetails)
    {
        DB::transaction(function () use ($customerId, $transactionId,$customerDetails) {

            // $createdNeedsId = [];
            $updateData = [];

            $financialDetails = $customerDetails['financialStatement'];

            foreach ($financialDetails as $key => $value) {

                if(in_array($key,['amountAvailable','isChangeinAmount','approximateIncrementAmount']))
                {
                    switch ($key) {
                    case 'amountAvailable':
                        $updateData['amount_available'] = $value;
                        break;
                    case 'isChangeinAmount':
                        $updateData['change_in_amount'] = $value;
                        break;
                    case 'approximateIncrementAmount':
                        $updateData['increment_amount'] = $value;
                        break;
                    }
                }
            }

            $customerFinancial = FinancialStatement::updateOrCreate(
                ['customer_id' => $customerId , 'transaction_id' =>  $transactionId ], $updateData
            );

            $this->financialId = $customerFinancial;

        });

        return $this->financialId;
    }
}