<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\SessionStorage; 

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

    public function validateInvestmentCoverageSelection(Request $request)
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

        $index = array_search('investment', $customerDetails['priorities_level'], true);
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
        Log::debug($customerDetails);

        try {
            DB::transaction(function () use ($request,$customerDetails) {
                $sessionStorage = new SessionStorage();
                $sessionStorage->data = json_encode($customerDetails);
                $route = strval(request()->path());
                $sessionStorage->page_route = $route;
                $sessionStorage->save();
            });
        } catch (\Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('investment.amount.needed');
    }

    public function validateInvestmentAmountNeeded(Request $request){

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
                'total_investment_needed' => $totalInvestmentNeeded
            ]);
        }
        else{
            $advanceDetails = array_merge($advanceDetails, [
                'total_investment_needed' => $investmentTotalFund
            ]);
        }

        // Set the updated investments_needs back to the customer_details session
        $customerDetails['selected_needs']['need_5']['advance_details'] = $advanceDetails;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        // Process the form data and perform any necessary actions
        return redirect()->route('investment.annual.return');
    }

    public function validateInvestmentAnnualReturn(Request $request){

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

        // Validation passed, perform any necessary processing.
        $investment_pa = $request->input('investment_pa');
        $totalAnnualReturn = $request->input('total_annualReturn');
        $newTotalAnnualReturn = floatval($customerDetails['selected_needs']['need_5']['advance_details']['total_investment_needed'] * $investment_pa / 100);
        $totalPercentage = $request->input('percentage');
        $newInvestmentPercentage = floatval($newTotalAnnualReturn / $customerDetails['selected_needs']['need_5']['advance_details']['total_investment_needed'] * 100);

        // Update specific keys with new values
        $advanceDetails = array_merge($advanceDetails, [
            'annual_returns' => $investment_pa
        ]);

        if ($newTotalAnnualReturn === $totalAnnualReturn && $newInvestmentPercentage === $totalPercentage){
            if ($newInvestmentPercentage > 100){
                $advanceDetails = array_merge($advanceDetails, [
                    'annual_return_amount' => $totalAnnualReturn,
                    'fund_percentage' => '100'
                ]);
            }
            else{
                $advanceDetails = array_merge($advanceDetails, [
                    'annual_return_amount' => $totalAnnualReturn,
                    'fund_percentage' => $totalPercentage
                ]);
            }
        }
        else{
            if ($newInvestmentPercentage > 100){
                $advanceDetails = array_merge($advanceDetails, [
                    'annual_return_amount' => $newTotalAnnualReturn,
                    'fund_percentage' => '100'
                ]);
            }
            else{
                $advanceDetails = array_merge($advanceDetails, [
                    'annual_return_amount' => $newTotalAnnualReturn,
                    'fund_percentage' => $newInvestmentPercentage
                ]);
            }
        }

        // Set the updated investments_needs back to the customer_details session
        $customerDetails['selected_needs']['need_5']['advance_details'] = $advanceDetails;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);
        
        try {
            DB::transaction(function () use ($request,$customerDetails) {
                $sessionStorage = new SessionStorage();
                $sessionStorage->data = json_encode($customerDetails);
                $route = strval(request()->path());
                $sessionStorage->page_route = $route;
                $sessionStorage->save();
            });
        } catch (\Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('investment.risk.profile');
    }

    public function validateInvestmentRiskProfile(Request $request){

        $customMessages = [
            'investmentRiskProfileInput.required' => 'Please select a risk level.',
            'investmentRiskProfileInput.in' => 'Invalid risk level selected.',
            'investmentPotentialReturnInput.required_if' => 'Please select a potential return for the chosen risk level.',
        ];

        $validatedData = Validator::make($request->all(), [
            'investmentRiskProfileInput' => 'required|in:High Risk,Medium Risk,Low Risk',
            'investmentPotentialReturnInput' => 'required_if:investmentRiskProfileInput,High Risk,Medium Risk,Low Risk',
            
        ], $customMessages);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $investmentRiskProfileInput = $request->input('investmentRiskProfileInput');
        $investmentPotentialReturnInput = $request->input('investmentPotentialReturnInput');

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing investments_needs from the session
        $advanceDetails = $customerDetails['selected_needs']['need_5']['advance_details'] ?? [];

        // Update specific keys with new values
        $advanceDetails = array_merge($advanceDetails, [
            'risk_profile' => $investmentRiskProfileInput,
            'potential_return' => $investmentPotentialReturnInput
        ]);

        // Set the updated investments_needs back to the customer_details session
        $customerDetails['selected_needs']['need_5']['advance_details'] = $advanceDetails;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);
        
        try {
            DB::transaction(function () use ($request,$customerDetails) {
                $sessionStorage = new SessionStorage();
                $sessionStorage->data = json_encode($customerDetails);
                $route = strval(request()->path());
                $sessionStorage->page_route = $route;
                $sessionStorage->save();
            });
        } catch (\Exception $e) {
            DB::rollBack();
        }

        // // Process the form data and perform any necessary actions
        return redirect()->route('investment.gap');
    }
    
    public function submitInvestmentGap(Request $request){

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing investments_needs from the session
        $advanceDetails = $customerDetails['selected_needs']['need_5']['advance_details'] ?? [];

        // Set the updated investments_needs back to the customer_details session
        $customerDetails['selected_needs']['need_5']['advance_details'] = $advanceDetails;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        try {
            DB::transaction(function () use ($request,$customerDetails) {
                $sessionStorage = new SessionStorage();
                $sessionStorage->data = json_encode($customerDetails);
                $route = strval(request()->path());
                $sessionStorage->page_route = $route;
                $sessionStorage->save();
            });
        } catch (\Exception $e) {
            DB::rollBack();
        }

        if (isset($customerDetails['priorities']['health-medical_discuss']) && ($customerDetails['priorities']['health-medical_discuss'] === 'true' || $customerDetails['priorities']['health-medical_discuss'] === true)) {
            return redirect()->route('health.medical.home');
        } else if (isset($customerDetails['priorities']['debt-cancellation_discuss']) && ($customerDetails['priorities']['debt-cancellation_discuss'] === 'true' || $customerDetails['priorities']['debt-cancellation_discuss'] === true)) {
            return redirect()->route('debt.cancellation.home');
        }
        else {
            return redirect()->route('existing.policy');
        }
    }

}