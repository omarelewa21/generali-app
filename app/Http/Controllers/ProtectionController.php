<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use SebastianBergmann\Environment\Console;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ProtectionController extends Controller
{
    public function validateProtectionCoverageSelection(Request $request)
    {
        // Define custom validation rule for button selection
        Validator::extend('at_least_one_selected', function ($attribute, $value, $parameters, $validator) {
            if ($value !== null) {
                return true;
            }
            
            $customMessage = "Please select at least one.";
            $validator->errors()->add($attribute, $customMessage);
    
            return false;
        });

        $validator = Validator::make($request->all(), [
            'protectionSelectedAvatarInput' => [
                'at_least_one_selected',
            ],
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $protectionSelectedAvatarInput = $request->input('protectionSelectedAvatarInput');
        $protectionSelectedImage = $request->input('protectionSelectedAvatarImage');

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing protection_needs from the session
        $protection = $customerDetails['protection_needs'] ?? [];

        // Update specific keys with new values
        $protection = array_merge($protection, [
            'coveragePerson' => $protectionSelectedAvatarInput,
        ]);

        // Add the new array inside the customer_details array
        // $customerDetails['protection_needs'] = [
        //     'coveragePerson' => $protectionSelectedAvatarInput
        // ];

        // Set the updated identity_details back to the customer_details session
        $customerDetails['protection_needs'] = $protection;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
    
        return redirect()->route('protection.monthly.support');
    }

    public function validateMonthlySupport(Request $request){

        $customMessages = [
            'protection_monthly_support.required' => 'You are required to enter an amount.',
            'protection_monthly_support.regex' => 'You must enter number',
        ];

        $validatedData = Validator::make($request->all(), [
            'protection_monthly_support' => [
                'required',
                'regex:/^[0-9,]+$/',
                function ($attribute, $value, $fail) {
                    // Remove commas and check if the value is at least 1
                    $numericValue = str_replace(',', '', $value);
                    $min = 1;
                    if (intval($numericValue) < $min) {
                        $fail('Your amount must be at least ' .$min. '.');
                    }
                },
            ],
        ], $customMessages);
        
        
        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $protection_monthly_support = str_replace(',','',$request->input('protection_monthly_support'));
        $protectionTotalFund = floatval($protection_monthly_support * 12);
        $totalProtectionFund = floatval($request->input('total_protectionFund'));

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing protection_needs from the session
        $protection = $customerDetails['protection_needs'] ?? [];

        // Update specific keys with new values
        $protection = array_merge($protection, [
            'monthlySupportAmount' => $protection_monthly_support
        ]);

        if ($totalProtectionFund === $protectionTotalFund){

            $protection = array_merge($protection, [
                'totalProtectionNeeded' => $totalProtectionFund
            ]);
        }
        else{
            $protection = array_merge($protection, [
                'totalProtectionNeeded' => $protectionTotalFund
            ]);
        }

        // Set the updated protection back to the customer_details session
        $customerDetails['protection_needs'] = $protection;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        // Process the form data and perform any necessary actions
        return redirect()->route('protection.supporting.years');
    }
    public function validateProtectionSupporting(Request $request){

        $customMessages = [
            'protection_supporting_years.required' => 'You are required to enter a year.',
            'protection_supporting_years.integer' => 'The year must be a number',
            'protection_supporting_years.min' => 'The year must be at least :min.',
            'protection_supporting_years.max' => 'The year must not more than :max.',
        ];

        $validatedData = Validator::make($request->all(), [
            'protection_supporting_years' => 'required|integer|min:1|max:100',
        ], $customMessages);
        
        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing identity_details from the session
        $protection = $customerDetails['protection_needs'] ?? [];

        // Validation passed, perform any necessary processing.
        $protection_supporting_years = $request->input('protection_supporting_years');
        $newProtectionTotalFund = floatval($protection_supporting_years * $customerDetails['protection_needs']['totalProtectionNeeded']);
        $newTotalProtectionNeeded = floatval($request->input('newTotal_protectionNeeded'));

        // Update specific keys with new values
        $protection = array_merge($protection, [
            'supportingYears' => $protection_supporting_years
        ]);

        if ($newProtectionTotalFund === $newTotalProtectionNeeded){
            $protection = array_merge($protection, [
                'newTotalProtectionNeeded' => $newTotalProtectionNeeded
            ]);
        }
        else{
            $protection = array_merge($protection, [
                'newTotalProtectionNeeded' => $newProtectionTotalFund
            ]);
        }

        // Set the updated protection back to the customer_details session
        $customerDetails['protection_needs'] = $protection;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        // Process the form data and perform any necessary actions
        // $formattedArray = "<pre>" . print_r($customerDetails, true) . "</pre>";
        // return ($formattedArray);
        return redirect()->route('protection.existing.policy');
    }

    public function validateProtectionExistingPolicy(Request $request){

        $customMessages = [
            'protection_existing_policy.required' => 'Please select an option',
            'existing_policy_amount.required_if' => 'You are required to enter an amount.',
            'existing_policy_amount.regex' => 'The amount must be a number',
        ];

        $validatedData = Validator::make($request->all(), [
            'protection_existing_policy' => 'required|in:yes,no',
            'existing_policy_amount' => [
                'nullable',
                'regex:/^[0-9,]+$/',
                'required_if:protection_existing_policy,yes',
                function ($attribute, $value, $fail) use ($request) {
                    // Remove commas and check if the value is at least 1
                    $numericValue = str_replace(',', '', $value);
                    $min = 1;
                    if (intval($numericValue) < $min && $request->input('protection_existing_policy') === 'yes') {
                        $fail('Your amount must be at least ' .$min. '.');
                    }
                },
            ],
        ], $customMessages);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing identity_details from the session
        $protection = $customerDetails['protection_needs'] ?? [];

        // Validation passed, perform any necessary processing.
        $existing_policy_amount = str_replace(',','',$request->input('existing_policy_amount'));
        $protection_existing_policy = $request->input('protection_existing_policy');
        $newProtectionTotalAmountNeeded = floatval($customerDetails['protection_needs']['newTotalProtectionNeeded'] - $existing_policy_amount);
        $totalAmountNeeded = floatval($request->input('total_amountNeeded'));
        $totalPercentage = floatval($request->input('percentage'));
        $newProtectionPercentage = floatval($existing_policy_amount / $customerDetails['protection_needs']['newTotalProtectionNeeded'] * 100);

        // Update specific keys with new values
        $protection = array_merge($protection, [
            'existingPolicyAmount' => $existing_policy_amount,
            'existingPolicy' => $protection_existing_policy
        ]);

        if ($newProtectionTotalAmountNeeded === $totalAmountNeeded && $newProtectionPercentage === $totalPercentage){
            if ($newProtectionTotalAmountNeeded <= 0){
                $protection = array_merge($protection, [
                    'totalAmountNeeded' => '0',
                    'fundPercentage' => '100'
                ]);
            }
            else{
                $protection = array_merge($protection, [
                    'totalAmountNeeded' => $totalAmountNeeded,
                    'fundPercentage' => $totalPercentage
                ]);
            }
        }
        else{
            if ($newProtectionTotalAmountNeeded <= 0){
                $protection = array_merge($protection, [
                    'totalAmountNeeded' => '0',
                    'fundPercentage' => '100'
                ]);
            }
            else{
                $protection = array_merge($protection, [
                    'totalAmountNeeded' => $newProtectionTotalAmountNeeded,
                    'fundPercentage' => $newProtectionPercentage
                ]);
            }
        }

        // Set the updated protection back to the customer_details session
        $customerDetails['protection_needs'] = $protection;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        // // Process the form data and perform any necessary actions
        // $formattedArray = "<pre>" . print_r($customerDetails, true) . "</pre>";
        // return ($formattedArray);
        return redirect()->route('protection.gap');
    }

    public function submitProtectionGap(Request $request){

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing identity_details from the session
        $protection = $customerDetails['protection_needs'] ?? [];

        // Set the updated protection back to the customer_details session
        $customerDetails['protection_needs'] = $protection;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        // // Process the form data and perform any necessary actions
        //  $formattedArray = "<pre>" . print_r($customerDetails, true) . "</pre>";
        // return ($formattedArray);
        return redirect()->route('retirement.home');
    }

}