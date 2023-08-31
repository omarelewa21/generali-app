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
   public function submitEducationSupporting(Request $request){

        $customMessages = [
            'education_year_1.required' => 'You are required to enter the age.',
            'education_year_1.integer' => 'The age must be a number',
            'education_year_1.min' => 'Your age must be at least :min.',
            'education_year_1.max' => 'Your age must not more than :max.',
            'education_year_2.required' => 'You are required to enter the age.',
            'education_year_2.integer' => 'The age must be a number',
            'education_year_2.min' => 'Your age must be at least :min.',
            'education_year_2.max' => 'Your age must not more than :max.',
            'education_year_3.required' => 'You are required to enter the age.',
            'education_year_3.integer' => 'The age must be a number',
            'education_year_3.min' => 'Your age must be at least :min.',
            'education_year_3.max' => 'Your age must not more than :max.',
        ];

        $validatedData = Validator::make($request->all(), [
            'education_year_1' => 'required|integer|min:1|max:100',
            'education_year_2' => 'required|integer|min:1|max:100',
            'education_year_3' => 'required|integer|min:1|max:100',

        // ], $customMessages);
        ], $customMessages)
        ->after(function ($validator) use ($request) {
            $education_year_1 = intval($request->input('education_year_1'));
            $education_year_2 = intval($request->input('education_year_2'));
            $education_year_3 = intval($request->input('education_year_3'));
        
            if ($education_year_1 <= $education_year_2) {
                $validator->errors()->add('education_year_2', "2nd Child must be younger than 1st Child.");
            }
        
            if ($education_year_2 <= $education_year_3 || $education_year_1 <= $education_year_3) {
                $validator->errors()->add('education_year_3', "3rd Child must be younger than 2nd Child.");
            }
        })
        ->validate();

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);

        // Process the form data and perform any necessary actions
        return redirect()->route('education.other');
   }

   public function submitEducationOther(Request $request){

        $customMessages = [
            'education_other_savings.required' => 'Please select an option',
            'education_saving_amount.required_if' => 'You are required to enter an amount.',
            'education_saving_amount.integer' => 'The amount must be a number',
        ];

        $validatedData = $request->validate([
            'education_other_savings' => 'required|in:yes,no',
            'education_saving_amount' => 'required_if:education_other_savings,yes|nullable|integer',

        ], $customMessages);

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);

        // // Process the form data and perform any necessary actions
        return redirect()->route('education.gap');
    }

   public function submitEducationGap(Request $request){

        $customMessages = [
            'education_years_times.required' => 'Please enter a year',
            'education_years_times.integer' => 'The year must be a number',
            'education_years_times.min' => 'The year must be at least :min.',
            'education_years_times.max' => 'The year must not more than :max.',
            'education_amount_per_year.required' => 'You are required to enter an amount.',
            'education_amount_per_year.integer' => 'The amount must be a number',
            'education_aside_amount.required' => 'You are required to enter an amount.',
            'education_aside_amount.integer' => 'The amount must be a number',
            'education_plan_amount.required' => 'You are required to enter an amount.',
            'education_plan_amount.integer' => 'The amount must be a number',
        ];

        $validatedData = $request->validate([
            'education_years_times' => 'required|integer|min:1|max:100',
            'education_amount_per_year' => 'required|integer',
            'education_aside_amount' => 'required|integer',
            'education_plan_amount' => 'required|integer',

        ], $customMessages);

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
        $arrayDataEducation = session('passingArrays', []);

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
        $arrayDataEducation['educationSelectedAvatar'] = $educationSelectedAvatarInput;
        $arrayDataEducation['educationSelectedImage'] = $educationSelectedImage;

        // Store the updated array back into the session
        session(['passingArrays' => $arrayDataEducation]);
        Log::debug($arrayDataEducation);
        return redirect()->route('education.supporting.years');
    }

}