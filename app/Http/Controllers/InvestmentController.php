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
        $investmentSelectedAvatarImage = $request->input('investmentSelectedAvatarImage');

        $arrayData['investment']['investmentSelectedAvatar'] = $investmentSelectedAvatarInput;
        $arrayData['investment']['investmentSelectedImage'] = $investmentSelectedAvatarImage;

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);
        Log::debug($arrayData);

        // $formattedArray = "<pre>" . print_r($arrayData, true) . "</pre>";
        // return ($formattedArray);
        return redirect()->route('investment.monthly.payment');
    }

    public function validateInvestmentMonthlyPayment(Request $request){

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

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
        $investment_monthly_payment = str_replace(',','',$request->input('investment_monthly_payment'));
        $totalInvestmentNeeded = $request->input('total_investmentNeeded');

        $arrayData['investment']['investmentMonthlyPayment'] = $investment_monthly_payment;
        $arrayData['investment']['totalInvestmentNeeded'] = $totalInvestmentNeeded;

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);
        Log::debug($arrayData);
        // $formattedArray = "<pre>" . print_r($arrayData, true) . "</pre>";
        // return ($formattedArray);
        return redirect()->route('investment.supporting');
    }

    public function validateInvestmentSupporting(Request $request){

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        $customMessages = [
            'investment_supporting_years.required' => 'You are required to enter a year.',
            'investment_supporting_years.integer' => 'The year must be a number',
            'investment_supporting_years.min' => 'The year must be at least :min.',
            'investment_supporting_years.max' => 'The year must not more than :max.',
        ];

        $validatedData = Validator::make($request->all(), [
            'investment_supporting_years' => 'required|integer|min:1|max:100',
        ], $customMessages);
        
        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $investment_supporting_years = $request->input('investment_supporting_years');
        $totalInvestmentNeeded = $request->input('total_investmentNeeded');
        $newTotalInvestmentNeeded = $request->input('newTotal_investmentNeeded');

        $arrayData['investment']['investmentSupportingYears'] = $investment_supporting_years;
        $arrayData['investment']['totalInvestmentNeeded'] = $totalInvestmentNeeded;
        $arrayData['investment']['newTotalInvestmentNeeded'] = $newTotalInvestmentNeeded;

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);
        Log::debug($arrayData);
        // Process the form data and perform any necessary actions
        // $formattedArray = "<pre>" . print_r($arrayData, true) . "</pre>";
        // return ($formattedArray);
        return redirect()->route('investment.annual.return');
   }

   public function submitInvestmentAnnualReturn(Request $request){

        $customMessages = [
            'anuual_percentage.required' => 'You are required to enter an amount.',
            'anuual_percentage.integer' => 'The amount must be a number',
        ];

        $validatedData = $request->validate([
            'anuual_percentage' => 'required|integer',

        ], $customMessages);

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);

        // // Process the form data and perform any necessary actions
        return redirect()->route('investment.expected.return');
    }
    
    public function submitInvestmentGap(Request $request){

        $customMessages = [
            'investment_years_times.required' => 'Please enter a year',
            'investment_years_times.integer' => 'The year must be a number',
            'investment_years_times.min' => 'The year must be at least :min.',
            'investment_years_times.max' => 'The year must not more than :max.',
            'investment_annual_return.required' => 'You are required to enter an amount.',
            'investment_annual_return.integer' => 'The amount must be a number',
            'investment_aside_amount.required' => 'You are required to enter an amount.',
            'investment_aside_amount.integer' => 'The amount must be a number',
            'investment_plan_amount.required' => 'You are required to enter an amount.',
            'investment_plan_amount.integer' => 'The amount must be a number',
        ];

        $validatedData = $request->validate([
            'investment_years_times' => 'required|integer|min:1|max:100',
            'investment_annual_return' => 'required|integer',
            'investment_aside_amount' => 'required|integer',
            'investment_plan_amount' => 'required|integer',

        ], $customMessages);

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);

        // // Process the form data and perform any necessary actions
        return redirect()->route('investment.home');
    }

}