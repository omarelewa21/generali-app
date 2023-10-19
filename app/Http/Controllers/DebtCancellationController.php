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

class DebtCancellationController extends Controller
{
    public function validateDebtCancellationCoverage(Request $request)
    {
        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing debt_cancellation_needs from the session
        $debtCancellation = $customerDetails['debt_cancellation_needs'] ?? [];

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
            'debtSelectedAvatarInput' => [
                'at_least_one_selected',
            ],
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $debtSelectedAvatarInput = $request->input('debtSelectedAvatarInput');

        // Update specific keys with new values
        $debtCancellation = array_merge($debtCancellation, [
            'coveragePerson' => $debtSelectedAvatarInput
        ]);

        // Set the updated identity_details back to the customer_details session
        $customerDetails['debt_cancellation_needs'] = $debtCancellation;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);
    
        return redirect()->route('debt.cancellation.outstanding.loan');
    }

    public function validateDebtCancellationOutstandingLoan(Request $request){

        $customMessages = [
            'debt_outstanding_loan.required' => 'You are required to enter an amount.',
            'debt_outstanding_loan.regex' => 'You must enter number',
        ];

        $validatedData = Validator::make($request->all(), [
            'debt_outstanding_loan' => [
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
        $debt_outstanding_loan = str_replace(',','',$request->input('debt_outstanding_loan'));
        $totalDebtFund = floatval($request->input('total_debtFund'));

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing protection_needs from the session
        $debtCancellation = $customerDetails['debt_cancellation_needs'] ?? [];

        // Update specific keys with new values
        $debtCancellation = array_merge($debtCancellation, [
            'outstandingLoan' => $debt_outstanding_loan,
            'totalDebtCancellationFund' => $totalDebtFund
        ]);

        // Set the updated protection back to the customer_details session
        $customerDetails['debt_cancellation_needs'] = $debtCancellation;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        // Process the form data and perform any necessary actions
        return redirect()->route('debt.cancellation.settlement.years');
    }
    public function validateDebtCancellationSettlementYears(Request $request){

        $customMessages = [
            'debt_settlement_years.required' => 'You are required to enter a year.',
            'debt_settlement_years.integer' => 'The year must be a number',
            'debt_settlement_years.min' => 'The year must be at least :min.',
            'debt_settlement_years.max' => 'The year must not more than :max.',
        ];

        $validatedData = Validator::make($request->all(), [
            'debt_settlement_years' => 'required|integer|min:1|max:99',
        ], $customMessages);
        
        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing protection_needs from the session
        $debtCancellation = $customerDetails['debt_cancellation_needs'] ?? [];

        // Validation passed, perform any necessary processing.
        $debt_settlement_years = $request->input('debt_settlement_years');

        // Update specific keys with new values
        $debtCancellation = array_merge($debtCancellation, [
            'remainingYearsOfSettlement' => $debt_settlement_years
        ]);

        // Set the updated protection back to the customer_details session
        $customerDetails['debt_cancellation_needs'] = $debtCancellation;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        // Process the form data and perform any necessary actions
        return redirect()->route('debt.cancellation.existing.debt');
    }

    public function validateProtectionExistingPolicy(Request $request){

        $customMessages = [
            'protection_existing_policy.required' => 'Please select an option',
            'existing_policy_amount.required_if' => 'You are required to enter an amount.',
            'existing_policy_amount.regex' => 'The amount must be a number',
        ];

        $validatedData = Validator::make($request->all(), [
            'protection_existing_policy' => 'required|in:yes,no',
            'existing_policy_amount' => [
                'nullable',
                'regex:/^[0-9,]+$/',
                'required_if:protection_existing_policy,yes',
                function ($attribute, $value, $fail) use ($request) {
                    // Remove commas and check if the value is at least 1
                    $numericValue = str_replace(',', '', $value);
                    $min = 1;
                    if (intval($numericValue) < $min && $request->input('protection_existing_policy') === 'yes') {
                        $fail('Your amount must be at least ' .$min. '.');
                    }
                },
            ],
        ], $customMessages);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing identity_details from the session
        $protection = $customerDetails['protection_needs'] ?? [];

        // Validation passed, perform any necessary processing.
        $existing_policy_amount = str_replace(',','',$request->input('existing_policy_amount'));
        $protection_existing_policy = $request->input('protection_existing_policy');
        $newProtectionTotalAmountNeeded = floatval($customerDetails['protection_needs']['newTotalProtectionNeeded'] - $existing_policy_amount);
        $totalAmountNeeded = floatval($request->input('total_amountNeeded'));
        $totalPercentage = floatval($request->input('percentage'));
        $newProtectionPercentage = floatval($existing_policy_amount / $customerDetails['protection_needs']['newTotalProtectionNeeded'] * 100);

        // Update specific keys with new values
        $protection = array_merge($protection, [
            'existingPolicyAmount' => $existing_policy_amount,
            'existingPolicy' => $protection_existing_policy
        ]);

        if ($newProtectionTotalAmountNeeded === $totalAmountNeeded && $newProtectionPercentage === $totalPercentage){
            if ($newProtectionTotalAmountNeeded <= 0){
                $protection = array_merge($protection, [
                    'totalAmountNeeded' => '0',
                    'fundPercentage' => '100'
                ]);
            }
            else{
                $protection = array_merge($protection, [
                    'totalAmountNeeded' => $totalAmountNeeded,
                    'fundPercentage' => $totalPercentage
                ]);
            }
        }
        else{
            if ($newProtectionTotalAmountNeeded <= 0){
                $protection = array_merge($protection, [
                    'totalAmountNeeded' => '0',
                    'fundPercentage' => '100'
                ]);
            }
            else{
                $protection = array_merge($protection, [
                    'totalAmountNeeded' => $newProtectionTotalAmountNeeded,
                    'fundPercentage' => $newProtectionPercentage
                ]);
            }
        }

        // Set the updated protection back to the customer_details session
        $customerDetails['protection_needs'] = $protection;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        // // Process the form data and perform any necessary actions
        // $formattedArray = "<pre>" . print_r($customerDetails, true) . "</pre>";
        // return ($formattedArray);
        return redirect()->route('protection.gap');
    }

    public function submitProtectionGap(Request $request){

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing identity_details from the session
        $protection = $customerDetails['protection_needs'] ?? [];

        // Set the updated protection back to the customer_details session
        $customerDetails['protection_needs'] = $protection;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        // // Process the form data and perform any necessary actions
        //  $formattedArray = "<pre>" . print_r($customerDetails, true) . "</pre>";
        // return ($formattedArray);
        return redirect()->route('retirement.home');
    }

}