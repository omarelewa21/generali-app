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

class RetirementController extends Controller
{
    public function validateRetirementCoverageSelection(Request $request)
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
            'retirementSelectedAvatarInput' => [
                'at_least_one_selected',
            ],
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $retirementSelectedAvatarInput = $request->input('retirementSelectedAvatarInput');
        $retirementSelectedImage = $request->input('retirementSelectedAvatarImage');
        
        $arrayData['retirement']['retirementSelectedAvatar'] = $retirementSelectedAvatarInput;
        $arrayData['retirement']['retirementSelectedImage'] = $retirementSelectedImage;

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);
        Log::debug($arrayData);
        return redirect()->route('retirement.ideal');
    }

    public function validateIdeal(Request $request)
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
            'retirementIdealInput' => [
                'at_least_one_selected',
            ],
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $retirementIdealInput = $request->input('retirementIdealInput');
        
        $arrayData['retirement']['retirementIdeal'] = $retirementIdealInput;

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);
        Log::debug($arrayData);
        return redirect()->route('retirement.monthly.support');
    }

    public function validateMonthlySupport(Request $request){

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        $customMessages = [
            'retirement_monthly_support.required' => 'You are required to enter an amount.',
            'retirement_monthly_support.regex' => 'You must enter number',
        ];

        $validatedData = Validator::make($request->all(), [
            'retirement_monthly_support' => [
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
        $retirement_monthly_support = str_replace(',','',$request->input('retirement_monthly_support'));
        $retirementTotalFund = floatval($retirement_monthly_support * 12);
        $totalRetirementFund = floatval($request->input('total_retirementFund'));

        if ($totalRetirementFund === $retirementTotalFund){
            $arrayData['retirement']['totalRetirementNeeded'] = $totalRetirementFund;
        }
        else{
            $arrayData['retirement']['totalRetirementNeeded'] = $retirementTotalFund;
        }

        $arrayData['retirement']['retirementMonthlySupport'] = $retirement_monthly_support;

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);
        Log::debug($arrayData);
        return redirect()->route('retirement.supporting.years');
    }

    public function validateSupportingYears(Request $request){

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        $customMessages = [
            'supporting_years.required' => 'You are required to enter a year.',
            'supporting_years.integer' => 'The year must be a number',
            'supporting_years.min' => 'The year must be at least :min.',
            'supporting_years.max' => 'The year must not more than :max.',
        ];

        $validatedData = Validator::make($request->all(), [
            'supporting_years' => 'required|integer|min:1|max:100',
        ], $customMessages);
        
        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $supporting_years = $request->input('supporting_years');
        $newRetirementTotalFund = floatval($supporting_years * $arrayData['retirement']['totalRetirementNeeded']);
        $newTotalRetirementNeeded = floatval($request->input('newTotal_retirementNeeded'));

        $arrayData['retirement']['supportingYears'] = $supporting_years;
        if ($newRetirementTotalFund === $newTotalRetirementNeeded){
            $arrayData['retirement']['newTotalRetirementNeeded'] = $newTotalRetirementNeeded;
        }
        else{
            $arrayData['retirement']['newTotalRetirementNeeded'] = $newRetirementTotalFund;
        }

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);
        Log::debug($arrayData);
        // Process the form data and perform any necessary actions
        // $formattedArray = "<pre>" . print_r($arrayData, true) . "</pre>";
        // return ($formattedArray);
        return redirect()->route('retirement.retire.age');
    }

    public function validateRetireAge(Request $request){

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        $customMessages = [
            'retirement_age.required' => 'You are required to enter a year.',
            'retirement_age.integer' => 'The year must be a number',
            'retirement_age.min' => 'The year must be at least :min.',
            'retirement_age.max' => 'The year must not more than :max.',
        ];

        $validatedData = Validator::make($request->all(), [
            'retirement_age' => 'required|integer|min:1|max:100',
        ], $customMessages);
        
        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $retirement_age = $request->input('retirement_age');

        $arrayData['retirement']['retirementAge'] = $retirement_age;

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);
        Log::debug($arrayData);
        // Process the form data and perform any necessary actions
        // $formattedArray = "<pre>" . print_r($arrayData, true) . "</pre>";
        // return ($formattedArray);
        return redirect()->route('retirement.others');
    }

    public function validateOthers(Request $request){

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        $customMessages = [
            'other_income_sources.required' => 'Please enter a source of income',
            'retirement_savings.regex' => 'The amount must be a number',
        ];

        $validatedData = Validator::make($request->all(), [
            'other_income_sources' => 'required|max:255',
            'retirement_savings' => [
                'regex:/^[0-9,]+$/',
                'nullable',
                function ($attribute, $value, $fail) use ($request) {
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
        $retirement_savings = str_replace(',','',$request->input('retirement_savings'));
        $other_income_sources = $request->input('other_income_sources');
        $newRetirementTotalAmountNeeded = floatval($arrayData['retirement']['newTotalRetirementNeeded'] - $retirement_savings);
        $totalAmountNeeded = floatval($request->input('total_amountNeeded'));
        $totalPercentage = floatval($request->input('percentage'));
        $newRetirementPercentage = floatval($retirement_savings / $arrayData['retirement']['newTotalRetirementNeeded'] * 100);

        $arrayData['retirement']['retirementSavings'] = $retirement_savings;
        $arrayData['retirement']['otherIncomeResources'] = $other_income_sources;
        if ($newRetirementTotalAmountNeeded === $totalAmountNeeded && $newRetirementPercentage === $totalPercentage){
            if ($newRetirementTotalAmountNeeded <= 0){
                $arrayData['retirement']['totalAmountNeeded'] = 0;
                $arrayData['retirement']['retirementFundPercentage'] = 100;
            }
            else{
                $arrayData['retirement']['totalAmountNeeded'] = $totalAmountNeeded;
                $arrayData['retirement']['retirementFundPercentage'] = $totalPercentage;
            }
        }
        else{
            if ($newRetirementTotalAmountNeeded <= 0){
                $arrayData['retirement']['totalAmountNeeded'] = 0;
                $arrayData['retirement']['retirementFundPercentage'] = 100;
            }
            else{
                $arrayData['retirement']['totalAmountNeeded'] = $newRetirementTotalAmountNeeded;
                $arrayData['retirement']['retirementFundPercentage'] = $newRetirementPercentage;
            }
        }

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);

        // // Process the form data and perform any necessary actions
        // $formattedArray = "<pre>" . print_r($arrayData, true) . "</pre>";
        // return ($formattedArray);
        return redirect()->route('retirement.gap');
    }

    public function submitRetirementGap(Request $request){

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);

        // // Process the form data and perform any necessary actions
        //  $formattedArray = "<pre>" . print_r($arrayData, true) . "</pre>";
        // return ($formattedArray);
        return redirect()->route('education.home');
    }

}