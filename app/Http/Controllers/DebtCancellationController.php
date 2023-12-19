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

        // Get existing debt-cancellation_needs from the session
        $debtCancellation = $customerDetails['debt-cancellation_needs'] ?? [];

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
            'relationshipInput' => [
                'at_least_one_selected',
            ],
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $relationshipInput = $request->input('relationshipInput');
        $selectedInsuredNameInput = $request->input('selectedInsuredNameInput');
        $selectedCoverForDobInput = $request->input('selectedCoverForDobInput');
        $othersCoverForNameInput = $request->input('othersCoverForNameInput');
        $othersCoverForDobInput = $request->input('othersCoverForDobInput');

        // Update specific keys with new values
        $debtCancellation = array_merge($debtCancellation, [
            'coverFor' => $relationshipInput,
            'selectedInsuredName' => $selectedInsuredNameInput,
            'selectedCoverForDob' => $selectedCoverForDobInput,
            'othersCoverForName' => $othersCoverForNameInput,
            'othersCoverForDob' => $othersCoverForDobInput
        ]);

        // Set the updated debt_cancellation_needs back to the customer_details session
        $customerDetails['debt-cancellation_needs'] = $debtCancellation;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);
    
        return redirect()->route('debt.cancellation.amount.needed');
    }

    public function validateDebtCancellationAmountNeeded(Request $request){

        $customMessages = [
            'debt_outstanding_loan.required' => 'You are required to enter an amount.',
            'debt_outstanding_loan.regex' => 'You must enter number.',
            'debt_settlement_years.required' => 'You are required to enter a year.',
            'debt_settlement_years.integer' => 'The year must be a number.',
            'debt_settlement_years.min' => 'The year must be at least :min.',
            'debt_settlement_years.max' => 'The year must not more than :max.',
        ];

        $validatedData = Validator::make($request->all(), [
            'debt_settlement_years' => 'required|integer|min:1|max:99',
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
        $debt_settlement_years = $request->input('debt_settlement_years');
        $totalDebtFund = floatval($request->input('total_debtFund'));

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing debt-cancellation_needs from the session
        $debtCancellation = $customerDetails['debt-cancellation_needs'] ?? [];

        // Update specific keys with new values
        $debtCancellation = array_merge($debtCancellation, [
            'outstandingLoan' => $debt_outstanding_loan,
            'remainingYearsOfSettlement' => $debt_settlement_years,
            'totalDebtCancellationFund' => $totalDebtFund
        ]);

        // Set the updated debt-cancellation_needs back to the customer_details session
        $customerDetails['debt-cancellation_needs'] = $debtCancellation;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        // Process the form data and perform any necessary actions
        //  $formattedArray = "<pre>" . print_r($customerDetails, true) . "</pre>";
        // return ($formattedArray);
        return redirect()->route('debt.cancellation.existing.debt');
    }

    // public function validateDebtCancellationOutstandingLoan(Request $request){

    //     $customMessages = [
    //         'debt_outstanding_loan.required' => 'You are required to enter an amount.',
    //         'debt_outstanding_loan.regex' => 'You must enter number',
    //     ];

    //     $validatedData = Validator::make($request->all(), [
    //         'debt_outstanding_loan' => [
    //             'required',
    //             'regex:/^[0-9,]+$/',
    //             function ($attribute, $value, $fail) {
    //                 // Remove commas and check if the value is at least 1
    //                 $numericValue = str_replace(',', '', $value);
    //                 $min = 1;
    //                 $max = 20000000;
    //                 if (intval($numericValue) < $min) {
    //                     $fail('Your amount must be at least ' .$min. '.');
    //                 }
    //                 if (intval($numericValue) > $max) {
    //                     $fail('Your amount must not more than RM' .number_format(floatval($max)). '.');
    //                 }
    //             },
    //         ],
    //     ], $customMessages);
        
        
    //     if ($validatedData->fails()) {
    //         return redirect()->back()->withErrors($validatedData)->withInput();
    //     }

    //     // Validation passed, perform any necessary processing.
    //     $debt_outstanding_loan = str_replace(',','',$request->input('debt_outstanding_loan'));
    //     $totalDebtFund = floatval($request->input('total_debtFund'));

    //     // Get the existing customer_details array from the session
    //     $customerDetails = $request->session()->get('customer_details', []);

    //     // Get existing debt-cancellation_needs from the session
    //     $debtCancellation = $customerDetails['debt-cancellation_needs'] ?? [];

    //     // Update specific keys with new values
    //     $debtCancellation = array_merge($debtCancellation, [
    //         'outstandingLoan' => $debt_outstanding_loan,
    //         'totalDebtCancellationFund' => $totalDebtFund
    //     ]);

    //     // Set the updated debt-cancellation_needs back to the customer_details session
    //     $customerDetails['debt-cancellation_needs'] = $debtCancellation;

    //     // Store the updated customer_details array back into the session
    //     $request->session()->put('customer_details', $customerDetails);
    //     Log::debug($customerDetails);

    //     // Process the form data and perform any necessary actions
    //     return redirect()->route('debt.cancellation.settlement.years');
    // }
    // public function validateDebtCancellationSettlementYears(Request $request){

    //     $customMessages = [
    //         'debt_settlement_years.required' => 'You are required to enter a year.',
    //         'debt_settlement_years.integer' => 'The year must be a number',
    //         'debt_settlement_years.min' => 'The year must be at least :min.',
    //         'debt_settlement_years.max' => 'The year must not more than :max.',
    //     ];

    //     $validatedData = Validator::make($request->all(), [
    //         'debt_settlement_years' => 'required|integer|min:1|max:99',
    //     ], $customMessages);
        
    //     if ($validatedData->fails()) {
    //         return redirect()->back()->withErrors($validatedData)->withInput();
    //     }

    //     // Get the existing customer_details array from the session
    //     $customerDetails = $request->session()->get('customer_details', []);

    //     // Get existing debt-cancellation_needs from the session
    //     $debtCancellation = $customerDetails['debt-cancellation_needs'] ?? [];

    //     // Validation passed, perform any necessary processing.
    //     $debt_settlement_years = $request->input('debt_settlement_years');

    //     // Update specific keys with new values
    //     $debtCancellation = array_merge($debtCancellation, [
    //         'remainingYearsOfSettlement' => $debt_settlement_years
    //     ]);

    //     // Set the updated debt-cancellation_needs back to the customer_details session
    //     $customerDetails['debt-cancellation_needs'] = $debtCancellation;

    //     // Store the updated customer_details array back into the session
    //     $request->session()->put('customer_details', $customerDetails);
    //     Log::debug($customerDetails);

    //     // Process the form data and perform any necessary actions
    //     return redirect()->route('debt.cancellation.existing.debt');
    // }

    public function validateDebtCancellationExistingDebt(Request $request){

        $customMessages = [
            'existing_debt.required' => 'Please select an option',
            'existing_debt_amount.required_if' => 'You are required to enter an amount.',
            'existing_debt_amount.regex' => 'The amount must be a number',
        ];

        $validatedData = Validator::make($request->all(), [
            'existing_debt' => 'required|in:yes,no',
            'existing_debt_amount' => [
                'nullable',
                'regex:/^[0-9,]+$/',
                'required_if:existing_debt,yes',
                function ($attribute, $value, $fail) use ($request) {
                    // Remove commas and check if the value is at least 1
                    $numericValue = str_replace(',', '', $value);
                    $min = 1;
                    $max = 20000000;
                    if (intval($numericValue) < $min && $request->input('existing_debt') === 'yes') {
                        $fail('Your amount must be at least ' .$min. '.');
                    }
                    if (intval($numericValue) > $max && $request->input('existing_debt') === 'yes') {
                        $fail('Your amount must not more than RM' .number_format(floatval($max)). '.');
                    }
                },
            ],
        ], $customMessages);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing debt-cancellation_needs from the session
        $debtCancellation = $customerDetails['debt-cancellation_needs'] ?? [];

        // Validation passed, perform any necessary processing.
        $existing_debt_amount = str_replace(',','',$request->input('existing_debt_amount'));
        $existing_debt = $request->input('existing_debt');
        $totalAmountNeeded = floatval($request->input('total_amountNeeded'));
        $totalPercentage = floatval($request->input('percentage'));
        if ($existing_debt_amount === '' || $existing_debt_amount === null){
            $newTotalAmountNeeded = floatval($customerDetails['debt-cancellation_needs']['totalDebtCancellationFund'] - 0);
            $newPercentage = floatval(0 / $customerDetails['debt-cancellation_needs']['totalDebtCancellationFund'] * 100);
        } else {
            $newTotalAmountNeeded = floatval($customerDetails['debt-cancellation_needs']['totalDebtCancellationFund'] - $existing_debt_amount);
            $newPercentage = floatval($existing_debt_amount / $customerDetails['debt-cancellation_needs']['totalDebtCancellationFund'] * 100);
        }

        // Update specific keys with new values
        $debtCancellation = array_merge($debtCancellation, [
            'existingDebt' => $existing_debt,
            'existingDebtAmount' => $existing_debt_amount
        ]);

        if ($newTotalAmountNeeded === $totalAmountNeeded && $newPercentage === $totalPercentage){
            if ($newTotalAmountNeeded <= 0){
                $debtCancellation = array_merge($debtCancellation, [
                    'totalAmountNeeded' => '0',
                    'fundPercentage' => '100'
                ]);
            }
            else{
                $debtCancellation = array_merge($debtCancellation, [
                    'totalAmountNeeded' => $totalAmountNeeded,
                    'fundPercentage' => $totalPercentage
                ]);
            }
        }
        else{
            if ($newTotalAmountNeeded <= 0){
                $debtCancellation = array_merge($debtCancellation, [
                    'totalAmountNeeded' => '0',
                    'fundPercentage' => '100'
                ]);
            }
            else{
                $debtCancellation = array_merge($debtCancellation, [
                    'totalAmountNeeded' => $newTotalAmountNeeded,
                    'fundPercentage' => $newPercentage
                ]);
            }
        }

        // Set the updated debt-cancellation_needs back to the customer_details session
        $customerDetails['debt-cancellation_needs'] = $debtCancellation;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        // // Process the form data and perform any necessary actions
        return redirect()->route('debt.cancellation.critical.illness');
    }

    public function validateDebtCancellationCriticalIllness(Request $request){

        $customMessages = [
            'critical_coverage.required' => 'Please select an option',
            'critical_coverage_amount.required_if' => 'You are required to enter an amount.',
            'critical_coverage_amount.regex' => 'The amount must be a number',
        ];

        $validatedData = Validator::make($request->all(), [
            'critical_coverage' => 'required|in:yes,no',
            'critical_coverage_amount' => [
                'nullable',
                'regex:/^[0-9,]+$/',
                'required_if:critical_coverage,yes',
                function ($attribute, $value, $fail) use ($request) {
                    // Remove commas and check if the value is at least 1
                    $numericValue = str_replace(',', '', $value);
                    $min = 1;
                    $max = 20000000;
                    if (intval($numericValue) < $min && $request->input('critical_coverage') === 'yes') {
                        $fail('Your amount must be at least ' .$min. '.');
                    }
                    if (intval($numericValue) > $max && $request->input('critical_coverage') === 'yes') {
                        $fail('Your amount must not more than RM' .number_format(floatval($max)). '.');
                    }
                },
            ],
        ], $customMessages);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing debt-cancellation_needs from the session
        $debtCancellation = $customerDetails['debt-cancellation_needs'] ?? [];

        // Validation passed, perform any necessary processing.
        $critical_coverage_amount = str_replace(',','',$request->input('critical_coverage_amount'));
        $critical_coverage = $request->input('critical_coverage');

        // Update specific keys with new values
        $debtCancellation = array_merge($debtCancellation, [
            'criticalIllnessCoverage' => $critical_coverage,
            'criticalIllnessCoverageAmount' => $critical_coverage_amount
        ]);

        // Set the updated debt-cancellation_needs back to the customer_details session
        $customerDetails['debt-cancellation_needs'] = $debtCancellation;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        // // Process the form data and perform any necessary actions
        return redirect()->route('debt.cancellation.gap');
    }

    public function submitDebtCancellationGap(Request $request){

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing debt-cancellation_needs from the session
        $debtCancellation = $customerDetails['debt-cancellation_needs'] ?? [];

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        // // Process the form data and perform any necessary actions
         $formattedArray = "<pre>" . print_r($customerDetails, true) . "</pre>";
        return ($formattedArray);
        // return redirect()->route('existing.policy');
    }

}