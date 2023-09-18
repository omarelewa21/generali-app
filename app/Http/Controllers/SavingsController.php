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

class SavingsController extends Controller
{

    public function validateSavingsCoverageSelection(Request $request)
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
            'savingsSelectedAvatarInput' => [
                'at_least_one_selected',
            ],
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $savingsSelectedAvatarInput = $request->input('savingsSelectedAvatarInput');

        $arrayData['savings']['savingsSelectedAvatar'] = $savingsSelectedAvatarInput;

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);
        Log::debug($arrayData);
        // return redirect()->route('savings.goals');
        return redirect()->route('savings.monthly.payment');
    }

    public function validateMonthlyPayment(Request $request)
    {
        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        $customMessages = [
            'savings_monthly_payment.required' => 'You are required to enter an amount.',
            'savings_monthly_payment.regex' => 'You must enter number',
        ];

        $validatedData = Validator::make($request->all(), [
            'savings_monthly_payment' => [
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
        $savings_monthly_payment = str_replace(',','',$request->input('savings_monthly_payment'));
        $totalSavingsNeeded = $request->input('total_savingsNeeded');

        $arrayData['savings']['savingsMonthlyPayment'] = $savings_monthly_payment;
        $arrayData['savings']['totalSavingsNeeded'] = $totalSavingsNeeded;

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);
        Log::debug($arrayData);
        // return $arrayData;
        return redirect()->route('savings.goal.duration');
    }

    public function validateGoalDuration(Request $request)
    {
        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        $customMessages = [
            'savings_goal_duration.required' => 'You are required to enter a year.',
            'savings_goal_duration.integer' => 'The year must be a number',
            'savings_goal_duration.min' => 'The year must be at least :min.',
            'savings_goal_duration.max' => 'The year must not more than :max.',
        ];

        $validatedData = Validator::make($request->all(), [
            'savings_goal_duration' => 'required|integer|min:1|max:100',
        ], $customMessages);
        
        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $savings_goal_duration = $request->input('savings_goal_duration');
        $totalSavingsNeeded = $request->input('total_savingsNeeded');
        $newTotalSavingsNeeded = $request->input('newTotal_savingsNeeded');

        $arrayData['savings']['savingsGoalDuration'] = $savings_goal_duration;
        $arrayData['savings']['totalSavingsNeeded'] = $totalSavingsNeeded;
        $arrayData['savings']['newTotalSavingsNeeded'] = $newTotalSavingsNeeded;

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);
        Log::debug($arrayData);
        // Process the form data and perform any necessary actions
        $formattedArray = "<pre>" . print_r($arrayData, true) . "</pre>";
        // return ($formattedArray);
        
        return redirect()->route('savings.goal.amount');
    }

    public function validateGoalAmount(Request $request){

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        $customMessages = [
            'education_other_savings.required' => 'Please select an option',
            'education_saving_amount.required_if' => 'You are required to enter an amount.',
            // 'education_saving_amount.min' => 'Your amount must be at least :min.',
            'education_saving_amount.regex' => 'The amount must be a number',
        ];

        // $validatedData = Validator::make($request->all(), [
        //     'education_other_savings' => 'required|in:yes,no',
        //     'education_saving_amount' => 'required_if:education_other_savings,yes|nullable|regex:/^[0-9,]+$/|min:1',

        // ], $customMessages);

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
        $newTotalEducationFundNeeded = $request->input('newTotal_educationFund');
        $totalAmountNeeded = $request->input('total_amountNeeded');
        $totalPercentage = $request->input('percentage');

        $arrayData['educationSavingAmount'] = $education_saving_amount;
        $arrayData['edcationSaving'] = $education_other_savings;
        $arrayData['newTotalEducationFundNeeded'] = $newTotalEducationFundNeeded;
        $arrayData['totalAmountNeeded'] = $totalAmountNeeded;
        $arrayData['educationFundPercentage'] = $totalPercentage;

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);

        // // Process the form data and perform any necessary actions
        // return ($arrayData);
        return redirect()->route('education.gap.new');
    }

    public function submitSavingsGap(Request $request){

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);
        Log::debug($arrayData);
        // // Process the form data and perform any necessary actions
        return redirect()->route('investment.home');
    }

}