<?php

namespace App\Utils;
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

        $spouseFullName = isset($customerDetails['family_details']['spouse_data']['full_name']) ?  $customerDetails['family_details']['spouse_data']['full_name'] : NULL;
        $spouseFullName = isset($spouseFullName) ? explode(' ', $spouseFullName) : NULL;

        $spouseFirstName = $spouseFullName[0];
        $spouseLastName = isset($spouseFullName[1]) ? $spouseFullName[1] : '';

        // check children,parent and siblings data then merge into dependentData
        $dependentData = [];

        if (isset($customerDetails['family_details']['children_data'])) 
        {
            foreach ($customerDetails['family_details']['children_data'] as &$child) {
                unset($child['dob']);
                $dependentData[] = $child;
            }
        }

      
        if(isset($customerDetails['family_details']['parents_data']))
        {
            foreach ($customerDetails['family_details']['parents_data'] as &$parent) {
                unset($parent['dob']);
                $dependentData[] = $parent;
            }
        }

        if(isset($customerDetails['family_details']['siblings_data']))
        {
            unset($customerDetails['family_details']['siblings_data']['dob']);
            $dependentData[] = $customerDetails['family_details']['siblings_data'];
        }



        $completeData = [
            'agentId' => '15428',
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
                ],
                'spouseDetails' => [
                    'lastModifiedTime' => $customerDetails['family_details']['spouse_data']['updated_at'],
                    'createdTime' => $customerDetails['family_details']['spouse_data']['created_at'],
                    'title' => $customerDetails['family_details']['spouse_data']['title'],
                    'othersValue' => "",
                    'firstName' => $spouseFirstName,
                    'lastName' => $spouseLastName,
                    'identityType' => $customerDetails['family_details']['spouse_data']['id_type'],
                    'identityNo' => $customerDetails['family_details']['spouse_data']['id_number'],
                    'nationality' => "",
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
                    'selectedRiskProfile' => $customerDetails,
                    'selectedReturnExpectation' => $customerDetails,
                    'selectedNeeds' => $customerDetails['selected_needs']
                ],
                'financialStatement' => [
                    'isChangeinAmount' => $customerDetails['financialStatement']['isChangeinAmount'],
                    'amountAvailable' => $customerDetails['financialStatement']['amountAvailable']
                ],
                'existingPolicies' => [

                ]
               
            ],
            'customersChoice' => $customerDetails['basic_details']['customer_choice'],

        ];
        
        return  $completeData;
    }

}
