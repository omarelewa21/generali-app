<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\SessionStorage;
use App\Services\TransactionService; 

class InvestmentController extends Controller
{
    // protected $need_sequence;

    // public function calculateNeedSequence(Request $request) {

    //     $customerDetails = $request->session()->get('customer_details', []);

        // Set the default value for $need_sequence
    //     $need_sequence = 0;

    //     $protectionDiscuss = isset($customerDetails['priorities']['protectionDiscuss']) && ($customerDetails['priorities']['protectionDiscuss'] == true || $customerDetails['priorities']['protectionDiscuss'] == 'true');
    //     $retirementDiscuss = isset($customerDetails['priorities']['retirementDiscuss']) && ($customerDetails['priorities']['retirementDiscuss'] == true || $customerDetails['priorities']['retirementDiscuss'] == 'true');
    //     $educationDiscuss = isset($customerDetails['priorities']['educationDiscuss']) && ($customerDetails['priorities']['educationDiscuss'] == true || $customerDetails['priorities']['educationDiscuss'] == 'true');
    //     $savingsDiscuss = isset($customerDetails['priorities']['savingsDiscuss']) && ($customerDetails['priorities']['savingsDiscuss'] == true || $customerDetails['priorities']['savingsDiscuss'] == 'true');

    //     $need_sequence = (
    //         $protectionDiscuss ? (
    //             $retirementDiscuss ? (
    //                 $educationDiscuss ? (
    //                     $savingsDiscuss ? 5 : 4
    //                 ) : (
    //                     $savingsDiscuss ? 4 : 3
    //                 )
    //             ) : (
    //                 $educationDiscuss ? (
    //                     $savingsDiscuss ? 4 : 3
    //                 ) : (
    //                     $savingsDiscuss ? 3 : 2
    //                 )
    //             )
    //         ) : (
    //             $retirementDiscuss ? (
    //                 $educationDiscuss ? (
    //                     $savingsDiscuss ? 4 : 3
    //                 ) : (
    //                     $savingsDiscuss ? 3 : 2
    //                 )
    //             ) : (
    //                 $educationDiscuss ? (
    //                     $savingsDiscuss ? 3 : 2
    //                 ) : (
    //                     $savingsDiscuss ? 2 : 1
    //                 )
    //             )
    //         )
    //     );    

    //     return $need_sequence;
    // }

    public function validateInvestmentCoverageSelection(Request $request, TransactionService $transactionService)
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

        // Get existing investments_needs from the session
        $needs = $customerDetails['selected_needs']['need_5'] ?? [];
        $advanceDetails = $customerDetails['selected_needs']['need_5']['advance_details'] ?? [];

        $index = array_search('investments', $customerDetails['priorities_level'], true);
        if ($customerDetails['priorities']['investments'] == true || $customerDetails['priorities']['investments'] == 'true'){
            $coverAnswer = 'Yes';
        } else{
            $coverAnswer = 'No';
        }
        if ($customerDetails['priorities']['investments_discuss'] == true || $customerDetails['priorities']['investments_discuss'] == 'true'){
            $discussAnswer = 'Yes';
        } else{
            $discussAnswer = 'No';
        }

        // Update specific keys with new values
        $needs = array_merge($needs, [
            'need_no' => 'N5',
            'priority' => $index+1,
            'cover' => $coverAnswer,
            'discuss' => $discussAnswer
        ]);
        $advanceDetails = array_merge($advanceDetails, [
            'relationship' => $relationshipInput,
            'child_name' => $selectedInsuredNameInput,
            'child_dob' => $selectedCoverForDobInput,
            'spouse_name' => $othersCoverForNameInput,
            'spouse_dob' => $othersCoverForDobInput
        ]);

        // Set the updated investments_needs back to the customer_details session
        $customerDetails['selected_needs']['need_5'] = $needs;
        $customerDetails['selected_needs']['need_5']['advance_details'] = $advanceDetails;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        $transactionService->handleTransaction($request,$customerDetails);

        $transactionData = ['transaction_id' => $request->input('transaction_id')];

        return redirect()->route('investment.amount.needed',$transactionData);
    }

    public function validateInvestmentAmountNeeded(Request $request,TransactionService $transactionService){

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing investments_needs from the session
        $advanceDetails = $customerDetails['selected_needs']['need_5']['advance_details'] ?? [];

        $customMessages = [
            'investment_monthly_payment.required' => 'You are required to enter an amount.',
            'investment_monthly_payment.regex' => 'You must enter number.',
            'investment_supporting_years.required' => 'You are required to enter a year.',
            'investment_supporting_years.integer' => 'The year must be a number.',
            'investment_supporting_years.min' => 'The year must be at least :min.',
            'investment_supporting_years.max' => 'The year must not more than :max.',
        ];

        $validatedData = Validator::make($request->all(), [
            'investment_supporting_years' => 'required|integer|min:1|max:99',
            'investment_monthly_payment' => [
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
        $investment_monthly_payment = str_replace(',','',$request->input('investment_monthly_payment'));
        $investment_supporting_years = $request->input('investment_supporting_years');
        $investmentTotalFund = floatval($investment_monthly_payment * 12 * $investment_supporting_years);
        $totalInvestmentNeeded = floatval($request->input('total_investmentNeeded'));

        // Update specific keys with new values
        $advanceDetails = array_merge($advanceDetails, [
            'covered_amount' => $investment_monthly_payment,
            'supporting_years' => $investment_supporting_years,
        ]);

        if ($totalInvestmentNeeded === $investmentTotalFund){
            $advanceDetails = array_merge($advanceDetails, [
                'goals_amount' => $totalInvestmentNeeded
            ]);
        }
        else{
            $advanceDetails = array_merge($advanceDetails, [
                'goals_amount' => $investmentTotalFund
            ]);
        }

        // Set the updated investments_needs back to the customer_details session
        $customerDetails['selected_needs']['need_5']['advance_details'] = $advanceDetails;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        $transactionService->handleTransaction($request,$customerDetails);

        $transactionData = ['transaction_id' => $request->input('transaction_id')];

        // Process the form data and perform any necessary actions
        return redirect()->route('investment.annual.return',$transactionData);
    }

    public function validateInvestmentAnnualReturn(Request $request, TransactionService $transactionService){

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        $customMessages = [
            'investment_pa.required' => 'You are required to enter annual return percentage',
            'investment_pa.numeric' => 'The input must be a number',
            'investment_pa.min' => 'The input must be at least :min.',
            'investment_pa.max' => 'The input must not more than :max.',
        ];

        $validatedData = Validator::make($request->all(), [
            'investment_pa' => 'required|numeric|min:1|max:999',
        ], $customMessages);
        
        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing investments_needs from the session
        $advanceDetails = $customerDetails['selected_needs']['need_5']['advance_details'] ?? [];
        $lastPageUrl = $customerDetails['lastPageUrl'] ?? [];

        // Validation passed, perform any necessary processing.
        $investment_pa = $request->input('investment_pa');
        // $totalAnnualReturn = $request->input('total_annualReturn');
        // $newTotalAnnualReturn = floatval($customerDetails['selected_needs']['need_5']['advance_details']['goals_amount'] * $investment_pa / 100);
        $totalPercentage = $request->input('percentage');
        $newInvestmentPercentage = floatval($investment_pa);

        $lastPage = str_replace(url('/'), '', url()->previous());

        // Update specific keys with new values
        $advanceDetails = array_merge($advanceDetails, [
            'annual_returns' => $investment_pa
        ]);

        $lastPageUrl = array_merge($lastPageUrl, [
            'last_page_url' => $lastPage
        ]);

        // if ($newTotalAnnualReturn === $totalAnnualReturn && $newInvestmentPercentage === $totalPercentage){
        if ($newInvestmentPercentage === $totalPercentage){
            if ($newInvestmentPercentage > 100){
                $advanceDetails = array_merge($advanceDetails, [
                    // 'annual_return_amount' => $totalAnnualReturn,
                    'fund_percentage' => '100'
                ]);
            }
            else{
                $advanceDetails = array_merge($advanceDetails, [
                    // 'annual_return_amount' => $totalAnnualReturn,
                    'fund_percentage' => $totalPercentage
                ]);
            }
        }
        else{
            if ($newInvestmentPercentage > 100){
                $advanceDetails = array_merge($advanceDetails, [
                    // 'annual_return_amount' => $newTotalAnnualReturn,
                    'fund_percentage' => '100'
                ]);
            }
            else{
                $advanceDetails = array_merge($advanceDetails, [
                    // 'annual_return_amount' => $newTotalAnnualReturn,
                    'fund_percentage' => $newInvestmentPercentage
                ]);
            }
        }

        // Set the updated investments_needs back to the customer_details session
        $customerDetails['selected_needs']['need_5']['advance_details'] = $advanceDetails;
        $customerDetails['lastPageUrl'] = $lastPageUrl;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        $transactionService->handleTransaction($request,$customerDetails);

        $transactionData = ['transaction_id' => $request->input('transaction_id')];

        return redirect()->route('investment.risk.profile',$transactionData);
    }

    public function validateInvestmentRiskProfile(Request $request, TransactionService $transactionService){

    //     $customMessages = [
    //         'investmentRiskProfileInput.required' => 'Please select a risk level.',
    //         'investmentRiskProfileInput.in' => 'Invalid risk level selected.',
    //         'investmentPotentialReturnInput.required_if' => 'Please select a potential return for the chosen risk level.',
    //     ];

    //     $validatedData = Validator::make($request->all(), [
    //         'investmentRiskProfileInput' => 'required|in:High Risk,Medium Risk,Low Risk',
    //         'investmentPotentialReturnInput' => 'required_if:investmentRiskProfileInput,High Risk,Medium Risk,Low Risk',
            
    //     ], $customMessages);

    //     if ($validatedData->fails()) {
    //         return redirect()->back()->withErrors($validatedData)->withInput();
    //     }

    //     // Validation passed, perform any necessary processing.
    //     $investmentRiskProfileInput = $request->input('investmentRiskProfileInput');
    //     $investmentPotentialReturnInput = $request->input('investmentPotentialReturnInput');

    //     // Get the existing customer_details array from the session
    //     $customerDetails = $request->session()->get('customer_details', []);

    //     // Get existing investments_needs from the session
    //     $advanceDetails = $customerDetails['selected_needs']['need_5']['advance_details'] ?? [];

    //     // Update specific keys with new values
    //     $advanceDetails = array_merge($advanceDetails, [
    //         'risk_profile' => $investmentRiskProfileInput,
    //         'potential_return' => $investmentPotentialReturnInput
    //     ]);

    //     // Set the updated investments_needs back to the customer_details session
    //     $customerDetails['selected_needs']['need_5']['advance_details'] = $advanceDetails;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        $transactionService->handleTransaction($request,$customerDetails);

        $transactionData = ['transaction_id' => $request->input('transaction_id')];

        // // Process the form data and perform any necessary actions
        return redirect()->route('investment.gap',$transactionData);
    }
    
    public function submitInvestmentGap(Request $request, TransactionService $transactionService){

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing investments_needs from the session
        $advanceDetails = $customerDetails['selected_needs']['need_5']['advance_details'] ?? [];

        // Set the updated investments_needs back to the customer_details session
        $customerDetails['selected_needs']['need_5']['advance_details'] = $advanceDetails;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        $transactionService->handleTransaction($request,$customerDetails);

        $transactionData = ['transaction_id' => $request->input('transaction_id')];

        if (isset($customerDetails['priorities']['health-medical_discuss']) && ($customerDetails['priorities']['health-medical_discuss'] === 'true' || $customerDetails['priorities']['health-medical_discuss'] === true)) {
            return redirect()->route('health.medical.home',$transactionData);
        } else if (isset($customerDetails['priorities']['debt-cancellation_discuss']) && ($customerDetails['priorities']['debt-cancellation_discuss'] === 'true' || $customerDetails['priorities']['debt-cancellation_discuss'] === true)) {
            return redirect()->route('debt.cancellation.home',$transactionData);
        }
        else {
            return redirect()->route('existing.policy',$transactionData);
        }
    }

}