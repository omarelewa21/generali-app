<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\SessionStorage; 
use App\Services\TransactionService;

class SavingsController extends Controller
{

    public function validateSavingsCoverageSelection(Request $request, TransactionService $transactionService)
    {

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

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);
        $selectedNeeds = $customerDetails['selected_needs'] ?? [];

        // Get existing savings_needs from the session
        $needs = $customerDetails['selected_needs']['need_4'] ?? [];
        $advanceDetails = $customerDetails['selected_needs']['need_4']['advance_details'] ?? [];
        $lastPageUrl = $customerDetails['lastPageUrl'] ?? [];

        // Update specific keys with new values
        $advanceDetails = array_merge($advanceDetails, [
            'relationship' => $relationshipInput,
            'child_name' => $selectedInsuredNameInput,
            'child_dob' => $selectedCoverForDobInput,
            'spouse_name' => $othersCoverForNameInput,
            'spouse_dob' => $othersCoverForDobInput
        ]);

        $lastPage = str_replace(url('/'), '', url()->previous());

        $lastPageUrl = array_merge($lastPageUrl, [
            'last_page_url' => $lastPage
        ]);

        // Set the updated savings_needs back to the customer_details session
        $customerDetails['selected_needs']['need_4']['advance_details'] = $advanceDetails;
        $customerDetails['lastPageUrl'] = $lastPageUrl;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        $transactionService->handleTransaction($request,$customerDetails);

        $transactionData = ['transaction_id' => $request->input('transaction_id')];

        // return redirect()->route('savings.goals');
        return redirect()->route('savings.goals',$transactionData);
    }

    public function goals(Request $request, TransactionService $transactionService)
    {
        // Validate CSRF token
        if ($request->ajax() || $request->wantsJson()) {
            // For AJAX requests, check the CSRF token without throwing an exception
            $validToken = csrf_token() === $request->header('X-CSRF-TOKEN');
        } else {
            // For non-AJAX requests, use the normal CSRF token verification
            $validToken = $request->session()->token() === $request->input('_token');
        }
        
        if ($validToken) {
            Validator::extend('at_least_one_selected', function ($attribute, $value, $fail, $validator) {

                $decodedValue = json_decode($value, true);

                if (is_array($decodedValue) && count(array_filter($decodedValue, function ($element) {
                    return $element !== NULL;
                })) > 0) {
                    // At least one non-NULL element exists, validation passes
                    return true;
                }

                // If any of the conditions are not met, add a different error message
                $customMessage = "Please select at least one.";
                $validator->errors()->add($attribute, $customMessage);

                return false;
            });  

            $customMessages = [
                'savings_goals_amount.required' => 'You are required to enter an amount.',
                'savings_goals_amount.regex' => 'You must enter number',
            ];
            
            $validator = Validator::make($request->all(), [
                'savingsGoalsButtonInput' => [
                    'at_least_one_selected',
                ],
                'savings_goals_amount' => [
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

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $savings_goals_amount = str_replace(',','',$request->input('savings_goals_amount'));
            $savingsGoalsSerialized = $request->input('savingsGoalsButtonInput');
            $savingsGoalsButtonInput = json_decode($savingsGoalsSerialized, true);

            // Get the existing customer_details array from the session
            $customerDetails = $request->session()->get('customer_details', []);

            // Get existing savings_needs from the session
            $advanceDetails = $customerDetails['selected_needs']['need_4']['advance_details'] ?? [];
            $lastPageUrl = $customerDetails['lastPageUrl'] ?? [];

            $advanceDetails = array_merge($advanceDetails, [
                'goal_target' => $savingsGoalsButtonInput,
                'goal_amount' => $savings_goals_amount
            ]);

            $lastPage = str_replace(url('/'), '', url()->previous());

            $lastPageUrl = array_merge($lastPageUrl, [
                'last_page_url' => $lastPage
            ]);

            // Set the updated savings_needs back to the customer_details session
            $customerDetails['selected_needs']['need_4']['advance_details'] = $advanceDetails;
            $customerDetails['lastPageUrl'] = $lastPageUrl;

            // Store the updated customer_details array back into the session
            $request->session()->put('customer_details', $customerDetails);
            $transactionService->handleTransaction($request,$customerDetails);

            $transactionData = ['transaction_id' => $request->input('transaction_id')];

            // Process the form data and perform any necessary actions
            return redirect()->route('savings.amount.needed',$transactionData);
        } else {
            return response()->json(['error' => 'Invalid CSRF token'], 403);
        }
    }
    public function validateSavingsAmountNeeded(Request $request, TransactionService $transactionService){

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing savings_needs from the session
        $advanceDetails = $customerDetails['selected_needs']['need_4']['advance_details'] ?? [];
        $lastPageUrl = $customerDetails['lastPageUrl'] ?? [];

        $customMessages = [
            'savings_monthly_payment.required' => 'You are required to enter an amount.',
            'savings_monthly_payment.regex' => 'You must enter number.',
            'savings_goal_duration.required' => 'You are required to enter a year.',
            'savings_goal_duration.integer' => 'The year must be a number.',
            'savings_goal_duration.min' => 'The year must be at least :min.',
            'savings_goal_duration.max' => 'The year must not more than :max.',
        ];

        $validatedData = Validator::make($request->all(), [
            'savings_goal_duration' => 'required|integer|min:1|max:99',
            'savings_monthly_payment' => [
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
        $savings_monthly_payment = str_replace(',','',$request->input('savings_monthly_payment'));
        $savings_goal_duration = $request->input('savings_goal_duration');
        $savingsTotalFund = floatval($savings_monthly_payment * 12 * $savings_goal_duration);
        $totalSavingsNeeded = floatval($request->input('total_savingsNeeded'));
        $savingsTotalAmountNeeded = floatval($customerDetails['selected_needs']['need_4']['advance_details']['goal_amount'] - $savingsTotalFund);
        $totalAmountNeeded = floatval($request->input('total_amountNeeded'));
        $totalPercentage = floatval($request->input('percentage'));
        $savingsTotalPercentage = floatval($savingsTotalFund / $customerDetails['selected_needs']['need_4']['advance_details']['goal_amount'] * 100);

        $lastPage = str_replace(url('/'), '', url()->previous());

        // Update specific keys with new values
        $advanceDetails = array_merge($advanceDetails, [
            'covered_amount' => $savings_monthly_payment,
            'supporting_years' => $savings_goal_duration
        ]);

        $lastPageUrl = array_merge($lastPageUrl, [
            'last_page_url' => $lastPage
        ]);

        if ($totalSavingsNeeded === $savingsTotalFund && $savingsTotalAmountNeeded === $totalAmountNeeded && $totalPercentage === $savingsTotalPercentage){
            if ($savingsTotalAmountNeeded <= 0){
                $advanceDetails = array_merge($advanceDetails, [
                    'insurance_amount' => '0',
                    'fund_percentage' => '100'
                ]);
            }
            else{
                $advanceDetails = array_merge($advanceDetails, [
                    'insurance_amount' => $totalAmountNeeded,
                    'fund_percentage' => $totalPercentage
                ]);
            }
            $advanceDetails = array_merge($advanceDetails, [
                'goals_amount' => $totalSavingsNeeded
            ]);
        }
        else{
            $advanceDetails = array_merge($advanceDetails, [
                'goals_amount' => $savingsTotalFund
            ]);
            if ($savingsTotalAmountNeeded <= 0){
                $advanceDetails = array_merge($advanceDetails, [
                    'insurance_amount' => '0',
                    'fund_percentage' => '100'
                ]);
            }
            else{
                $advanceDetails = array_merge($advanceDetails, [
                    'insurance_amount' => $savingsTotalAmountNeeded,
                    'fund_percentage' => $savingsTotalPercentage
                ]);
            }
        }

        // Set the updated savings_needs back to the customer_details session
        $customerDetails['selected_needs']['need_4']['advance_details'] = $advanceDetails;
        $customerDetails['lastPageUrl'] = $lastPageUrl;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        $transactionService->handleTransaction($request,$customerDetails);

        $transactionData = ['transaction_id' => $request->input('transaction_id')];
        // Process the form data and perform any necessary actions
        return redirect()->route('savings.annual.return',$transactionData);
    }

    public function validateSavingsAnnualReturn(Request $request, TransactionService $transactionService){

        $customMessages = [
            'savings_goal_pa.required' => 'You are required to enter annual return percentage.',
            'savings_goal_pa.numeric' => 'The input must be a number.',
            'savings_goal_pa.min' => 'The input must be at least :min.',
            'savings_goal_pa.max' => 'The input must not more than :max.',
        ];

        $validatedData = Validator::make($request->all(), [
            'savings_goal_pa' => 'required|numeric|min:1|max:999',
        ], $customMessages);
        
        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing savings_needs from the session
        $advanceDetails = $customerDetails['selected_needs']['need_4']['advance_details'] ?? [];
        $lastPageUrl = $customerDetails['lastPageUrl'] ?? [];

        // Validation passed, perform any necessary processing.
        $savings_goal_pa = $request->input('savings_goal_pa');

        // Update specific keys with new values
        $advanceDetails = array_merge($advanceDetails, [
            'annual_returns' => $savings_goal_pa
        ]);

        $lastPage = str_replace(url('/'), '', url()->previous());

        $lastPageUrl = array_merge($lastPageUrl, [
            'last_page_url' => $lastPage
        ]);

        // Set the updated savings_needs back to the customer_details session
        $customerDetails['selected_needs']['need_4']['advance_details'] = $advanceDetails;
        $customerDetails['lastPageUrl'] = $lastPageUrl;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        $transactionService->handleTransaction($request,$customerDetails);

        $transactionData = ['transaction_id' => $request->input('transaction_id')];

        return redirect()->route('risk.profile',$transactionData);
    }

    public function submitSavingsGap(Request $request, TransactionService $transactionService){

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing savings_needs from the session
        $advanceDetails = $customerDetails['selected_needs']['need_4']['advance_details'] ?? [];
        $lastPageUrl = $customerDetails['lastPageUrl'] ?? [];

        $lastPage = str_replace(url('/'), '', url()->previous());

        $lastPageUrl = array_merge($lastPageUrl, [
            'last_page_url' => $lastPage
        ]);

        // Set the updated savings_needs back to the customer_details session
        $customerDetails['selected_needs']['need_4']['advance_details'] = $advanceDetails;
        $customerDetails['lastPageUrl'] = $lastPageUrl;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        $transactionService->handleTransaction($request,$customerDetails);

        $transactionData = ['transaction_id' => $request->input('transaction_id')];

        // // Process the form data and perform any necessary actions
        if (isset($customerDetails['priorities']['investments_discuss']) && ($customerDetails['priorities']['investments_discuss'] === 'true')) {
            return redirect()->route('investment.home',$transactionData);
        } else if (isset($customerDetails['priorities']['health-medical_discuss']) && ($customerDetails['priorities']['health-medical_discuss'] === 'true')) {
            return redirect()->route('health.medical.home',$transactionData);
        } else if (isset($customerDetails['priorities']['debt-cancellation_discuss']) && ($customerDetails['priorities']['debt-cancellation_discuss'] === 'true')) {
            return redirect()->route('debt.cancellation.home',$transactionData);
        }
        else {
            if (isset($customerDetails['priorities']['protection']) && ($customerDetails['priorities']['protection'] === 'true') || 
            isset($customerDetails['priorities']['retirement']) && ($customerDetails['priorities']['retirement'] === 'true') || 
            isset($customerDetails['priorities']['education']) && ($customerDetails['priorities']['education'] === 'true') || 
            isset($customerDetails['priorities']['savings']) && ($customerDetails['priorities']['savings'] === 'true') || 
            isset($customerDetails['priorities']['investments']) && ($customerDetails['priorities']['investments'] === 'true') || 
            isset($customerDetails['priorities']['health-medical']) && ($customerDetails['priorities']['health-medical'] === 'true') || 
            isset($customerDetails['priorities']['debt-cancellation']) && ($customerDetails['priorities']['debt-cancellation'] === 'true') ){
                return redirect()->route('existing.policy',$transactionData);
            } else{
                return redirect()->route('summary.monthly-goals',$transactionData);
            }
        }
    }

}