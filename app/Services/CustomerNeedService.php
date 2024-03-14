<?php

namespace App\Services;

use App\Models\CustomerNeed;
use Illuminate\Support\Facades\DB;



class CustomerNeedService
{
    public $customerNeedId;

    public function handleNeeds($customerDetails,$customerId,$selectedNeed)
    {
        DB::transaction(function () use ($customerDetails, $customerId,$selectedNeed) {

            $createdNeedsId = [];
            $selectedNeeds = $customerDetails['selected_needs'];

            foreach($selectedNeeds as $selectedKey => $selectedValue){
        
                $typeNumber = substr($selectedNeed,5);
                $selectedType = "N".$typeNumber;
                $advanceDetail = $selectedNeeds[$selectedNeed]['advance_details'];

                $goalTarget = isset($advanceDetail['goal_target']) ? array_values($advanceDetail['goal_target']) : NULL;
                $selectedNeeds[$selectedNeed]['advance_details']['existing_amount'] = isset($advanceDetail['existing_amount']) ? ($advanceDetail['existing_amount'] == "" ? 0.0 : $advanceDetail['existing_amount']) : NULL;
                $selectedNeeds[$selectedNeed]['advance_details']['supporting_year'] = isset($advanceDetail['supporting_years']) ? $advanceDetail['supporting_years'] : NULL;
                $advanceDetail['covered_amount_monthly'] = isset($advanceDetail['monthly_covered_amount']) ? $advanceDetail['monthly_covered_amount'] : NULL;
                $advanceDetail['remaining_year'] = isset($advanceDetail['remaining_years']) ? $advanceDetail['remaining_years'] : NULL;
                $advanceDetail['other_source'] = isset($advanceDetail['other_sources']) ? $advanceDetail['other_sources'] : NULL;
                $advanceDetail['annual_return'] = isset($advanceDetail['annual_returns']) ? $advanceDetail['annual_returns'] : NULL;

                $advanceDetail['goal_target'] = $goalTarget;
                $advanceDetail['selection'] = isset($selectedNeeds[$selectedNeed]['number_of_selection']) ? $selectedNeeds[$selectedNeed]['number_of_selection'] : NULL;

                $advanceDetail['critical_illness'] = isset($advanceDetail['critical_illness']) ? $advanceDetail['critical_illness'] : NULL;
                $advanceDetail['health_care'] = isset($advanceDetail['health_care']) ? $advanceDetail['health_care']['medical_care_plan'] : NULL;
                $advanceDetail['critical_illness_plan'] = isset($advanceDetail['critical_illness_plan']) ? $advanceDetail['critical_illness_plan'] : NULL;
                $advanceDetail['medical_care_plan'] = isset($advanceDetail['medical_care_plan']) ? $advanceDetail['health_care']['medical_care_plan'] : NULL;

                $customerNeed = CustomerNeed::updateOrCreate(
                    [
                        'customer_id' => $customerId , 'type' =>  $selectedType
                    ]
                    , $selectedNeeds[$selectedNeed]['advance_details']
                    );
                
                $createdNeedsId[] = $customerNeed->id;
            }

            $this->customerNeedId = $createdNeedsId;

        });

        return $this->customerNeedId;
    }
}