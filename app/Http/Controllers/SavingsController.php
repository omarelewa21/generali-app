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

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing savings_needs from the session
        $savings = $customerDetails['savings_needs'] ?? [];

        // Update specific keys with new values
        $savings = array_merge($savings, [
            'coveragePerson' => $savingsSelectedAvatarInput
        ]);

        // Set the updated identity_details back to the customer_details session
        $customerDetails['savings_needs'] = $savings;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        // return redirect()->route('savings.goals');
        return redirect()->route('savings.goals');
    }

    public function goals(Request $request)
    {
        $goalsSerialized = $request->input('savingsGoalsBtnInput');
        $savingsGoalsBtnInput = json_decode($goalsSerialized, true);
        
        // // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        // // Add or update the data value in the array
        $arrayData['Goals'] = $savingsGoalsBtnInput;

        // // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);

        Log::debug($arrayData);
        // Process the form data and perform any necessary actions
        return redirect()->route('savings.monthly.payment');
    }

    public function validateMonthlyPayment(Request $request)
    {
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
                    $max = 20000000;
                    if (intval($numericValue) < $min) {
                        $fail('Your amount must be at least ' .$min. '.');
                    }
                    if (intval($numericValue) > $max) {
                        $fail('Your amount must not more than RM' .number_format(floatval($max)). '.');
                    }
                },
            ],
        ], $customMessages);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $savings_monthly_payment = str_replace(',','',$request->input('savings_monthly_payment'));
        $savingsTotalFund = floatval($savings_monthly_payment * 12);
        $totalSavingsNeeded = floatval($request->input('total_savingsNeeded'));

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing savings_needs from the session
        $savings = $customerDetails['savings_needs'] ?? [];

        // Update specific keys with new values
        $savings = array_merge($savings, [
            'monthlyInvestmentAmount' => $savings_monthly_payment
        ]);

        if ($totalSavingsNeeded === $savingsTotalFund){
            $savings = array_merge($savings, [
                'totalSavingsNeeded' => $totalSavingsNeeded
            ]);
        }
        else{
            $savings = array_merge($savings, [
                'totalSavingsNeeded' => $savingsTotalFund
            ]);
        }

        // Set the updated identity_details back to the customer_details session
        $customerDetails['savings_needs'] = $savings;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        return redirect()->route('savings.goal.duration');
    }

    public function validateGoalDuration(Request $request)
    {
        $customMessages = [
            'savings_goal_duration.required' => 'You are required to enter a year.',
            'savings_goal_duration.integer' => 'The year must be a number',
            'savings_goal_duration.min' => 'The year must be at least :min.',
            'savings_goal_duration.max' => 'The year must not more than :max.',
        ];

        $validatedData = Validator::make($request->all(), [
            'savings_goal_duration' => 'required|integer|min:1|max:99',
        ], $customMessages);
        
        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing savings_needs from the session
        $savings = $customerDetails['savings_needs'] ?? [];

        // Validation passed, perform any necessary processing.
        $savings_goal_duration = $request->input('savings_goal_duration');
        $newSavingsTotalFund = floatval($savings_goal_duration * $customerDetails['savings_needs']['totalSavingsNeeded']);
        $newTotalSavingsNeeded = $request->input('newTotal_savingsNeeded');

        $savings = array_merge($savings, [
            'investmentTimeFrame' => $savings_goal_duration
        ]);

        if ($newSavingsTotalFund === $newTotalSavingsNeeded){
            $savings = array_merge($savings, [
                'newTotalSavingsNeeded' => $newTotalSavingsNeeded
            ]);
        }
        else{
            $savings = array_merge($savings, [
                'newTotalSavingsNeeded' => $newSavingsTotalFund
            ]);
        }

        // Set the updated identity_details back to the customer_details session
        $customerDetails['savings_needs'] = $savings;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);
        
        return redirect()->route('savings.annual.return');
    }

    public function validateSavingsAnnualReturn(Request $request){

        $customMessages = [
            'savings_goal_pa.required' => 'You are required to enter annual return percentage',
            'savings_goal_pa.numeric' => 'The input must be a number',
            'savings_goal_pa.min' => 'The input must be at least :min.',
            'savings_goal_pa.max' => 'The input must not more than :max.',
        ];

        $validatedData = Validator::make($request->all(), [
            'savings_goal_pa' => 'required|numeric|min:1|max:100',
        ], $customMessages);
        
        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing savings_needs from the session
        $savings = $customerDetails['savings_needs'] ?? [];

        // Validation passed, perform any necessary processing.
        $savings_goal_pa = $request->input('savings_goal_pa');
        $totalAnnualReturn = $request->input('total_annualReturn');
        $newTotalAnnualReturn = $customerDetails['savings_needs']['newTotalSavingsNeeded'] * $savings_goal_pa / 100;
        $totalPercentage = $request->input('percentage');
        $newSavingsPercentage = floatval($newTotalAnnualReturn / $customerDetails['savings_needs']['newTotalSavingsNeeded'] * 100);

        // Update specific keys with new values
        $savings = array_merge($savings, [
            'annualReturn' => $savings_goal_pa
        ]);

        if ($newTotalAnnualReturn === $totalAnnualReturn && $newSavingsPercentage === $totalPercentage){
            if ($newTotalAnnualReturn <= 0){
                $savings = array_merge($savings, [
                    'annualReturnAmount' => '0',
                    'fundPercentage' => '100'
                ]);
            }
            else{
                $savings = array_merge($savings, [
                    'annualReturnAmount' => $totalAnnualReturn,
                    'fundPercentage' => $totalPercentage
                ]);
            }
        }
        else{
            if ($newTotalAnnualReturn <= 0){
                $savings = array_merge($savings, [
                    'annualReturnAmount' => '0',
                    'fundPercentage' => '100'
                ]);
            }
            else{
                $savings = array_merge($savings, [
                    'annualReturnAmount' => $newTotalAnnualReturn,
                    'fundPercentage' => $newSavingsPercentage
                ]);
            }
        }

        // Set the updated identity_details back to the customer_details session
        $customerDetails['savings_needs'] = $savings;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);
        
        return redirect()->route('savings.risk.profile');
    }

    public function validateSavingsRiskProfile(Request $request){

        // Define custom validation rule for button selection
        Validator::extend('at_least_one_selected', function ($attribute, $value, $parameters, $validator) {
            if ($value !== null) {
                return true;
            }
            
            $customMessage = "Please select at least one risk.";
            $validator->errors()->add($attribute, $customMessage);
    
            return false;
        });

        $validator = Validator::make($request->all(), [
            'savingsRiskProfileInput' => [
                'at_least_one_selected',
            ],
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $savingsRiskProfileInput = $request->input('savingsRiskProfileInput');

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing savings_needs from the session
        $savings = $customerDetails['savings_needs'] ?? [];

        // Update specific keys with new values
        $savings = array_merge($savings, [
            'riskProfile' => $savingsRiskProfileInput
        ]);

        // Set the updated identity_details back to the customer_details session
        $customerDetails['savings_needs'] = $savings;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);
        
        // // Process the form data and perform any necessary actions
        return redirect()->route('savings.gap');
    }

    public function submitSavingsGap(Request $request){

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing savings_needs from the session
        $savings = $customerDetails['savings_needs'] ?? [];

        // Set the updated identity_details back to the customer_details session
        $customerDetails['savings_needs'] = $savings;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);
        
        // // Process the form data and perform any necessary actions
        
        return redirect()->route('investment.home');
    }

}