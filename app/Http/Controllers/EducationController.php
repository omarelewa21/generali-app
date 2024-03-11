<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\SessionStorage;
use App\Services\CustomerNeedService;
use App\Services\TransactionService;

class EducationController extends Controller
{

    public function validateEducationCoverageSelection(Request $request, TransactionService $transactionService, CustomerNeedService $customerNeedService)
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
        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Validation passed, perform any necessary processing.
        $relationshipInput = $request->input('relationshipInput');
        $selectedInsuredNameInput = $request->input('selectedInsuredNameInput');
        $selectedCoverForDobInput = $request->input('selectedCoverForDobInput');
        $othersCoverForNameInput = $request->input('othersCoverForNameInput');
        $othersCoverForDobInput = $request->input('othersCoverForDobInput');

        // Get existing education_needs from the session
        $needs = $customerDetails['selected_needs']['need_3'] ?? [];
        $advanceDetails = $customerDetails['selected_needs']['need_3']['advance_details'] ?? [];

        // Update specific keys with new values
        $advanceDetails = array_merge($advanceDetails, [
            'relationship' => $relationshipInput,
            'child_name' => $selectedInsuredNameInput,
            'child_dob' => $selectedCoverForDobInput,
            'spouse_name' => $othersCoverForNameInput,
            'spouse_dob' => $othersCoverForDobInput
        ]);

        // Set the updated education_needs back to the customer_details session
        $customerDetails['selected_needs']['need_3']['advance_details'] = $advanceDetails;

        $customerId = session('customer_id');
        $transactionId = $transactionService->handleTransaction($customerId);
        $customerNeeds = $customerNeedService->handleNeeds($customerDetails,$customerId);

        $customerDetails = array_merge([
            'transaction_id' => $transactionId,
            'customer_id' => $customerId
        ], $customerDetails);

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);

        return redirect()->route('education.amount.needed');
    }

    public function validateEducationAmountNeeded(Request $request, TransactionService $transactionService, CustomerNeedService $customerNeedService){

        $customMessages = [
            'tertiary_education_amount.required' => 'You are required to enter an amount.',
            'tertiary_education_amount.regex' => 'You must enter number.',
            'tertiary_education_years.required' => 'You are required to enter a year.',
            'tertiary_education_years.integer' => 'The year must be a number.',
            'tertiary_education_years.min' => 'The year must be at least :min.',
            'tertiary_education_years.max' => 'The year must not more than :max.',
        ];

        $validatedData = Validator::make($request->all(), [
            'tertiary_education_years' => 'required|integer|min:1|max:99',
            'tertiary_education_amount' => [
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
        $tertiary_education_amount = str_replace(',','',$request->input('tertiary_education_amount'));
        $tertiary_education_years = $request->input('tertiary_education_years');
        $totalEducationFund = floatval($request->input('total_educationNeeded'));

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing education_needs from the session
        $advanceDetails = $customerDetails['selected_needs']['need_3']['advance_details'] ?? [];

        // Update specific keys with new values
        $advanceDetails = array_merge($advanceDetails, [
            'covered_amount' => $tertiary_education_amount,
            'remaining_years' => $tertiary_education_years,
            'goals_amount' => $totalEducationFund
        ]);

        // Set the updated education back to the customer_details session
        $customerDetails['selected_needs']['need_3']['advance_details'] = $advanceDetails;

        $customerId = session('customer_id');

        $transactionId = $transactionService->handleTransaction($customerId);
        $customerNeeds = $customerNeedService->handleNeeds($customerDetails,$customerId);

        $customerDetails = array_merge([
            'transaction_id' => $transactionId,
            'customer_id' => $customerId
        ], $customerDetails);

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        

        // Process the form data and perform any necessary actions
        return redirect()->route('education.existing.fund');
    }

    public function validateEducationExistingFund(Request $request, TransactionService $transactionService, CustomerNeedService $customerNeedService){

        $customMessages = [
            'education_other_savings.required' => 'Please select an option.',
            'education_saving_amount.required_if' => 'You are required to enter an amount.',
            'education_saving_amount.regex' => 'The amount must be a number.',
        ];

        $validatedData = Validator::make($request->all(), [
            'education_other_savings' => 'required|in:yes,no',
            'education_saving_amount' => [
                'nullable',
                'regex:/^[0-9,]+$/',
                'required_if:education_other_savings,yes',
                function ($attribute, $value, $fail) use ($request) {
                    // Remove commas and check if the value is at least 1
                    $numericValue = str_replace(',', '', $value);
                    $min = 1;
                    $max = 20000000;
                    if (intval($numericValue) < $min && $request->input('education_other_savings') === 'yes') {
                        $fail('Your amount must be at least ' .$min. '.');
                    }
                    if (intval($numericValue) > $max && $request->input('education_other_savings') === 'yes') {
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

        // Get existing education_needs from the session
        $advanceDetails = $customerDetails['selected_needs']['need_3']['advance_details'] ?? [];

        // Validation passed, perform any necessary processing.
        $education_saving_amount = str_replace(',','',$request->input('education_saving_amount'));
        $education_other_savings = $request->input('education_other_savings');
        $totalAmountNeeded = floatval($request->input('total_amountNeeded'));
        $totalPercentage = floatval($request->input('percentage'));
        if ($education_saving_amount === '' || $education_saving_amount === null){
            $newEducationTotalAmountNeeded = floatval($customerDetails['selected_needs']['need_3']['advance_details']['covered_amount'] - 0);
            $newEducationPercentage = floatval(0 / $customerDetails['selected_needs']['need_3']['advance_details']['covered_amount'] * 100);
        } else{
            $newEducationTotalAmountNeeded = floatval($customerDetails['selected_needs']['need_3']['advance_details']['covered_amount'] - $education_saving_amount);
            $newEducationPercentage = floatval($education_saving_amount / $customerDetails['selected_needs']['need_3']['advance_details']['covered_amount'] * 100);
        }

        // Update specific keys with new values
        $advanceDetails = array_merge($advanceDetails, [
            'existing_fund' => $education_other_savings,
            'existing_amount' => $education_saving_amount
        ]);

        if ($newEducationTotalAmountNeeded === $totalAmountNeeded && $newEducationPercentage === $totalPercentage){
            if ($newEducationTotalAmountNeeded <= 0){
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
            if ($newEducationTotalAmountNeeded <= 0){
                $advanceDetails = array_merge($advanceDetails, [
                    'insurance_amount' => '0',
                    'fund_percentage' => '100'
                ]);
            }
            else{
                $advanceDetails = array_merge($advanceDetails, [
                    'insurance_amount' => $newEducationTotalAmountNeeded,
                    'fund_percentage' => $newEducationPercentage
                ]);
            }
        }

        // Set the updated education_needs back to the customer_details session
        $customerDetails['selected_needs']['need_3']['advance_details'] = $advanceDetails;

        $customerId = session('customer_id');

        $transactionId = $transactionService->handleTransaction($customerId);
        $customerNeeds = $customerNeedService->handleNeeds($customerDetails,$customerId);

        $customerDetails = array_merge([
            'transaction_id' => $transactionId,
            'customer_id' => $customerId
        ], $customerDetails);

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);


        return redirect()->route('education.gap');
    }

    public function submitEducationGap(Request $request, TransactionService $transactionService, CustomerNeedService $customerNeedService){

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing education_needs from the session
        $advanceDetails = $customerDetails['selected_needs']['need_3']['advance_details'] ?? [];

        // Set the updated education_needs back to the customer_details session
        $customerDetails['selected_needs']['need_3']['advance_details'] = $advanceDetails;

        $customerId = session('customer_id');

        $transactionId = $transactionService->handleTransaction($customerId);
        $customerNeeds = $customerNeedService->handleNeeds($customerDetails,$customerId);

        $customerDetails = array_merge([
            'transaction_id' => $transactionId,
            'customer_id' => $customerId
        ], $customerDetails);

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);


        if (isset($customerDetails['priorities']['savings_discuss']) && ($customerDetails['priorities']['savings_discuss'] === 'true' || $customerDetails['priorities']['savings_discuss'] === true)) {
            return redirect()->route('savings.home');
        } else if (isset($customerDetails['priorities']['investments_discuss']) && ($customerDetails['priorities']['investments_discuss'] === 'true' || $customerDetails['priorities']['investments_discuss'] === true)) {
            return redirect()->route('investment.home');
        } else if (isset($customerDetails['priorities']['health-medical_discuss']) && ($customerDetails['priorities']['health-medical_discuss'] === 'true' || $customerDetails['priorities']['health-medical_discuss'] === true)) {
            return redirect()->route('health.medical.home');
        } else if (isset($customerDetails['priorities']['debt-cancellation_discuss']) && ($customerDetails['priorities']['debt-cancellation_discuss'] === 'true' || $customerDetails['priorities']['debt-cancellation_discuss'] === true)) {
            return redirect()->route('debt.cancellation.home');
        }
        else {
            if (isset($customerDetails['priorities']['protection']) && ($customerDetails['priorities']['protection'] === 'true' || $customerDetails['priorities']['protection'] === true) || 
            isset($customerDetails['priorities']['retirement']) && ($customerDetails['priorities']['retirement'] === 'true' || $customerDetails['priorities']['retirement'] === true) || 
            isset($customerDetails['priorities']['education']) && ($customerDetails['priorities']['education'] === 'true' || $customerDetails['priorities']['education'] === true) || 
            isset($customerDetails['priorities']['savings']) && ($customerDetails['priorities']['savings'] === 'true' || $customerDetails['priorities']['savings'] === true) || 
            isset($customerDetails['priorities']['investments']) && ($customerDetails['priorities']['investments'] === 'true' || $customerDetails['priorities']['investments'] === true) || 
            isset($customerDetails['priorities']['health-medical']) && ($customerDetails['priorities']['health-medical'] === 'true' || $customerDetails['priorities']['health-medical'] === true) || 
            isset($customerDetails['priorities']['debt-cancellation']) && ($customerDetails['priorities']['debt-cancellation'] === 'true' || $customerDetails['priorities']['debt-cancellation'] === true) ){
                return redirect()->route('existing.policy');
            } else{
                return redirect()->route('summary.monthly-goals');
            }
            
        }
    }

}