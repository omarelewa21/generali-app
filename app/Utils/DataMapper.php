<?php

namespace App\Utils;
use Illuminate\Support\Facades\Log;

class DataMapper
{
    public static function mapCustomerDetails($customerDetails)
    {
        $nameParts = explode(' ', $customerDetails['full_name']);
        $firstName = $nameParts[0];
        $lastName = isset($nameParts[1]) ? $nameParts[1] : '';
        $customerDetails['firstName'] = $firstName;
        $customerDetails['lastName'] = $lastName;

        $completeData = [
            'customers' => [
                'customerDetails' => [
                    'firstName' => $customerDetails['firstName'],
                    'lastName' => $customerDetails['lastName'],
                    'nationality' => $customerDetails['country'],
                    'identityType' => $customerDetails['id_type'],
                    'identityNo' => $customerDetails['id_number'],
                    'smokingStatus' => $customerDetails['habits'],
                    'dateOfBirth' => $customerDetails['dob'],
                    'title' => $customerDetails['title'],
                    'gender' => $customerDetails['gender'],
                    'occupation' => $customerDetails['occupation'],
                    'maritalStatus' => $customerDetails['marital_status'],
                    'educationLvl' => $customerDetails['education_level'],
                    'emailID' => $customerDetails['email'],
                    'phoneNumber' => $customerDetails['mobile_number'],
                    'countryCode' => $customerDetails['country_code'],
                ]
            ]
        ];
        

        return  $completeData;
    }

}
