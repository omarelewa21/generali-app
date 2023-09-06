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
    public function submitEducationMonthly(Request $request){

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        $customMessages = [
            'monthly_education_amount.required' => 'You are required to enter an amount.',
            'monthly_education_amount.min' => 'Your amount must be at least :min.',
            'monthly_education_amount.regex' => 'You must enter number',
        ];

        $validatedData = Validator::make($request->all(), [
            'monthly_education_amount' => 'required|min:1|regex:/^[0-9,]+$/',
        ], $customMessages);
        
        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $monthly_education_amount = str_replace(',','',$request->input('monthly_education_amount'));
        $totalEducationFund = $request->input('total_educationFund');

        $arrayData['educationMonthlyAmount'] = $monthly_education_amount;
        $arrayData['totalEducationFundNeeded'] = $totalEducationFund;

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);
        Log::debug($arrayData);
        // Process the form data and perform any necessary actions
        // return $arrayData;
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
        $totalEducationFund = $request->input('total_educationFund');

        $arrayData['totalEducationYear'] = $tertiary_education_years;
        $arrayData['totalEducationFundNeeded'] = $totalEducationFund;

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);
        Log::debug($arrayData);
        // Process the form data and perform any necessary actions
        // return $arrayData;
        return redirect()->route('education.other');
   }

    public function submitEducationOther(Request $request){

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        $customMessages = [
            'education_other_savings.required' => 'Please select an option',
            'education_saving_amount.required_if' => 'You are required to enter an amount.',
            'education_saving_amount.min' => 'Your amount must be at least :min.',
            'education_saving_amount.regex' => 'The amount must be a number',
        ];

        $validatedData = Validator::make($request->all(), [
            'education_other_savings' => 'required|in:yes,no',
            'education_saving_amount' => 'required_if:education_other_savings,yes|nullable|regex:/^[0-9,]+$/|min:2',

        ], $customMessages);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        // Validation passed, perform any necessary processing.
        $education_saving_amount = str_replace(',','',$request->input('education_saving_amount'));
        $education_other_savings = $request->input('education_other_savings');
        $totalEducationFund = $request->input('total_educationFund');
        $totalAmountNeeded = $request->input('total_amountNeeded');
        $totalPercentage = $request->input('percentage');

        $arrayData['educationSavingAmount'] = $education_saving_amount;
        $arrayData['edcationSaving'] = $education_other_savings;
        $arrayData['totalEducationFundNeeded'] = $totalEducationFund;
        $arrayData['totalAmountNeeded'] = $totalAmountNeeded;
        $arrayData['educationFundPercentage'] = $totalPercentage;

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);

        // // Process the form data and perform any necessary actions
        return $arrayData;
        // return redirect()->route('education.gap.new');
    }

   public function submitEducationGap(Request $request){

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);

        // // Process the form data and perform any necessary actions
        return redirect()->route('investment.home');
    }
    
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

        // Add or update the data value in the array
        // if ($educationSelectedAvatarInput) { 
        // }
        $arrayData['educationSelectedAvatar'] = $educationSelectedAvatarInput;
        $arrayData['educationSelectedImage'] = $educationSelectedImage;

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);
        Log::debug($arrayData);
        return redirect()->route('education.monthly.amount');
    }

}