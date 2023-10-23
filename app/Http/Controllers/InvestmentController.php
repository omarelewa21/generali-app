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

class InvestmentController extends Controller
{
    public function validateInvestmentCoverageSelection(Request $request)
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
            'investmentSelectedAvatarInput' => [
                'at_least_one_selected',
            ],
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $investmentSelectedAvatarInput = $request->input('investmentSelectedAvatarInput');

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing investment_needs from the session
        $investment = $customerDetails['investment_needs'] ?? [];

        // Update specific keys with new values
        $investment = array_merge($investment, [
            'coveragePerson' => $investmentSelectedAvatarInput
        ]);

        // Set the updated identity_details back to the customer_details session
        $customerDetails['investment_needs'] = $investment;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        return redirect()->route('investment.monthly.payment');
    }

    public function validateInvestmentMonthlyPayment(Request $request){

        $customMessages = [
            'investment_monthly_payment.required' => 'You are required to enter an amount.',
            'investment_monthly_payment.regex' => 'You must enter number',
        ];

        $validatedData = Validator::make($request->all(), [
            'investment_monthly_payment' => [
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
        $investment_monthly_payment = str_replace(',','',$request->input('investment_monthly_payment'));
        $investmentTotalFund = floatval($investment_monthly_payment * 12);
        $totalInvestmentNeeded = $request->input('total_investmentNeeded');

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing investment_needs from the session
        $investment = $customerDetails['investment_needs'] ?? [];

        // Update specific keys with new values
        $investment = array_merge($investment, [
            'monthlyInvestmentAmount' => $investment_monthly_payment
        ]);

        if ($totalInvestmentNeeded === $investmentTotalFund){
            $investment = array_merge($investment, [
                'totalInvestmentNeeded' => $totalInvestmentNeeded
            ]);
        }
        else{
            $investment = array_merge($investment, [
                'totalInvestmentNeeded' => $investmentTotalFund
            ]);
        }

        // Set the updated identity_details back to the customer_details session
        $customerDetails['investment_needs'] = $investment;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        return redirect()->route('investment.supporting');
    }

    public function validateInvestmentSupporting(Request $request){

        $customMessages = [
            'investment_supporting_years.required' => 'You are required to enter a year.',
            'investment_supporting_years.integer' => 'The year must be a number',
            'investment_supporting_years.min' => 'The year must be at least :min.',
            'investment_supporting_years.max' => 'The year must not more than :max.',
        ];

        $validatedData = Validator::make($request->all(), [
            'investment_supporting_years' => 'required|integer|min:1|max:99',
        ], $customMessages);
        
        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing investment_needs from the session
        $investment = $customerDetails['investment_needs'] ?? [];

        // Validation passed, perform any necessary processing.
        $investment_supporting_years = $request->input('investment_supporting_years');
        $newInvestmentTotalFund = floatval($investment_supporting_years * $customerDetails['investment_needs']['totalInvestmentNeeded']);
        $newTotalInvestmentNeeded = $request->input('newTotal_investmentNeeded');

        $investment = array_merge($investment, [
            'investmentTimeFrame' => $investment_supporting_years
        ]);

        if ($newInvestmentTotalFund === $newTotalInvestmentNeeded){
            $investment = array_merge($investment, [
                'newTotalInvestmentNeeded' => $newTotalInvestmentNeeded
            ]);
        }
        else{
            $investment = array_merge($investment, [
                'newTotalInvestmentNeeded' => $newInvestmentTotalFund
            ]);
        }

        // Set the updated identity_details back to the customer_details session
        $customerDetails['investment_needs'] = $investment;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        return redirect()->route('investment.annual.return');
    }

    public function validateInvestmentAnnualReturn(Request $request){

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        $customMessages = [
            'investment_pa.required' => 'You are required to enter annual return percentage',
            'investment_pa.numeric' => 'The input must be a number',
            'investment_pa.min' => 'The input must be at least :min.',
            'investment_pa.max' => 'The input must not more than :max.',
        ];

        $validatedData = Validator::make($request->all(), [
            'investment_pa' => 'required|numeric|min:1|max:100',
        ], $customMessages);
        
        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing investment_needs from the session
        $investment = $customerDetails['investment_needs'] ?? [];

        // Validation passed, perform any necessary processing.
        $investment_pa = $request->input('investment_pa');
        $totalAnnualReturn = $request->input('total_annualReturn');
        $newTotalAnnualReturn = $customerDetails['investment_needs']['newTotalInvestmentNeeded'] * $investment_pa / 100;
        $totalPercentage = $request->input('percentage');
        $newInvestmentPercentage = floatval($newTotalAnnualReturn / $customerDetails['investment_needs']['newTotalInvestmentNeeded'] * 100);

        // Update specific keys with new values
        $investment = array_merge($investment, [
            'annualReturn' => $investment_pa
        ]);

        if ($newTotalAnnualReturn === $totalAnnualReturn && $newInvestmentPercentage === $totalPercentage){
            if ($newTotalAnnualReturn <= 0){
                $investment = array_merge($investment, [
                    'annualReturnAmount' => '0',
                    'fundPercentage' => '100'
                ]);
            }
            else{
                $investment = array_merge($investment, [
                    'annualReturnAmount' => $totalAnnualReturn,
                    'fundPercentage' => $totalPercentage
                ]);
            }
        }
        else{
            if ($newTotalAnnualReturn <= 0){
                $investment = array_merge($investment, [
                    'annualReturnAmount' => '0',
                    'fundPercentage' => '100'
                ]);
            }
            else{
                $investment = array_merge($investment, [
                    'annualReturnAmount' => $newTotalAnnualReturn,
                    'fundPercentage' => $newInvestmentPercentage
                ]);
            }
        }

        // Set the updated identity_details back to the customer_details session
        $customerDetails['investment_needs'] = $investment;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        return redirect()->route('investment.risk.profile');
    }

    public function validateInvestmentRiskProfile(Request $request){

        $customMessages = [
            'investmentRiskProfileInput.required' => 'Please select a risk level.',
            'investmentRiskProfileInput.in' => 'Invalid risk level selected.',
            'investmentPotentialReturnInput.required_if' => 'Please select a potential return for the chosen risk level.',
        ];

        $validatedData = Validator::make($request->all(), [
            'investmentRiskProfileInput' => 'required|in:High Risk,Medium Risk,Low Risk',
            'investmentPotentialReturnInput' => 'required_if:investmentRiskProfileInput,High Risk,Medium Risk,Low Risk',
            
        ], $customMessages);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $investmentRiskProfileInput = $request->input('investmentRiskProfileInput');
        $investmentPotentialReturnInput = $request->input('investmentPotentialReturnInput');

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing investment_needs from the session
        $investment = $customerDetails['investment_needs'] ?? [];

        // Update specific keys with new values
        $investment = array_merge($investment, [
            'riskProfile' => $investmentRiskProfileInput
            'potentialReturn' => $investmentPotentialReturnInput
        ]);

        // Set the updated identity_details back to the customer_details session
        $customerDetails['investment_needs'] = $investment;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);
        
        // // Process the form data and perform any necessary actions
        return redirect()->route('investment.gap');
    }
    
    public function submitInvestmentGap(Request $request){

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing investment_needs from the session
        $investment = $customerDetails['investment_needs'] ?? [];

        // Set the updated identity_details back to the customer_details session
        $customerDetails['investment_needs'] = $investment;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        // $formattedArray = "<pre>" . print_r($customerDetails, true) . "</pre>";
        // return ($formattedArray);
        return redirect()->route('health.medical.home');
    }

}