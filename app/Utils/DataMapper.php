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
                ],
                'spouseDetails' => [
                    // 'firstName' => $customerDetails['firstName'],
                    // 'lastName' => $customerDetails['lastName'],
                    // 'nationality' => $customerDetails['basic_details']['country'],
                    // 'identityType' => $customerDetails['basic_details']['id_type'],
                    // 'identityNo' => $customerDetails['basic_details']['id_number'],
                    // 'smokingStatus' => $customerDetails['basic_details']['habits'],
                    // 'dateOfBirth' => $customerDetails['basic_details']['dob'],
                    // 'title' => $customerDetails['basic_details']['title'],
                    // 'gender' => $customerDetails['basic_details']['gender'],
                    // 'occupation' => $customerDetails['basic_details']['occupation'],
                    // 'maritalStatus' => $customerDetails['basic_details']['marital_status'],
                    // 'educationLvl' => $customerDetails['basic_details']['education_level'],
                    // 'emailID' => $customerDetails['basic_details']['email'],
                    // 'phoneNumber' => $customerDetails['basic_details']['mobile_number'],
                    // 'countryCode' => $customerDetails['basic_details']['country_code'],
                    
                ],
            ],
            'customersChoice' => $customerDetails['basic_details']['customer_choice'],

        ];
        
        return  $completeData;
    }

}
