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



class formProtectionController extends Controller
{

    public function submitProtectionCoverage(Request $request)
    {
        $customMessages = [
            'protectionSelectedAvatar' => 'Please select an option',
        ];
        $validatedData = $request->validate([
            'protectionSelectedAvatar' => 'required|in:self,spouse,children,parent',

        ], $customMessages);

        // Process the form data and perform any necessary actions
        return redirect()->route('protection.monthly.support')
        ->withInput(); 
    }
    public function submitProtectionMonthlySupport(Request $request)
    {
        $customMessages = [
            'protectionFunds.required' => 'You are required to enter an amount.',
            'protectionFunds.integer' => 'The amount must be a number',
            'protectionFunds.min' => 'The amount must be at least :min.',
        ];

        $validatedData = $request->validate([
            'protectionFunds' => 'required|integer|min:1',

        ], $customMessages);

        return redirect()->route('protection.supporting.years')
                ->withInput(); 
    }
    public function submitProtectionSupportingYears(Request $request){

        $customMessages = [
            'protectionSupportingYears.required' => 'You are required to enter the year.',
            'protectionSupportingYears.integer' => 'The year must be a number',
            'protectionSupportingYears.min' => 'The year must be at least :min.',
            'protectionSupportingYears.max' => 'The year must not more than :max.',
        ];
        $validatedData = $request->validate([
            'protectionSupportingYears' => 'required|integer|min:1|max:100',

        ], $customMessages);

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);

        // Process the form data and perform any necessary actions
        return redirect()->route('protection.existing.policy')
        ->withInput(); 
   }

   public function submitProtectionExistingPolicy(Request $request){

        $customMessages = [
            'protectionExistingPolicy.required' => 'Please select an option',
        ];
        $validatedData = $request->validate([
            'protectionExistingPolicy' => 'required|in:yes,no',

        ], $customMessages);

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);

        // Process the form data and perform any necessary actions
        return redirect()->route('protection.gap')
        ->withInput(); 
   }
    
    
}
