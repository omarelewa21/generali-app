<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomerService
{
    public $customerId;
    public  function handleCustomer(Request $request, $customerDetails,$latestKey)
    {
        DB::transaction(function () use ($request, $customerDetails,$latestKey) {

            $pdpa = $customerDetails['pdpa'] ?? "";
            //if customer id found in session, cross check the detail in db first
            $customerSessionId = session()->get('customer_id') ?? session('customer_details.customer_id') ?? "";
            $verifiedCustomerId = Customer::find($customerSessionId);
            
            if($latestKey == 'basic_details' && isset($customerDetails['basic_details']))
            {
                $title = $customerDetails['basic_details']['title'];
                $fullName = $customerDetails['basic_details']['full_name'];
                $countryCode = $customerDetails['basic_details']['country_code'];
                $mobileNumber = $customerDetails['basic_details']['mobile_number'];
                $houseCountryCode = $customerDetails['basic_details']['house_phone_number_country_code'];
                $housePhoneNumber = $customerDetails['basic_details']['house_phone_number'];
                $email = $customerDetails['basic_details']['email'];
            }

            if ($latestKey == 'customers_choice') {
                $customerChoice = $customerDetails['customers_choice'];
            }

            //avatar
            $genderAvatar =  $customerDetails['avatar']['gender'] ?? "";
            $image =  $customerDetails['avatar']['image'] ?? "images/avatar-general/gender-male.svg";
            $skinTone =  $customerDetails['avatar']['skin_tone'] ?? "";

            //identity details
            $country = $customerDetails['identity_details']['country'] ?? "";
            $idType = $customerDetails['identity_details']['id_type'] ?? "";
            $idNumber = $customerDetails['identity_details']['id_number'] ?? "";
            $passportNumber = $customerDetails['identity_details']['passport_number'] ?? null;
            $birthCert = $customerDetails['identity_details']['birth_cert'] ?? "";
            $policeNumber = $customerDetails['identity_details']['police_number'] ?? null;
            $registrationNumber = $customerDetails['identity_details']['registration_number'] ?? null;
            $gender = $customerDetails['identity_details']['gender'] ?? "";
            $dob = $customerDetails['identity_details']['dob'] ?? "";
            $age = $customerDetails['identity_details']['age'] ?? "";
            $habits = $customerDetails['identity_details']['habits'] ?? "";
            $educationLevel = $customerDetails['identity_details']['education_level'] ?? "";
            $occupation = $customerDetails['identity_details']['occupation'] ?? "";
            $maritalStatus = $customerDetails['identity_details']['marital_status'] ?? "";

            if (array_key_exists('family_details', $customerDetails)) {
                // 'family_details' key exists
                $childrenData = $customerDetails['family_details']['children_data'] ?? [];
                $childrenCount = count($childrenData);
            } else {
                // 'family_details' key does not exist
                $childrenCount = 0; 
            }

            if (array_key_exists($latestKey, $customerDetails) && isset($customerDetails[$latestKey])) {

                switch ($latestKey) {
                    case 'basic_details':
                        $updateParameter = [
                            'full_name' => $fullName,'mobile_number' => $mobileNumber, 'title' => $title, 'email' => $email, 'country_code' => $countryCode,
                            'house_phone_number_country_code' => $houseCountryCode, 'house_phone_number' => $housePhoneNumber
                        ];
                        break;
                    
                    case 'avatar':
                        $updateParameter = [
                            'gender' => $genderAvatar                     
                        ];
                        break;

                    case 'identity_details':
                        $updateParameter = [
                            'country' => $country, 'id_type' => $idType, 'id_number' => $idNumber, 'passport_number' => $passportNumber,
                            'birth_cert' => $birthCert, 'police_number' => $policeNumber, 'registration_number' => $registrationNumber,
                            'gender' => $gender, 'dob' => $dob, 'age' => $age, 'habit' => $habits , 'education_level' => $educationLevel,
                            'occupation' => $occupation              
                        ];
                        break;
                    
                        case 'marital_status':
                            $updateParameter = [
                                'marital_status' => $maritalStatus                  
                            ];
                            break;   


                    case 'family_details':
                        $updateParameter = [
                            'marital_status' => $maritalStatus, 'children' => $childrenCount                  
                        ];
                        break;

                    case 'assets':
                        $updateParameter = [
                            'gender' => $genderAvatar                     
                        ];
                        break;
                    
                    case 'customers_choice':
                        $updateParameter = [
                            'customer_choice' => $customerChoice                     
                        ];
                        break;
        
                    case 'existing_policy':
                        $updateParameter = [
                            'customer_choice' => 1                     
                        ];
                        break;
        
                    default:
                        $updateParameter = [
                            'gender' => $genderAvatar                     
                        ];
                        break;
                }

                $customer = Customer::updateOrCreate(
                    ['id' => $customerSessionId ],$updateParameter
                );
            } 

            $this->customerId = $customer->id;
        });

        return $this->customerId;
    }
}
