<?php

namespace App\Services;

use App\Models\CustomerNeed;
use Illuminate\Support\Facades\DB;



class CustomerNeedService
{
    public $customerNeedId;

    public function handleNeeds($customerDetails,$customerId)
    {
        DB::transaction(function () use ($customerDetails, $customerId) {

            $createdNeedsId = [];
            $selectedNeeds = $customerDetails['selected_needs'];
            

            foreach($selectedNeeds as $selectedKey => $selectedValue){
                $relationship = null;
                $coveredAmount = null;
                $supportingYears = null;
                $existingAmount = null;
                $existingPolicy = null;
                $insuranceAmount = null;
                $fundPercentage = null;

                $selectedType = $selectedNeeds[$selectedKey]['need_no'];
        
                if (isset($selectedNeeds[$selectedKey]['advance_details'])) {
                    $relationship = $selectedNeeds[$selectedKey]['advance_details']['relationship'] ?? null;
                    $coveredAmount =  $selectedNeeds[$selectedKey]['advance_details']['covered_amount'] ?? null;
                    $supportingYears = $selectedNeeds[$selectedKey]['advance_details']['supporting_years'] ?? null;
                    $existingAmount =  $selectedNeeds[$selectedKey]['advance_details']['existing_amount'] ?? null;
                    $existingPolicy =  $selectedNeeds[$selectedKey]['advance_details']['existing_policy'] ?? null;
                    $insuranceAmount = $selectedNeeds[$selectedKey]['advance_details']['insurance_amount'] ?? null;
                    $fundPercentage = $selectedNeeds[$selectedKey]['advance_details']['fund_percentage'] ?? null;

                    if($existingAmount == "")
                    {
                        $existingAmount = 0.0;
                    }
                }

                $customerNeed = CustomerNeed::updateOrCreate(
                    [
                    'customer_id' => $customerId , 'type' =>  $selectedType
                    ],
                    [
                        'relationship' => $relationship,
                        'covered_amount' => $coveredAmount,
                        'supporting_year' => $supportingYears,
                        'existing_amount' => $existingAmount,
                        'existing_policy' => $existingPolicy,
                        'insurance_amount' => $insuranceAmount,
                        'fund_percentage' => $fundPercentage
                    ]
                    );


                $createdNeedsId[] = $customerNeed->id;
            }

            $this->customerNeedId = $createdNeedsId;

        });

        return $this->customerNeedId;
    }
}