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
                $selectedNeeds[$selectedNeed]['advance_details']['covered_amount_monthly'] = isset($advanceDetail['monthly_covered_amount']) ? $advanceDetail['monthly_covered_amount'] : NULL;
                $selectedNeeds[$selectedNeed]['advance_details']['remaining_year'] = isset($advanceDetail['remaining_years']) ? $advanceDetail['remaining_years'] : NULL;
                $selectedNeeds[$selectedNeed]['advance_details']['other_source'] = isset($advanceDetail['other_sources']) ? $advanceDetail['other_sources'] : NULL;
                $selectedNeeds[$selectedNeed]['advance_details']['other_sources_custom'] = isset($advanceDetail['other_sources_custom']) ? $advanceDetail['other_sources_custom'] : NULL;
                $selectedNeeds[$selectedNeed]['advance_details']['existing_fund'] = isset($advanceDetail['existing_fund']) ? $advanceDetail['existing_fund'] : NULL;

                $selectedNeeds[$selectedNeed]['advance_details']['annual_return'] = isset($advanceDetail['annual_returns']) ? $advanceDetail['annual_returns'] : NULL;

        
                $selectedNeeds[$selectedNeed]['advance_details']['risk_profile'] = isset($customerDetails['risk_profile']['selected_risk_profile']) ? $customerDetails['risk_profile']['selected_risk_profile'] : NULL;
                $selectedNeeds[$selectedNeed]['advance_details']['potential_return'] = isset($customerDetails['risk_profile']['selected_potential_return']) ? $customerDetails['risk_profile']['selected_potential_return'] : NULL;

                $advanceDetail['goal_target'] = $goalTarget;
                

                if ($selectedNeed == 'need_6' )  {
                    $selectedNeeds[$selectedNeed]['advance_details']['critical_illness_plan'] = isset($advanceDetail['critical_illness']['critical_illness_plan']) ? $advanceDetail['critical_illness']['critical_illness_plan'] : NULL;
                    $selectedNeeds[$selectedNeed]['advance_details']['relationship'] = isset($advanceDetail['critical_illness']['relationship']) ? $advanceDetail['critical_illness']['relationship'] : NULL;
                    $selectedNeeds[$selectedNeed]['advance_details']['child_dob'] = isset($advanceDetail['critical_illness']['child_dob']) ? $advanceDetail['critical_illness']['child_dob'] : NULL;
                    $selectedNeeds[$selectedNeed]['advance_details']['child_name'] = isset($advanceDetail['critical_illness']['child_name']) ? $advanceDetail['critical_illness']['child_name'] : NULL;
                    $selectedNeeds[$selectedNeed]['advance_details']['spouse_name'] = isset($advanceDetail['critical_illness']['spouse_name']) ? $advanceDetail['critical_illness']['spouse_name'] : NULL;
                    $selectedNeeds[$selectedNeed]['advance_details']['spouse_dob'] = isset($advanceDetail['critical_illness']['spouse_dob']) ? $advanceDetail['critical_illness']['spouse_dob'] : NULL;
                    $selectedNeeds[$selectedNeed]['advance_details']['covered_amount'] = isset($advanceDetail['critical_illness']['covered_amount']) ? $advanceDetail['critical_illness']['covered_amount'] : NULL;
                    $selectedNeeds[$selectedNeed]['advance_details']['supporting_year'] = isset($advanceDetail['critical_illness']['year']) ? $advanceDetail['critical_illness']['year'] : NULL;
                    $selectedNeeds[$selectedNeed]['advance_details']['existing_amount'] = isset($advanceDetail['critical_illness']['existing_amount']) ? $advanceDetail['critical_illness']['existing_amount'] : NULL;
                    $selectedNeeds[$selectedNeed]['advance_details']['goals_amount'] = isset($advanceDetail['critical_illness']['goals_amount']) ? $advanceDetail['critical_illness']['goals_amount'] : NULL;
                    $selectedNeeds[$selectedNeed]['advance_details']['fund_percentage'] = isset($advanceDetail['critical_illness']['fund_percentage']) ? $advanceDetail['critical_illness']['fund_percentage'] : NULL;
                    $selectedNeeds[$selectedNeed]['advance_details']['selection'] = isset($selectedNeeds[$selectedNeed]['number_of_selection']) ? $selectedNeeds[$selectedNeed]['number_of_selection'] : NULL;
                    $selectedNeeds[$selectedNeed]['advance_details']['critical_illness']['critical_illness_plan'] = isset($advanceDetail['critical_illness']['critical_illness_plan']) ? $advanceDetail['critical_illness']['critical_illness_plan'] : NULL;
                    $selectedNeeds[$selectedNeed]['advance_details']['health_care']['medical_care_plan'] = isset($advanceDetail['health_care']['medical_care_plan']) ? $advanceDetail['health_care']['medical_care_plan'] : NULL;
                }

                if($selectedNeed == 'need_7')
                {
                    $selectedNeeds[$selectedNeed]['advance_details']['relationship'] = isset($advanceDetail['relationship']) ? $advanceDetail['relationship'] : NULL;
                    $selectedNeeds[$selectedNeed]['advance_details']['child_dob'] = isset($advanceDetail['child_dob']) ? $advanceDetail['child_dob'] : NULL;
                    $selectedNeeds[$selectedNeed]['advance_details']['child_name'] = isset($advanceDetail['child_name']) ? $advanceDetail['child_name'] : NULL;
                    $selectedNeeds[$selectedNeed]['advance_details']['spouse_name'] = isset($advanceDetail['spouse_name']) ? $advanceDetail['spouse_name'] : NULL;
                    $selectedNeeds[$selectedNeed]['advance_details']['spouse_dob'] = isset($advanceDetail['spouse_dob']) ? $advanceDetail['spouse_dob'] : NULL;
                    $selectedNeeds[$selectedNeed]['advance_details']['remaining_year'] = isset($advanceDetail['remaining_years']) ? $advanceDetail['remaining_years'] : NULL;
                    $selectedNeeds[$selectedNeed]['advance_details']['critical_illness_amount'] = isset($advanceDetail['critical_illness_amount']) ? $advanceDetail['critical_illness_amount'] : NULL;

                }

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