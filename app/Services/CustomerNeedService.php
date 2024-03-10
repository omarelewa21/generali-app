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
                $coveredAmountMonthly = null;
                $supportingYears = null;
                $existingAmount = null;
                $existingPolicy = null;
                $insuranceAmount = null;
                $fundPercentage = null;
                $goalsAmount = null;
                $childName = null;
                $spousename = null;
                $childDob = null;
                $spouseDob = null;

                $typeNumber = substr($selectedKey,5);
                $selectedType = "N".$typeNumber;
        
                if (isset($selectedNeeds[$selectedKey]['advance_details'])) {
                    $relationship = $selectedNeeds[$selectedKey]['advance_details']['relationship'] ?? null;
                    $coveredAmount =  $selectedNeeds[$selectedKey]['advance_details']['covered_amount'] ?? null;
                    $coveredAmountMonthly = $selectedNeeds[$selectedKey]['advance_details']['covered_amount_monthly'] ?? null;
                    $supportingYears = $selectedNeeds[$selectedKey]['advance_details']['supporting_years'] ?? null;
                    $existingAmount =  $selectedNeeds[$selectedKey]['advance_details']['existing_amount'] ?? null;
                    $existingPolicy =  $selectedNeeds[$selectedKey]['advance_details']['existing_policy'] ?? null;
                    $insuranceAmount = $selectedNeeds[$selectedKey]['advance_details']['insurance_amount'] ?? null;
                    $fundPercentage = $selectedNeeds[$selectedKey]['advance_details']['fund_percentage'] ?? null;
                    $goalsAmount = $selectedNeeds[$selectedKey]['advance_details']['goals_amount'] ?? null;

                    $childName = $selectedNeeds[$selectedKey]['advance_details']['child_name'] ?? null;
                    $spousename = $selectedNeeds[$selectedKey]['advance_details']['spouse_name'] ?? null;
                    $childDob = $selectedNeeds[$selectedKey]['advance_details']['child_dob'] ?? null;
                    $spouseDob = $selectedNeeds[$selectedKey]['advance_details']['spouse_dob'] ?? null;

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
                        'covered_amount_monthly' => $coveredAmountMonthly,
                        'supporting_year' => $supportingYears,
                        'existing_amount' => $existingAmount,
                        'existing_policy' => $existingPolicy,
                        'insurance_amount' => $insuranceAmount,
                        'fund_percentage' => $fundPercentage,
                        'goals_amount' => $goalsAmount,
                        'child_name' => $childName,
                        'spouse_name' => $spousename,
                        'child_dob' => $childDob,
                        'spouse_dob' => $spouseDob,
                    ]
                    );


                $createdNeedsId[] = $customerNeed->id;
            }

            $this->customerNeedId = $createdNeedsId;

        });

        return $this->customerNeedId;
    }
}