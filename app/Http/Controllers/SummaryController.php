<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FinancialService;
use Illuminate\Support\Facades\Log;
use App\Services\TransactionService;
use App\Services\CustomerNeedService;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Calculation\Financial\FinancialValidations;

class SummaryController extends Controller
{
    public function validateRiskProfile(Request $request,TransactionService $transactionService, CustomerNeedService $customerNeedService){
    // public function validateRiskProfile(Request $request, TransactionService $transactionService){
        $customMessages = [
            'riskProfileInput.required' => 'Please select a risk level.',
            'riskProfileInput.in' => 'Invalid risk level selected.',
            'potentialReturnInput.required_if' => 'Please select a potential return for the chosen risk level.',
        ];

        $validatedData = Validator::make($request->all(), [
            'riskProfileInput' => 'required|in:High Risk,Medium Risk,Low Risk',
            'potentialReturnInput' => 'required_if:savingsRiskProfileInput,High Risk,Medium Risk,Low Risk',
            
        ], $customMessages);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $riskProfileInput = $request->input('riskProfileInput');
        $potentialReturnInput = $request->input('potentialReturnInput');
       
        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing savings_needs from the session
        $riskProfile = $customerDetails['risk_profile'] ?? [];
        $lastPageUrl = $customerDetails['lastPageUrl'] ?? [];

        // Update specific keys with new values
        $riskProfile = array_merge($riskProfile, [
            'selected_risk_profile' => $riskProfileInput,
            'selected_potential_return' => $potentialReturnInput
        ]);

        // Set the updated savings_needs back to the customer_details session
        $customerDetails['risk_profile'] = $riskProfile;

        // Store the updated customer_details array back into the session
        // $transactionService->handleTransaction($request,$customerDetails);

        $customerId = session('customer_id');

        if ($lastPageUrl['last_page_url'] == '/investment/annual-return') {

            $selectedNeed = "need_5";
        }
        else
        {
            $selectedNeed = "need_4";
        }
         
        $transactionId = $transactionService->handleTransaction($customerId);
        $customerNeeds = $customerNeedService->handleNeeds($customerDetails,$customerId,$selectedNeed);

        $customerDetails = array_merge([
            'transaction_id' => $transactionId,
            'customer_id' => $customerId
        ], $customerDetails);

        $request->session()->put('customer_details', $customerDetails);

        
        if (strstr($customerDetails['lastPageUrl']['last_page_url'], 'investment') !== false || strstr($customerDetails['lastPageUrl']['last_page_url'], '/investment/') !== false){
            return redirect()->route('investment.gap');
            // return redirect()->route('investment.gap',$transactionData);
        } else{
            return redirect()->route('savings.gap');
            // return redirect()->route('savings.gap',$transactionData);
        }
        
    }

    public function validateSummaryMonthlyGoals(Request $request, TransactionService $transactionService, FinancialService $financialService)
    {

        $customMessages = [
            'financial_statement_monthly_support.required' => 'You are required to enter an amount.',
            'financial_statement_monthly_support.regex' => 'You must enter number.',
        ];

        $validatedData = Validator::make($request->all(), [
            'financial_statement_monthly_support' => [
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
        $financial_statement_monthly_support = str_replace(',','',$request->input('financial_statement_monthly_support'));

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing financialStatement from the session
        $financialStatement = $customerDetails['financialStatement'] ?? [];

        // Update specific keys with new values
        $financialStatement = array_merge($financialStatement, [
            'amountAvailable' => $financial_statement_monthly_support
        ]);

        // Set the updated education back to the customer_details session
        $customerDetails['financialStatement'] = $financialStatement;

        $customerId = session('customer_id');
        $transactionId = $transactionService->handleTransaction($customerId);
        $financialStatement = $financialService->handleFinancialStatement($customerId,$transactionId,$customerDetails);

        $customerDetails = array_merge([
            'transaction_id' => $transactionId,
            'customer_id' => $customerId
        ], $customerDetails);

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);

        return redirect()->route('financial.statement.expected.income');
    }
    public function validateSummaryExpectedIncome(Request $request,TransactionService $transactionService, FinancialService $financialService)
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
            'selectedExpectingInput' => [
                'at_least_one_selected',
            ],
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $selectedExpectingInput = $request->input('selectedExpectingInput');

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing financialStatement from the session
        $financialStatement = $customerDetails['financialStatement'] ?? [];

        // Update specific keys with new values
        $financialStatement = array_merge($financialStatement, [
            'isChangeinAmount' => $selectedExpectingInput
        ]);

        // Set the updated financialStatement back to the customer_details session
        $customerDetails['financialStatement'] = $financialStatement;

        $customerId = session('customer_id');
        $transactionId = $transactionService->handleTransaction($customerId);
        $financialStatement = $financialService->handleFinancialStatement($customerId,$transactionId,$customerDetails);

        $customerDetails = array_merge([
            'transaction_id' => $transactionId,
            'customer_id' => $customerId
        ], $customerDetails);

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);

        if ($selectedExpectingInput === 'Yes'){
            return redirect()->route('financial.statement.increment.amount');
        }
        else{
            return redirect()->route('summary');
        }
        
    }

    public function validateSummaryIncrementAmount(Request $request,TransactionService $transactionService, FinancialService $financialService){

        $customMessages = [
            'approximate_increment_amount.required' => 'You are required to enter an amount.',
            'approximate_increment_amount.regex' => 'You must enter number.',
        ];

        $validatedData = Validator::make($request->all(), [
            'approximate_increment_amount' => [
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
        $approximate_increment_amount = str_replace(',','',$request->input('approximate_increment_amount'));

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing financialStatement from the session
        $financialStatement = $customerDetails['financialStatement'] ?? [];

        // Update specific keys with new values
        $financialStatement = array_merge($financialStatement, [
            'approximateIncrementAmount' => $approximate_increment_amount
        ]);

        // Set the updated education back to the customer_details session
        $customerDetails['financialStatement'] = $financialStatement;

        $customerId = session('customer_id');
        $transactionId = $transactionService->handleTransaction($customerId);
        $financialStatement = $financialService->handleFinancialStatement($customerId,$transactionId,$customerDetails);

        $customerDetails = array_merge([
            'transaction_id' => $transactionId,
            'customer_id' => $customerId
        ], $customerDetails);

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);

        // // Process the form data and perform any necessary actions
        return redirect()->route('summary');
    }

}