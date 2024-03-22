<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\SessionStorage;
use App\Services\CustomerNeedService;
use App\Services\CustomerService;
use App\Services\TransactionService;

class DebtCancellationController extends Controller
{
    public function validateDebtCancellationCoverage(Request $request,TransactionService $transactionService, CustomerNeedService $customerNeedService)
    {
        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

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

        $needs = $customerDetails['selected_needs']['need_7'] ?? [];
        $advanceDetails = $customerDetails['selected_needs']['need_7']['advance_details'] ?? [];

        // Update specific keys with new values
        $advanceDetails = array_merge($advanceDetails, [
            'relationship' => $relationshipInput,
            'child_name' => $selectedInsuredNameInput,
            'child_dob' => $selectedCoverForDobInput,
            'spouse_name' => $othersCoverForNameInput,
            'spouse_dob' => $othersCoverForDobInput
        ]);

        // Set the updated debt_cancellation_needs back to the customer_details session
        $customerDetails['selected_needs']['need_7']['advance_details'] = $advanceDetails;

        $customerId = session('customer_id') ?? session('customer_details.customer_id');
        $selectedNeed = "need_7"; 
        $transactionId = $transactionService->handleTransaction($customerId);
        $customerNeeds = $customerNeedService->handleNeeds($customerDetails,$customerId,$selectedNeed);

        $customerDetails = array_merge([
            'transaction_id' => $transactionId,
            'customer_id' => $customerId
        ], $customerDetails);

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        
        return redirect()->route('debt.cancellation.amount.needed');
    }

    public function validateDebtCancellationAmountNeeded(Request $request, TransactionService $transactionService, CustomerNeedService $customerNeedService){

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
        $advanceDetails = $customerDetails['selected_needs']['need_7']['advance_details'] ?? [];

        // Update specific keys with new values
        $advanceDetails = array_merge($advanceDetails, [
            'covered_amount' => $debt_outstanding_loan,
            'remaining_years' => $debt_settlement_years,
            'goals_amount' => $totalDebtFund
        ]);

        // Set the updated debt-cancellation_needs back to the customer_details session
        $customerDetails['selected_needs']['need_7']['advance_details'] = $advanceDetails;

        $customerId = session('customer_id') ?? session('customer_details.customer_id');
        $selectedNeed = "need_7"; 
        $transactionId = $transactionService->handleTransaction($customerId);
        $customerNeeds = $customerNeedService->handleNeeds($customerDetails,$customerId,$selectedNeed);

        $customerDetails = array_merge([
            'transaction_id' => $transactionId,
            'customer_id' => $customerId
        ], $customerDetails);

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);

        return redirect()->route('debt.cancellation.existing.debt');
    }

    public function validateDebtCancellationExistingDebt(Request $request, TransactionService $transactionService, CustomerNeedService $customerNeedService){

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
        $advanceDetails = $customerDetails['selected_needs']['need_7']['advance_details'] ?? [];

        // Validation passed, perform any necessary processing.
        $existing_debt_amount = str_replace(',','',$request->input('existing_debt_amount'));
        $existing_debt = $request->input('existing_debt');
        $totalAmountNeeded = floatval($request->input('total_amountNeeded'));
        $totalPercentage = floatval($request->input('percentage'));
        if ($existing_debt_amount === '' || $existing_debt_amount === null){
            $newTotalAmountNeeded = floatval($customerDetails['selected_needs']['need_7']['advance_details']['goals_amount'] - 0);
            $newPercentage = floatval(0 / $customerDetails['selected_needs']['need_7']['advance_details']['goals_amount'] * 100);
        } else {
            $newTotalAmountNeeded = floatval($customerDetails['selected_needs']['need_7']['advance_details']['goals_amount'] - $existing_debt_amount);
            $newPercentage = floatval($existing_debt_amount / $customerDetails['selected_needs']['need_7']['advance_details']['goals_amount'] * 100);
        }

        // Update specific keys with new values
        $advanceDetails = array_merge($advanceDetails, [
            'existing_debt' => $existing_debt,
            'existing_amount' => $existing_debt_amount
        ]);

        if ($newTotalAmountNeeded === $totalAmountNeeded && $newPercentage === $totalPercentage){
            if ($newTotalAmountNeeded <= 0){
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
        }
        else{
            if ($newTotalAmountNeeded <= 0){
                $advanceDetails = array_merge($advanceDetails, [
                    'insurance_amount' => '0',
                    'fund_percentage' => '100'
                ]);
            }
            else{
                $advanceDetails = array_merge($advanceDetails, [
                    'insurance_amount' => $newTotalAmountNeeded,
                    'fund_percentage' => $newPercentage
                ]);
            }
        }

        // Set the updated debt-cancellation_needs back to the customer_details session
        $customerDetails['selected_needs']['need_7']['advance_details'] = $advanceDetails;

        $customerId = session('customer_id') ?? session('customer_details.customer_id');
        $selectedNeed = "need_7"; 
        $transactionId = $transactionService->handleTransaction($customerId);
        $customerNeeds = $customerNeedService->handleNeeds($customerDetails,$customerId,$selectedNeed);

        $customerDetails = array_merge([
            'transaction_id' => $transactionId,
            'customer_id' => $customerId
        ], $customerDetails);

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);

        // Process the form data and perform any necessary actions
        return redirect()->route('debt.cancellation.critical.illness');
    }

    public function validateDebtCancellationCriticalIllness(Request $request, TransactionService $transactionService, CustomerNeedService $customerNeedService){

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
        $advanceDetails = $customerDetails['selected_needs']['need_7']['advance_details'] ?? [];

        // Validation passed, perform any necessary processing.
        $critical_coverage_amount = str_replace(',','',$request->input('critical_coverage_amount'));
        $critical_coverage = $request->input('critical_coverage');

        // Update specific keys with new values
        $advanceDetails = array_merge($advanceDetails, [
            'critical_illness' => $critical_coverage,
            'critical_illness_amount' => $critical_coverage_amount
        ]);

        // Set the updated debt-cancellation_needs back to the customer_details session
        $customerDetails['selected_needs']['need_7']['advance_details'] = $advanceDetails;

        $customerId = session('customer_id') ?? session('customer_details.customer_id');
        $selectedNeed = "need_7"; 
        $transactionId = $transactionService->handleTransaction($customerId);
        $customerNeeds = $customerNeedService->handleNeeds($customerDetails,$customerId,$selectedNeed);

        $customerDetails = array_merge([
            'transaction_id' => $transactionId,
            'customer_id' => $customerId
        ], $customerDetails);

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);

        // Process the form data and perform any necessary actions
        return redirect()->route('debt.cancellation.gap');
    }

    public function submitDebtCancellationGap(Request $request, TransactionService $transactionService, CustomerNeedService $customerNeedService){

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing debt-cancellation_needs from the session
        $advanceDetails = $customerDetails['selected_needs']['need_7']['advance_details'] ?? [];

        $customerDetails['selected_needs']['need_7']['advance_details'] = $advanceDetails;

        $customerId = session('customer_id') ?? session('customer_details.customer_id');
        $selectedNeed = "need_7"; 
        $transactionId = $transactionService->handleTransaction($customerId);
        $customerNeeds = $customerNeedService->handleNeeds($customerDetails,$customerId,$selectedNeed);

        $customerDetails = array_merge([
            'transaction_id' => $transactionId,
            'customer_id' => $customerId
        ], $customerDetails);

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        

        // $formattedArray = "<pre>" . print_r($customerDetails, true) . "</pre>";
        // return ($formattedArray);
        if (isset($customerDetails['priorities']['protection']) && ($customerDetails['priorities']['protection'] === 'true' || $customerDetails['priorities']['protection'] === true) || 
        isset($customerDetails['priorities']['retirement']) && ($customerDetails['priorities']['retirement'] === 'true' || $customerDetails['priorities']['retirement'] === true) || 
        isset($customerDetails['priorities']['education']) && ($customerDetails['priorities']['education'] === 'true' || $customerDetails['priorities']['education'] === true) || 
        isset($customerDetails['priorities']['savings']) && ($customerDetails['priorities']['savings'] === 'true' || $customerDetails['priorities']['savings'] === true) || 
        isset($customerDetails['priorities']['investments']) && ($customerDetails['priorities']['investments'] === 'true' || $customerDetails['priorities']['investments'] === true) || 
        isset($customerDetails['priorities']['health-medical']) && ($customerDetails['priorities']['health-medical'] === 'true' || $customerDetails['priorities']['health-medical'] === true) || 
        isset($customerDetails['priorities']['debt-cancellation']) && ($customerDetails['priorities']['debt-cancellation'] === 'true' || $customerDetails['priorities']['debt-cancellation'] === true) ){
            return redirect()->route('existing.policy');
        } else{
            return redirect()->route('financial.statement.monthly.goals');
        }
    }

}