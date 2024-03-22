<?php

namespace App\Services;

use App\Models\ExistingPolicy;
use Illuminate\Support\Facades\DB;

class ExistingPolicyService
{
    public $existingPolicyId;

    public  function handleExistingPolicy($customerId,$transactionId,$customerDetails)
    {
        DB::transaction(function () use ($customerId,$transactionId,$customerDetails) {

            if (!isset($customerId)) {
                return false;
            }

            $createdExistingPolicy = [];

            $customerExistingPolicy = $customerDetails['existing_policy'];

            foreach ($customerExistingPolicy as $epKey => $epValue) {

                $role = $epValue['role'] ?? NULL;
                $fullName = $epValue['full_name'] ?? NULL;

                $existingPolicy = ExistingPolicy::updateOrCreate(
                    [
                        'customer_id' => $customerId , 'transaction_id' => $transactionId, 'role' => $role, 'full_name' => $fullName
                    ]
                    , $customerExistingPolicy[$epKey]               
                );

                $createdExistingPolicy[] = $existingPolicy->id;
            }
    
            $this->existingPolicyId = $createdExistingPolicy;
        });

        return $this->existingPolicyId;
    }

}
