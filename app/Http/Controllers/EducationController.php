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
            'educationSelectedAvatarInput' => [
                'at_least_one_selected',
            ],
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $educationSelectedAvatarInput = $request->input('educationSelectedAvatarInput');
        $educationSelectedImage = $request->input('educationSelectedAvatarImage');
        
        $arrayData['education']['educationSelectedAvatar'] = $educationSelectedAvatarInput;
        $arrayData['education']['educationSelectedImage'] = $educationSelectedImage;

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);
        Log::debug($arrayData);
        return redirect()->route('education.monthly.amount');
    }

    public function submitEducationMonthly(Request $request){

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        $customMessages = [
            'monthly_education_amount.required' => 'You are required to enter an amount.',
            // 'monthly_education_amount.min' => 'Your amount must be at least :min.',
            'monthly_education_amount.regex' => 'You must enter number',
        ];

        // $validatedData = Validator::make($request->all(), [
        //     'monthly_education_amount' => 'required|min:1|regex:/^[0-9,]+$/',
        // ], $customMessages);
        $validatedData = Validator::make($request->all(), [
            'monthly_education_amount' => [
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
        $monthly_education_amount = str_replace(',','',$request->input('monthly_education_amount'));
        $educationTotalFund = floatval($monthly_education_amount * 12);
        $totalEducationFund = floatval($request->input('total_educationFund'));

        if ($totalEducationFund === $educationTotalFund){
            $arrayData['education']['totalEducationFundNeeded'] = $totalEducationFund;
        }
        else{
            $arrayData['education']['totalEducationFundNeeded'] = $educationTotalFund;
        }

        $arrayData['education']['educationMonthlyAmount'] = $monthly_education_amount;

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);
        Log::debug($arrayData);
        // Process the form data and perform any necessary actions
        // $formattedArray = "<pre>" . print_r($arrayData, true) . "</pre>";
        // return ($formattedArray);
        return redirect()->route('education.supporting.years');
    }
    public function submitEducationSupporting(Request $request){

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

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

        // Validation passed, perform any necessary processing.
        $tertiary_education_years = $request->input('tertiary_education_years');
        $newEducationTotalFund = floatval($tertiary_education_years * $arrayData['education']['totalEducationFundNeeded']);
        $newTotalEducationFundNeeded = floatval($request->input('newTotal_educationFund'));

        $arrayData['education']['totalEducationYear'] = $tertiary_education_years;
        if ($newEducationTotalFund === $newTotalEducationFundNeeded){
            $arrayData['education']['newTotalEducationFundNeeded'] = $newTotalEducationFundNeeded;
        }
        else{
            $arrayData['education']['newTotalEducationFundNeeded'] = $newEducationTotalFund;
        }

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);
        Log::debug($arrayData);
        // Process the form data and perform any necessary actions
        // $formattedArray = "<pre>" . print_r($arrayData, true) . "</pre>";
        // return ($formattedArray);
        return redirect()->route('education.other');
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