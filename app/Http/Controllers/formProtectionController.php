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

        $protectionSelectedAvatar = $request->input('protectionSelectedAvatar');

        // Get the existing array from the session
        $arrayDataProtection = session('passingArraysProtection', []);
        $arrayDataProtection['protectionSelectedAvatar'] = $protectionSelectedAvatar;

        // Store the updated array back into the session
        session(['passingArraysProtection' => $arrayDataProtection]);

        // dd(Session::all()); // Debug to see all session data
        Log::info('Session Data:', Session::all());

        return redirect()->route('protection.monthly.support')
            ->withInput();
    }
    public function submitProtectionMonthlySupport(Request $request)
    {
        $customMessages = [
            'protectionFunds.required' => 'You are required to enter an amount.',
            'protectionFunds.integer' => 'The amount must be in numbers',
            'protectionFunds.min' => 'The amount must be at least :min.',
        ];

        $validatedData = $request->validate([
            'protectionFunds' => 'required|integer|min:1',

        ], $customMessages);

        // Calculate the multiplied value
        $protectionFunds = $request->input('protectionFunds');

        $TotalProtectionValue = session('passingArraysProtection.TotalProtectionValue');
        $protectionsupportingYears = session('passingArraysProtection.protectionSupportingYears');

        if ($TotalProtectionValue = null || $TotalProtectionValue != 0) {
            $TotalProtectionValue = $protectionFunds * 12 * $protectionsupportingYears;
        } else {
            $TotalProtectionValue = $protectionFunds * 12;
        }
        // Get the existing array from the session
        $arrayDataProtection = session('passingArraysProtection', []);

        //update the array
        $arrayDataProtection['protectionFunds'] = $protectionFunds;
        $arrayDataProtection['TotalProtectionValue'] = $TotalProtectionValue;

        $formattedTotalProtectionValue = number_format($TotalProtectionValue, 0, '.', ',');

        $arrayDataProtection['formattedTotalProtectionValue'] = $formattedTotalProtectionValue;

        // Store the updated array back into the session
        session(['passingArraysProtection' => $arrayDataProtection]);
        Log::info('Session Data:', Session::all());
        // dd(Session::all()); // Debug to see all session data
        return redirect()->route('protection.supporting.years')
            ->withInput();
    }
    public function submitProtectionSupportingYears(Request $request)
    {
        $customMessages = [
            'protectionSupportingYears.required' => 'You are required to enter the year.',
            'protectionSupportingYears.integer' => 'The year must be a number',
            'protectionSupportingYears.min' => 'The year must be at least :min.',
            'protectionSupportingYears.max' => 'The year must not more than :max.',
        ];
        $validatedData = $request->validate([
            'protectionSupportingYears' => 'required|integer|min:1|max:100',

        ], $customMessages);

        $protectionSupportingYears = $request->input('protectionSupportingYears');

        // Get the existing array from the session
        $arrayDataProtection = session('passingArraysProtection', []);

        $protectionFunds = $arrayDataProtection['protectionFunds'];
        $TotalProtectionValue = $protectionFunds * 12 * $protectionSupportingYears;
        $formattedTotalProtectionValue = number_format($TotalProtectionValue, 0, '.', ',');

        //update the array
        $arrayDataProtection['protectionSupportingYears'] = $protectionSupportingYears;
        $arrayDataProtection['formattedTotalProtectionValue'] = $formattedTotalProtectionValue;

        Log::info('Session Data:', Session::all());

        //store the updated array back into the session
        session(['passingArraysProtection' =>  $arrayDataProtection]);

        // Process the form data and perform any necessary actions
        return redirect()->route('protection.existing.policy')
            ->withInput();
    }

    public function submitProtectionExistingPolicy(Request $request)
    {

        $customMessages = [
            'protectionExistingPolicy.required' => 'Please select an option',
            'protectionPolicyAmount.required_if' => 'The protection policy amount is required when an existing policy is selected.',
            'protectionPolicyAmount.numeric' => 'Please enter a valid numeric value for the protection policy amount.',
        ];
        $validatedData = $request->validate([
            'protectionExistingPolicy' => 'required|in:yes,no',
            'protectionPolicyAmount' => 'required_if:protectionExistingPolicy,yes|numeric',

        ], $customMessages);

        $protectionExistingPolicy = $request->input('protectionExistingPolicy');
        $protectionPolicyAmount = $request->input('protectionPolicyAmount');

        $TotalProtectionValue = session('passingArraysProtection.TotalProtectionValue');

        $protectionPolicyAmount = ($protectionExistingPolicy == 'yes') ? $protectionPolicyAmount : 0;

        $protectionGap = $protectionPolicyAmount - $TotalProtectionValue;
        // Get the existing array from the session
        $arrayDataProtection = session('passingArraysProtection', []);

        if ($protectionGap > 0) {
            $protectionGap = 0;
        }
        else if ($protectionGap < 0) {
            $protectionGap = abs($protectionGap);
        }
        //update the array
        $arrayDataProtection['protectionExistingPolicy'] = $protectionExistingPolicy;
        $arrayDataProtection['protectionPolicyAmount'] = $protectionPolicyAmount;
        $arrayDataProtection['protectionGap'] = $protectionGap;



        // Store the updated array back into the session
        session(['passingArraysProtection' => $arrayDataProtection]);
        Log::info('Session Data:', Session::all());


        // Process the form data and perform any necessary actions
        return redirect()->route('protection.gap')
            ->withInput();
    }

}