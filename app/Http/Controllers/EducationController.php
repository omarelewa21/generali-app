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

class EducationController extends Controller
{
    public function validateEducationCoverageSelection(Request $request)
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
            'educationSelectedAvatarInput' => [
                'at_least_one_selected',
            ],
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $educationSelectedAvatarInput = $request->input('educationSelectedAvatarInput');

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing education_needs from the session
        $education = $customerDetails['education_needs'] ?? [];

        // Update specific keys with new values
        $education = array_merge($education, [
            'coveragePerson' => $educationSelectedAvatarInput
        ]);

        // Set the updated identity_details back to the customer_details session
        $customerDetails['education_needs'] = $education;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        return redirect()->route('education.amount');
    }

    public function validateEducationAmount(Request $request){

        $customMessages = [
            'tertiary_education_amount.required' => 'You are required to enter an amount.',
            'tertiary_education_amount.regex' => 'You must enter number',
        ];

        $validatedData = Validator::make($request->all(), [
            'tertiary_education_amount' => [
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
        $tertiary_education_amount = str_replace(',','',$request->input('tertiary_education_amount'));
        $educationTotalFund = floatval($tertiary_education_amount);
        $totalEducationFund = floatval($request->input('total_educationFund'));

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing education_needs from the session
        $education = $customerDetails['education_needs'] ?? [];

        // Update specific keys with new values
        $education = array_merge($education, [
            'tertiaryEducationAmount' => $tertiary_education_amount
        ]);

        if ($totalEducationFund === $educationTotalFund){
            $education = array_merge($education, [
                'totalEducationNeeded' => $totalEducationFund
            ]);
        }
        else{
            $education = array_merge($education, [
                'totalEducationNeeded' => $educationTotalFund
            ]);
        }

        // Set the updated identity_details back to the customer_details session
        $customerDetails['education_needs'] = $education;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        return redirect()->route('education.supporting.years');
    }
    public function validateEducationSupportingYears(Request $request){

        $customMessages = [
            'tertiary_education_years.required' => 'You are required to enter a year.',
            'tertiary_education_years.integer' => 'The year must be a number',
            'tertiary_education_years.min' => 'The year must be at least :min.',
            'tertiary_education_years.max' => 'The year must not more than :max.',
        ];

        $validatedData = Validator::make($request->all(), [
            'tertiary_education_years' => 'required|integer|min:1|max:100',
        ], $customMessages);
        
        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing education_needs from the session
        $education = $customerDetails['education_needs'] ?? [];

        // Validation passed, perform any necessary processing.
        $tertiary_education_years = $request->input('tertiary_education_years');

        // Update specific keys with new values
        $education = array_merge($education, [
            'tertiaryEducationYear' => $tertiary_education_years
        ]);

        // Set the updated identity_details back to the customer_details session
        $customerDetails['education_needs'] = $education;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);
        $formattedArray = "<pre>" . print_r($customerDetails, true) . "</pre>";
        return ($formattedArray);

        // return redirect()->route('education.other');
    }

    public function submitEducationOther(Request $request){

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        $customMessages = [
            'education_other_savings.required' => 'Please select an option',
            'education_saving_amount.required_if' => 'You are required to enter an amount.',
            'education_saving_amount.regex' => 'The amount must be a number',
        ];

        $validatedData = Validator::make($request->all(), [
            'education_other_savings' => 'required|in:yes,no',
            'education_saving_amount' => [
                'nullable',
                'regex:/^[0-9,]+$/',
                'required_if:education_other_savings,yes',
                function ($attribute, $value, $fail) use ($request) {
                    // Remove commas and check if the value is at least 1
                    $numericValue = str_replace(',', '', $value);
                    $min = 1;
                    if (intval($numericValue) < $min && $request->input('education_other_savings') === 'yes') {
                        $fail('Your amount must be at least ' .$min. '.');
                    }
                },
            ],
        ], $customMessages);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        // Validation passed, perform any necessary processing.
        $education_saving_amount = str_replace(',','',$request->input('education_saving_amount'));
        $education_other_savings = $request->input('education_other_savings');
        $newEducationTotalAmountNeeded = floatval($arrayData['education']['newTotalEducationFundNeeded'] - $education_saving_amount);
        $totalAmountNeeded = floatval($request->input('total_amountNeeded'));
        $totalPercentage = floatval($request->input('percentage'));
        $newEducationPercentage = floatval($education_saving_amount / $arrayData['education']['newTotalEducationFundNeeded'] * 100);

        $arrayData['education']['educationSavingAmount'] = $education_saving_amount;
        $arrayData['education']['edcationSaving'] = $education_other_savings;
        if ($newEducationTotalAmountNeeded === $totalAmountNeeded && $newEducationPercentage === $totalPercentage){
            if ($newEducationTotalAmountNeeded <= 0){
                $arrayData['education']['totalAmountNeeded'] = 0;
                $arrayData['education']['educationFundPercentage'] = 100;
            }
            else{
                $arrayData['education']['totalAmountNeeded'] = $totalAmountNeeded;
                $arrayData['education']['educationFundPercentage'] = $totalPercentage;
            }
        }
        else{
            if ($newEducationTotalAmountNeeded <= 0){
                $arrayData['education']['totalAmountNeeded'] = 0;
                $arrayData['education']['educationFundPercentage'] = 100;
            }
            else{
                $arrayData['education']['totalAmountNeeded'] = $newEducationTotalAmountNeeded;
                $arrayData['education']['educationFundPercentage'] = $newEducationPercentage;
            }
        }

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);

        return redirect()->route('education.gap');
    }

    public function submitEducationGap(Request $request){

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);

        // // Process the form data and perform any necessary actions
        return redirect()->route('savings.home');
    }

}