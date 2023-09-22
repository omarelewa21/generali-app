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
        // return redirect()->route('savings.goals');
        return redirect()->route('investment.supporting');
    }

   public function submitInvestmentSupporting(Request $request){

        $customMessages = [
            'invest_year.required' => 'You are required to enter the year.',
            'invest_year.integer' => 'The year must be a number',
            'invest_year.min' => 'The year must be at least :min.',
            'invest_year.max' => 'The year must not more than :max.',
        ];

        $validatedData = Validator::make($request->all(), [
            'invest_year' => 'required|integer|min:1|max:100',

        // ], $customMessages);
        ], $customMessages)
        ->after(function ($validator) use ($request) {
            $invest_year = intval($request->input('invest_year'));
        })
        ->validate();

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        $total_investment_fund_needed = $request->input('total_investment_fund_needed');

        $arrayData['TotalInvestmentFundNeeded'] = $total_investment_fund_needed;

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);

        // Process the form data and perform any necessary actions
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

    public function submitInvestmentExpectedReturn(Request $request){

        $customMessages = [
            'monthly_return.required' => 'You are required to enter an amount.',
            'monthly_return.integer' => 'The amount must be a number',
        ];

        $validatedData = $request->validate([
            'monthly_return' => 'required|integer',

        ], $customMessages);

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);

        // // Process the form data and perform any necessary actions
        return redirect()->route('investment.gap');
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