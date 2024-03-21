<?php

namespace App\Utils;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DataMapper
{
    public static function mapCustomerDetails($customerDetails)
    {
        $nameParts = explode(' ', $customerDetails['basic_details']['full_name']);
        $firstName = $nameParts[0];
        $lastName = isset($nameParts[1]) ? $nameParts[1] : '';
        $customerDetails['firstName'] = $firstName;
        $customerDetails['lastName'] = $lastName;
        $agentId = "15428";

        $spouseFullName = isset($customerDetails['family_details']['spouse_data']['full_name']) ?  $customerDetails['family_details']['spouse_data']['full_name'] : NULL;
        $spouseFullName = isset($spouseFullName) ? explode(' ', $spouseFullName) : NULL;

        $spouseFirstName = $spouseFullName[0];
        $spouseLastName = isset($spouseFullName[1]) ? $spouseFullName[1] : '';

        $customerDetails['basic_details']['dob'] = Carbon::parse($customerDetails['basic_details']['dob'])->format('Y-m-d') ?? NULL;

        $customerDetails['basic_details']['mobile_number'] = str_replace($customerDetails['basic_details']['country_code'], '', $customerDetails['basic_details']['mobile_number']) ?? NULL;
        $customerDetails['basic_details']['house_phone_number'] = str_replace($customerDetails['basic_details']['house_phone_number_country_code'], '', $customerDetails['basic_details']['house_phone_number']);

        $customerDetails['basic_details']['occupation']  = ucwords(strtolower( $customerDetails['basic_details']['occupation'])); 
        $customerDetails['family_details']['spouse_data']['occupation']  = ucwords(strtolower($customerDetails['family_details']['spouse_data']['occupation']));
        
        if (isset($customerDetails['basic_details']['country'])) {
            $customerDetails['basic_details']['country'] = "Malaysia" ? "Malaysian" : $customerDetails['basic_details']['country'];
        }

        foreach ($customerDetails['selected_needs'] as $selectKey => $selectValue) {

            switch ($selectKey) {
                case 0:
                    $customerSelectedNeeds[$selectKey]['value']= $selectValue['value'];
                    $customerSelectedNeeds[$selectKey]['priority'] = $selectValue['priority'];
                    $customerSelectedNeeds[$selectKey]['cover'] = $selectValue['cover'];
                    $customerSelectedNeeds[$selectKey]['discuss'] = $selectValue['discuss'];
                    $customerAdvanceDetail = $customerDetails['selected_needs'][$selectKey]['advanceDetails'];                
                    $customerSelectedNeeds[$selectKey]['advanceDetails'] = [
                        'coverFor' => $customerAdvanceDetail['relationship'],
                        'selectedInsuredName' => $customerAdvanceDetail['child_name'] ?? NULL,
                        'othersCoverForName' => $customerAdvanceDetail['spouse_name'] ?? NULL,
                        'othersCoverForDob' => $customerAdvanceDetail['spouse_dob'] ?? NULL,
                        'selectedCoverForDob' => $customerAdvanceDetail['child_dob'] ?? NULL,
                        'eventOfDeath' => $customerAdvanceDetail['covered_amount'] ?? NULL,
                        'incomeProtected' => $customerAdvanceDetail['supporting_year'] ?? NULL,
                        'lifeInsurance' => $customerAdvanceDetail['existing_amount'] ?? NULL,
                        'insuranceAmount' => $customerAdvanceDetail['insurance_amount'] ?? NULL,        
                    ];
                    break;
                case 1:
                    $customerSelectedNeeds[$selectKey]['value']= $selectValue['value'];
                    $customerSelectedNeeds[$selectKey]['priority'] = $selectValue['priority'];
                    $customerSelectedNeeds[$selectKey]['cover'] = $selectValue['cover'];
                    $customerSelectedNeeds[$selectKey]['discuss'] = $selectValue['discuss'];
                    $customerAdvanceDetail = $customerDetails['selected_needs'][$selectKey]['advanceDetails'];                
                    $customerSelectedNeeds[$selectKey]['advanceDetails'] = [
                        'coverFor' => $customerAdvanceDetail['relationship'],
                        'selectedInsuredName' => $customerAdvanceDetail['child_name'] ?: $customerAdvanceDetail['spouse_name'] ?? NULL,
                        'othersCoverForName' => $customerAdvanceDetail['spouse_name'] ?? NULL,
                        'othersCoverForDob' => $customerAdvanceDetail['spouse_dob'] ?? NULL,
                        'selectedCoverForDob' => $customerAdvanceDetail['child_dob'] ?: $customerAdvanceDetail['spouse_dob'] ?? NULL,
                        'yearsOfRetirement' => $customerAdvanceDetail['supporting_year'] ?? NULL,
                        'annualAmountRetirement' => $customerAdvanceDetail['covered_amount'] ?? NULL,                      
                        'yearsOfSupport' => strval($customerAdvanceDetail['supporting_year']) ?? NULL,
                        'existingIncome' => $customerAdvanceDetail['existing_amount'] ?? NULL,
                        'otherSourceDuringRetirement' => $customerAdvanceDetail['other_source'] ?? NULL,
                        'oldAgeamountRetirement' => $customerAdvanceDetail['insurance_amount'] ?? NULL
                    ];
                    break;
                case 2:
                    $customerSelectedNeeds[$selectKey]['value']= $selectValue['value'];
                    $customerSelectedNeeds[$selectKey]['priority'] = $selectValue['priority'];
                    $customerSelectedNeeds[$selectKey]['cover'] = $selectValue['cover'];
                    $customerSelectedNeeds[$selectKey]['discuss'] = $selectValue['discuss'];
                    $customerAdvanceDetail = $customerDetails['selected_needs'][$selectKey]['advanceDetails'];                
                    $customerSelectedNeeds[$selectKey]['advanceDetails'] = [
                        'coverFor' => $customerAdvanceDetail['relationship'],
                        'selectedInsuredName' => $customerAdvanceDetail['child_name'] ?? NULL,
                        'othersCoverForName' => "",
                        'othersCoverForDob' => "",
                        'selectedCoverForDob' => $customerAdvanceDetail['child_dob']  ?? NULL,
                        'YearsOfEducation' => $customerAdvanceDetail['remaining_year'] ?? NULL,
                        'needForTertiaryAmount' => $customerAdvanceDetail['goals_amount']?? NULL,
                        'existingEducationFund' => $customerAdvanceDetail['existing_amount'] ?? NULL,
                        'shortfallTertiaryEducation' => "",                 
                    ];
                    break;
                case 3:
                    $customerSelectedNeeds[$selectKey]['value']= $selectValue['value'];
                    $customerSelectedNeeds[$selectKey]['priority'] = $selectValue['priority'];
                    $customerSelectedNeeds[$selectKey]['cover'] = $selectValue['cover'];
                    $customerSelectedNeeds[$selectKey]['discuss'] = $selectValue['discuss'];
                    $customerAdvanceDetail = $customerDetails['selected_needs'][$selectKey]['advanceDetails'];                
                    $customerSelectedNeeds[$selectKey]['advanceDetails'] = [
                        'coverFor' => $customerAdvanceDetail['relationship'],
                        'selectedInsuredName' => $customerAdvanceDetail['child_name'] ?? NULL,
                        'othersCoverForName' => $customerAdvanceDetail['spouse_name'] ?? NULL,
                        'othersCoverForDob' => $customerAdvanceDetail['spouse_dob'] ?? NULL,
                        'selectedCoverForDob' => $customerAdvanceDetail['child_dob'] ?? NULL,
                        'investmentTimeInYears' => $customerAdvanceDetail['supporting_year'] ?? NULL,
                        'expectedAnnualReturns' => $customerAdvanceDetail['annual_return'] ?? NULL,
                        'amountAllocatedPerMonth' => $customerAdvanceDetail['covered_amount'] ?? NULL,
                    ];
                    break;
                case 4:
                    $customerSelectedNeeds[$selectKey]['value']= $selectValue['value'];
                    $customerSelectedNeeds[$selectKey]['priority'] = $selectValue['priority'];
                    $customerSelectedNeeds[$selectKey]['cover'] = $selectValue['cover'];
                    $customerSelectedNeeds[$selectKey]['discuss'] = $selectValue['discuss'];
                    $customerAdvanceDetail = $customerDetails['selected_needs'][$selectKey]['advanceDetails'];                
                    $customerSelectedNeeds[$selectKey]['advanceDetails'] = [
                        'coverFor' => $customerAdvanceDetail['relationship'],
                        'selectedInsuredName' => $customerAdvanceDetail['child_name']   ?? NULL,
                        'othersCoverForName' => $customerAdvanceDetail['spouse_name'] ?? NULL,
                        'othersCoverForDob' => $customerAdvanceDetail['spouse_dob'] ?? NULL,
                        'selectedCoverForDob' => $customerAdvanceDetail['child_dob']  ?? NULL,
                        'investmentTimeInYears' => $customerAdvanceDetail['supporting_year'] ?? NULL,
                        'expectedAnnualReturns' => $customerAdvanceDetail['annual_return'] ?? NULL,
                        'amountAllocatedPerMonth' => $customerAdvanceDetail['covered_amount'] ?? NULL,    
                    ];
                    break;
                case 5:
                    $customerSelectedNeeds[$selectKey]['value']= $selectValue['value'];
                    $customerSelectedNeeds[$selectKey]['priority'] = $selectValue['priority'];
                    $customerSelectedNeeds[$selectKey]['cover'] = $selectValue['cover'];
                    $customerSelectedNeeds[$selectKey]['discuss'] = $selectValue['discuss'];
                    $customerAdvanceDetail = $customerDetails['selected_needs'][$selectKey]['advanceDetails'];
                    $criticalIllness =  json_decode($customerAdvanceDetail['critical_illness'],true);    
                    $healthCare =  json_decode($customerAdvanceDetail['health_care'],true); 
                    $customerSelectedNeeds[$selectKey]['advanceDetails'] = [
                        'illness' =>[
                            'critical' => $customerAdvanceDetail['critical_illness_plan'] ?? "Critical Illness",
                            'coverFor' => $customerAdvanceDetail['relationship'],
                            'selectedInsuredName' => $customerAdvanceDetail['child_name'] ?? NULL,
                            'othersCoverForName' => $customerAdvanceDetail['spouse_name'] ?? NULL,
                            'othersCoverForDob' => $customerAdvanceDetail['spouse_dob'] ?? NULL,
                            'selectedCoverForDob' => $customerAdvanceDetail['child_dob'] ?? NULL,
                            'criticalTreatmentAmount' => $criticalIllness['goals_amount'] ?? NULL,
                            'existingCiticalProtection' => $criticalIllness['existing_amount'] ?? NULL,
                            'amountNeededCriticlRetirement' => $criticalIllness['insurance_amount'] ?? NULL,           
                        ],
                        'healthCare' => [
                            'planning' => $customerAdvanceDetail['medical_care_plan'] ?? "Health Planning",
                            'coverFor' => $customerAdvanceDetail['relationship'],
                            'selectedInsuredName' => $customerAdvanceDetail['child_name'] ?? NULL,
                            'othersCoverForName' => $customerAdvanceDetail['spouse_name'] ?? NULL,
                            'othersCoverForDob' => $customerAdvanceDetail['spouse_dob'] ?? NULL,
                            'selectedCoverForDob' => $customerAdvanceDetail['child_dob'] ?? NULL,                  
                            'medicalTreatmentAmount' => $healthCare['goals_amount'] ?? NULL,
                            'existingMedicalProtection' => $healthCare['existing_amount'] ?? NULL,
                            'amountNeededMedicalRetirement' => $healthCare['insurance_amount'] ?? NULL,
                        ]
                    ];
                    break;
                case 6:
                    $customerSelectedNeeds[$selectKey]['value']= $selectValue['value'];
                    $customerSelectedNeeds[$selectKey]['priority'] = $selectValue['priority'];
                    $customerSelectedNeeds[$selectKey]['cover'] = $selectValue['cover'];
                    $customerSelectedNeeds[$selectKey]['discuss'] = $selectValue['discuss'];
                    $customerAdvanceDetail = $customerDetails['selected_needs'][$selectKey]['advanceDetails'];                
                    $customerSelectedNeeds[$selectKey]['advanceDetails'] = [
                        'coverFor' => $customerAdvanceDetail['relationship'],
                        'selectedInsuredName' => $customerAdvanceDetail['child_name']  ?? NULL,
                        'othersCoverForName' => $customerAdvanceDetail['spouse_name'] ?? NULL,
                        'othersCoverForDob' => $customerAdvanceDetail['spouse_dob'] ?? NULL,
                        'selectedCoverForDob' => $customerAdvanceDetail['child_dob'] ?? NULL,
                        'outstandingLoan' => $customerAdvanceDetail['covered_amount'] ?? NULL,
                        'yearsLeftSettelement' => $customerAdvanceDetail['remaining_year'] ?? NULL,                  
                        'existingDebtCancellation' => $customerAdvanceDetail['existing_amount'] ?? NULL,
                        'criticalIllnessProtection' => $customerAdvanceDetail['critical_illness'] ?? NULL,
                        'amountIllnessProtection' => $customerAdvanceDetail['critical_illness_amount'] ?? NULL,
                        'summaryDebtCancelation' => $customerAdvanceDetail['insurance_amount'] ?? NULL,             
                    ];
                    break;
                
                default:
                    $customerSelectedNeeds = [];
                    break;
            }
        }

        // check children,parent and siblings data then merge into dependentData
        $dependentData = [];

        if (isset($customerDetails['family_details']['children_data'])) {
            foreach ($customerDetails['family_details']['children_data'] as &$child) 
            {
                $childFullName = isset($child['full_name']) ?  $child['full_name'] : NULL;
                $childFullName = isset($childFullName) ? explode(' ', $childFullName) : NULL;
                $childFirstName = $childFullName[0];
                $childLastName = isset($childFullName[1]) ? $childFullName[1] : '';
                $child['firstName'] = $childFirstName; 
                $child['lastName'] = $childLastName; 
                $child['dateOfBirth'] = $child['dob'];
                $child['relationship'] = $child['relation'];
                $child['yearsToSupport'] = $child['year_support'];
                $child['maritalStatus'] = $child['marital_status'];
                $dependentData[] = $child;
            }
        }

      
        if(isset($customerDetails['family_details']['parents_data'])){
            foreach ($customerDetails['family_details']['parents_data'] as &$parent) {
              
                $parentFullName = isset($parent['full_name']) ?  $parent['full_name'] : NULL;
                $parentFullName = isset($parentFullName) ? explode(' ', $parentFullName) : NULL;
                $parentFirstName = $parentFullName[0];
                $parentLastName = isset($parentFullName[1]) ? $parentFullName[1] : '';
                $parent['firstName'] = $parentFirstName; 
                $parent['lastName'] = $parentLastName; 
                $parent['dateOfBirth'] = $parent['dob'];
                $parent['relationship'] = $parent['relation'];
                $parent['yearsToSupport'] = $parent['year_support'];
                $parent['maritalStatus'] = $parent['marital_status'];
                $dependentData[] = $parent;
            }
        }

        if(isset($customerDetails['family_details']['siblings_data']))
        {
            unset($customerDetails['family_details']['siblings_data']['dob']);
            $dependentData[] = $customerDetails['family_details']['siblings_data'];
        }

        if (isset($customerDetails['selected_needs']['3']) || isset($customerDetails['selected_needs']['4'])) {
            
            $riskProfile = $customerDetails['selected_needs']['3']['advanceDetails']['risk_profile'] ?? $customerDetails['selected_needs']['4']['advanceDetails']['risk_profile'] ?? NULL;
            
            $returnExpectation = $customerDetails['selected_needs']['3']['advanceDetails']['potential_return'] ?? $customerDetails['selected_needs']['4']['advanceDetails']['potential_return'] ?? NULL;

            if ($returnExpectation) {
               $returnExpectation = $returnExpectation." "."Potential Return";
            }
                
        }

        $completeData = [
           
            'customers' => [
                'customerDetails' => [
                    'firstName' => $customerDetails['firstName'],
                    'lastName' => $customerDetails['lastName'],
                    'nationality' => $customerDetails['basic_details']['country'],
                    'identityType' => $customerDetails['basic_details']['id_type'],
                    'identityNo' => $customerDetails['basic_details']['id_number'],
                    'smokingStatus' => $customerDetails['basic_details']['habits'],
                    'dateOfBirth' => $customerDetails['basic_details']['dob'],
                    'title' => $customerDetails['basic_details']['title'],
                    'gender' => $customerDetails['basic_details']['gender'],
                    'occupation' => $customerDetails['basic_details']['occupation'],
                    'maritalStatus' => $customerDetails['basic_details']['marital_status'],
                    'educationLvl' => $customerDetails['basic_details']['education_level'],
                    'emailID' => $customerDetails['basic_details']['email'],
                    'phoneNumber' => $customerDetails['basic_details']['mobile_number'],
                    'countryCode' => $customerDetails['basic_details']['country_code'],
                    'noOfKids' => $customerDetails['basic_details']['children'],
                    'homeNumberCountryCode' => $customerDetails['basic_details']['house_phone_number_country_code'],
                    'homePhoneNumber' => $customerDetails['basic_details']['house_phone_number'],
                ]
            ],
            'agentId' => $agentId,
            'spouseDetails' => [
                'lastModifiedTime' => $customerDetails['family_details']['spouse_data']['updated_at'],
                'createdTime' => $customerDetails['family_details']['spouse_data']['created_at'],
                'title' => $customerDetails['family_details']['spouse_data']['title'],
                'othersValue' => "",
                'firstName' => $spouseFirstName,
                'lastName' => $spouseLastName,
                'identityType' => $customerDetails['family_details']['spouse_data']['id_type'],
                'identityNo' => $customerDetails['family_details']['spouse_data']['id_number'],
                'nationality' => $customerDetails['family_details']['spouse_data']['country'],
                'gender' => $customerDetails['family_details']['spouse_data']['gender'],
                'dateOfBirth' => $customerDetails['family_details']['spouse_data']['dob'],
                'smokingStatus' => $customerDetails['family_details']['spouse_data']['habit'],
                'parentCustomerId' => "",
                'monthlyIncome' => "",
                'occupation' => $customerDetails['family_details']['spouse_data']['occupation'],
                'files' => [],            
                'email' => "",
            ],
            'dependentDetails' => $dependentData,
            'riskProfile' => [
                'selectedRiskProfile' => $riskProfile,
                'selectedReturnExpectation' => $returnExpectation,
                'selectedNeeds' => $customerSelectedNeeds
            ],
            'existingPolicies' => [

            ],
            'financialStatement' => [
                'isChangeinAmount' => $customerDetails['financialStatement']['isChangeinAmount'],
                'amountAvailable' => $customerDetails['financialStatement']['amountAvailable'],
                'changeinAmount' => $customerDetails['financialStatement']['approximateIncrementAmount']
            ],
            'customersChoice' => strval($customerDetails['basic_details']['customer_choice']),

        ];
        
        return  $completeData;
    }

}
