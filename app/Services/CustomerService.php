<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CustomerService 
{
    public $customerId;
    public  function handleCustomer(Request $request,$customerDetails)
    {
        DB::transaction(function () use ($request,$customerDetails) {

            $pdpa = $customerDetails['pdpa'] ?? "NO accept";
            $title = $customerDetails['basic_details']['title'];
            $fullName = $customerDetails['basic_details']['full_name'] ?? "";
            $countryCode = $customerDetails['basic_details']['country_code'];
            $mobileNumber = $customerDetails['basic_details']['mobile_number'] ?? "";
            $houseCountryCode = $customerDetails['basic_details']['house_phone_number_country_code'];
            $housePhoneNumber = $customerDetails['basic_details']['house_phone_number'];
            $email = $customerDetails['basic_details']['email'] ?? "";
            
            $customer = Customer::updateOrCreate(
                ['full_name' => $fullName , 'mobile_number' => $mobileNumber],
                ['title' => $title , 'email' => $email , 'country_code' => $countryCode, 
                 'house_phone_number_country_code' => $houseCountryCode , 'house_phone_number' => $housePhoneNumber]
            );

            $this->customerId = $customer->id;
            
        });

        return $this->customerId;
    }
}