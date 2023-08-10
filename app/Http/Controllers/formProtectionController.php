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

        Session::put('protectionSelectedAvatar', $protectionSelectedAvatar);
        // dd(Session::all()); // Debug to see all session data
        Log::info('Session Data:', Session::all());

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
        
        // Calculate the multiplied value
        $protectionFunds = $request->input('protectionFunds');
        $TotalprotectionFunds = $protectionFunds * 12;
        $TotalProtectionValue = $TotalprotectionFunds;
        $progressTotalProtectionValue = ($TotalProtectionValue / $TotalProtectionValue) * 100;

        // Format the calculated values for display
        $formattedTotalProtectionValue = 'RM' . number_format($TotalProtectionValue, 2, ',');
        $formattedProgressTotalProtectionValue = number_format($progressTotalProtectionValue, 2, '.', ',');

        Session::put('protectionFunds', $protectionFunds);
        Session::put('TotalprotectionFunds',$TotalprotectionFunds);
        Session::put('TotalProtectionValue', $formattedTotalProtectionValue);
        Session::put('progressTotalProtectionValue', $formattedProgressTotalProtectionValue);
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
        $TotalprotectionFunds = Session::get('TotalprotectionFunds'); 

        $TotalProtectionValue = $TotalprotectionFunds * $protectionSupportingYears;

        // Format the calculated values for display
        $formattedTotalProtectionValue = 'RM' . number_format($TotalProtectionValue, 2, ',');

        // Store the multiplied value in the session
        Session::put('protectionSupportingYears', $protectionSupportingYears);
        Session::put('TotalProtectionValue', $formattedTotalProtectionValue);
        // dd(Session::all()); // Debug to see all session data

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

        $previousTotalProtectionValue = Session::get('TotalProtectionValue'); // Assuming this key is used to store the value
        // $TotalProtectionValue = $request->input('TotalProtectionValue');
        $protectionExistingPolicy = $request->input('protectionExistingPolicy');
        $protectionPolicyAmount = $request->input('protectionPolicyAmount');
        $previousTotalProtectionValue = str_replace(['RM', ','], '', $previousTotalProtectionValue);

        // Convert the stripped value to a numeric format
        $previousTotalProtectionValue = floatval($previousTotalProtectionValue);

        $TotalProtectionValue = $previousTotalProtectionValue - $protectionPolicyAmount;
        $formattedTotalProtectionValue = 'RM' . number_format($TotalProtectionValue, 2, ',');
        Session::put('TotalProtectionValue', $formattedTotalProtectionValue);
        Session::put('protectionExistingPolicy', $protectionExistingPolicy);
        Session::put('protectionPolicyAmount', $protectionPolicyAmount);
        // dd(Session::all()); // Debug to see all session data


        // Process the form data and perform any necessary actions
        return redirect()->route('protection.gap')
            ->withInput();
    }

}