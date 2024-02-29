<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CustomerService;
use App\Services\TransactionService;
use App\Services\CustomerNeedService;
use Illuminate\Support\Facades\Validator;

class ProtectionController extends Controller
{
    public function validateProtectionCoverageSelection(Request $request,TransactionService $transactionService, CustomerNeedService $customerNeedService, CustomerService $customerService)
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

        // Get existing protection_needs from the session
        $selectedNeeds = $customerDetails['selected_needs'] ?? [];
        $needs = $customerDetails['selected_needs']['need_1'] ?? [];
        $advanceDetails = $customerDetails['selected_needs']['need_1']['advance_details'] ?? [];

        // Update specific keys with new values
        $advanceDetails = array_merge($advanceDetails, [
            'relationship' => $relationshipInput,
            'child_name' => $selectedInsuredNameInput,
            'child_dob' => $selectedCoverForDobInput,
            'spouse_name' => $othersCoverForNameInput,
            'spouse_dob' => $othersCoverForDobInput
        ]);

        // Set the updated protection_needs back to the customer_details session
        $customerDetails['selected_needs']['need_1']['advance_details'] = $advanceDetails;

        // Determine the latest array key
        $latestKey = "selected_needs";

        $customerId = session('customer_id');

        // $customerId = $customerService->handleCustomer($request,$customerDetails,$latestKey);
        $transactionId = $transactionService->handleTransaction($customerId);
        $customerNeeds = $customerNeedService->handleNeeds($customerDetails,$customerId);

        $customerDetails = array_merge([
            'transaction_id' => $transactionId,
            'customer_id' => $customerId
        ], $customerDetails);

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        
        // $formattedArray = "<pre>" . print_r($customerDetails, true) . "</pre>";
        // return ($formattedArray);
        return redirect()->route('protection.amount.needed');
    }

    public function validateProtectionAmountNeeded(Request $request, TransactionService $transactionService)
    {
        $customMessages = [
            'protection_monthly_support.required' => 'You are required to enter an amount.',
            'protection_monthly_support.regex' => 'You must enter number.',
            'protection_supporting_years.required' => 'You are required to enter a year.',
            'protection_supporting_years.integer' => 'The year must be a number.',
            'protection_supporting_years.min' => 'The year must be at least :min.',
            'protection_supporting_years.max' => 'The year must not more than :max.',
        ];

        $validatedData = Validator::make($request->all(), [
            'protection_supporting_years' => 'required|integer|min:1|max:100',
            'protection_monthly_support' => [
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
                    if (intval($numericValue * 12) > $max) {
                        $fail('Your amount must not more than RM' .number_format(floatval($max)). ' per annual.');
                    }
                },
            ],
        ], $customMessages);
        
        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $protection_monthly_support = str_replace(',','',$request->input('protection_monthly_support'));
        $protection_supporting_years = $request->input('protection_supporting_years');
        $protectionTotalFund = floatval($protection_monthly_support * 12 * $protection_supporting_years);
        $totalProtectionFund = floatval($request->input('total_protectionFund'));

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing protection_needs from the session
        $needs = $customerDetails['selected_needs']['need_1'] ?? [];
        $advanceDetails = $customerDetails['selected_needs']['need_1']['advance_details'] ?? [];

        // Update specific keys with new values
        $advanceDetails = array_merge($advanceDetails, [
            'covered_amount_monthly' => $protection_monthly_support,
            'covered_amount' => $protection_monthly_support*12,
            'supporting_years' => $protection_supporting_years
        ]);

        if ($totalProtectionFund === $protectionTotalFund){

            $advanceDetails = array_merge($advanceDetails, [
                'goals_amount' => $totalProtectionFund
            ]);
        }
        else{
            $advanceDetails = array_merge($advanceDetails, [
                'goals_amount' => $protectionTotalFund
            ]);
        }

        // Set the updated protection back to the customer_details session
        $customerDetails['selected_needs']['need_1']['advance_details'] = $advanceDetails;

        $latestKey = "protection_amount_needed";
        $customerId = session('customer_id');

        $transactionService->handleTransaction($customerId);

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
       

        return redirect()->route('protection.existing.policy');
    }
    
    public function validateProtectionExistingPolicy(Request $request, TransactionService $transactionService){

        $customMessages = [
            'protection_existing_policy.required' => 'Please select an option.',
            'existing_policy_amount.required_if' => 'You are required to enter an amount.',
            'existing_policy_amount.regex' => 'The amount must be a number.',
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

        // Get existing protection_needs from the session
        $advanceDetails = $customerDetails['selected_needs']['need_1']['advance_details'] ?? [];

        // Validation passed, perform any necessary processing.
        $existing_policy_amount = str_replace(',','',$request->input('existing_policy_amount'));
        $protection_existing_policy = $request->input('protection_existing_policy');
        $totalAmountNeeded = floatval($request->input('total_amountNeeded'));
        $totalPercentage = floatval($request->input('percentage'));
        $totalExisting = floatval($customerDetails['selected_needs']['need_1']['advance_details']['covered_amount'])*floatval($customerDetails['selected_needs']['need_1']['advance_details']['supporting_years']);
        if ($existing_policy_amount === '' || $existing_policy_amount === null){
            $newProtectionTotalAmountNeeded =  $totalExisting - 0;
            $newProtectionPercentage = floatval(0 / $totalExisting * 100);
        } else {
            $newProtectionTotalAmountNeeded = floatval($totalExisting - $existing_policy_amount);
            $newProtectionPercentage = floatval($existing_policy_amount / $totalExisting * 100);
        }

        // Update specific keys with new values
        $advanceDetails = array_merge($advanceDetails, [
            'existing_amount' => $existing_policy_amount,
            'existing_policy' => $protection_existing_policy
        ]);

        if ($newProtectionTotalAmountNeeded === $totalAmountNeeded && $newProtectionPercentage === $totalPercentage){
            if ($newProtectionTotalAmountNeeded <= 0){
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
            if ($newProtectionTotalAmountNeeded <= 0){
                $advanceDetails = array_merge($advanceDetails, [
                    'insurance_amount' => '0',
                    'fund_percentage' => '100'
                ]);
            }
            else{
                $advanceDetails = array_merge($advanceDetails, [
                    'insurance_amount' => $newProtectionTotalAmountNeeded,
                    'fund_percentage' => $newProtectionPercentage
                ]);
            }
        }

        // Set the updated protection back to the customer_details session
        $customerDetails['selected_needs']['need_1']['advance_details'] = $advanceDetails;

        $latestKey = "protection_existing_policy";
        $customerId = session('customer_id');

        $transactionService->handleTransaction($customerId);
        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        

    
        // $formattedArray = "<pre>" . print_r($customerDetails, true) . "</pre>";
        // return ($formattedArray);
        return redirect()->route('protection.gap');
    }

    public function submitProtectionGap(Request $request, TransactionService $transactionService, CustomerNeedService $customerNeedService){

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing protection_needs from the session
        $advanceDetails = $customerDetails['selected_needs']['need_1']['advance_details'] ?? [];

        // Set the updated protection back to the customer_details session
        $customerDetails['selected_needs']['need_1']['advance_details'] = $advanceDetails;

        // Store the updated customer_details array back into the session

        $latestKey = "protection_gap";
        $customerId = session('customer_id');
        $transactionService->handleTransaction($customerId);
        $customerNeeds = $customerNeedService->handleNeeds($customerDetails,$customerId);

        $request->session()->put('customer_details', $customerDetails);

        if (isset($customerDetails['priorities']['retirement_discuss']) && ($customerDetails['priorities']['retirement_discuss'] === 'true' || $customerDetails['priorities']['retirement_discuss'] === true)) {
            return redirect()->route('retirement.home');
        } else if (isset($customerDetails['priorities']['education_discuss']) && ($customerDetails['priorities']['education_discuss'] === 'true' || $customerDetails['priorities']['education_discuss'] === true)) {
            return redirect()->route('education.home');
        } else if (isset($customerDetails['priorities']['savings_discuss']) && ($customerDetails['priorities']['savings_discuss'] === 'true' || $customerDetails['priorities']['savings_discuss'] === true)) {
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