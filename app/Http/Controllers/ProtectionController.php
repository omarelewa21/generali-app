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
        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

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
        
        $arrayData['protection']['protectionSelectedAvatar'] = $protectionSelectedAvatarInput;
        $arrayData['protection']['protectionSelectedImage'] = $protectionSelectedImage;

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);
        Log::debug($arrayData);
        return redirect()->route('protection.monthly.support.new');
    }

    public function validateMonthlySupport(Request $request){

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

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

        if ($totalProtectionFund === $protectionTotalFund){
            $arrayData['protection']['totalProtectionNeeded'] = $totalProtectionFund;
        }
        else{
            $arrayData['protection']['totalProtectionNeeded'] = $protectionTotalFund;
        }

        $arrayData['protection']['protectionMonthlySupport'] = $protection_monthly_support;

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);
        Log::debug($arrayData);
        return redirect()->route('protection.supporting.years.new');
    }
    public function validateProtectionSupporting(Request $request){

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

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

        // Validation passed, perform any necessary processing.
        $protection_supporting_years = $request->input('protection_supporting_years');
        $newProtectionTotalFund = floatval($protection_supporting_years * $arrayData['protection']['totalProtectionNeeded']);
        $newTotalProtectionNeeded = floatval($request->input('newTotal_protectionNeeded'));

        $arrayData['protection']['protectionSupportingYears'] = $protection_supporting_years;
        if ($newProtectionTotalFund === $newTotalProtectionNeeded){
            $arrayData['protection']['newTotalEducationFundNeeded'] = $newTotalProtectionNeeded;
        }
        else{
            $arrayData['protection']['newTotalEducationFundNeeded'] = $newProtectionTotalFund;
        }

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);
        Log::debug($arrayData);
        // Process the form data and perform any necessary actions
        // $formattedArray = "<pre>" . print_r($arrayData, true) . "</pre>";
        // return ($formattedArray);
        return redirect()->route('protection.existing.policy.new');
    }

    public function validateProtectionExistingPolicy(Request $request){

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
            $arrayData['education']['totalAmountNeeded'] = $newEducationTotalAmountNeeded;
            $arrayData['education']['educationFundPercentage'] = $newEducationPercentage;
        }

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);

        // // Process the form data and perform any necessary actions
        // $formattedArray = "<pre>" . print_r($arrayData, true) . "</pre>";
        // return ($formattedArray);
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