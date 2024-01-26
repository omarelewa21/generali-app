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
use Illuminate\Support\Facades\DB;
use App\Models\SessionStorage; 

class RetirementController extends Controller
{
    // protected $need_sequence;

    // public function calculateNeedSequence(Request $request) {

        // $customerDetails = $request->session()->get('customer_details', []);

        // Set the default value for $need_sequence
        // $need_sequence = 0;

        // if ($customerDetails['priorities']['protectionDiscuss'] == true || $customerDetails['priorities']['protectionDiscuss'] == 'true'){
        //     $need_sequence = 2;
        // } else if ($customerDetails['priorities']['retirementDiscuss'] == true || $customerDetails['priorities']['retirementDiscuss'] == 'true'){
        //     $need_sequence = 1;
        // }
    //     $protectionDiscuss = isset($customerDetails['priorities']['protectionDiscuss']) && ($customerDetails['priorities']['protectionDiscuss'] == true || $customerDetails['priorities']['protectionDiscuss'] == 'true');
    //     $retirementDiscuss = isset($customerDetails['priorities']['retirementDiscuss']) && ($customerDetails['priorities']['retirementDiscuss'] == true || $customerDetails['priorities']['retirementDiscuss'] == 'true');

    //     $need_sequence = ($protectionDiscuss ? ($retirementDiscuss ? 2 : 1) : 1);

    //     return $need_sequence;
    // }

    public function validateRetirementCoverageSelection(Request $request)
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
        $selectedNeeds = $customerDetails['selected_needs'] ?? [];
        // $need_sequence = $this->calculateNeedSequence($request);

        // Validation passed, perform any necessary processing.
        $relationshipInput = $request->input('relationshipInput');
        $selectedInsuredNameInput = $request->input('selectedInsuredNameInput');
        $selectedCoverForDobInput = $request->input('selectedCoverForDobInput');
        $othersCoverForNameInput = $request->input('othersCoverForNameInput');
        $othersCoverForDobInput = $request->input('othersCoverForDobInput');

        $index = array_search('retirement', $customerDetails['financial_priorities'], true);
        if ($customerDetails['priorities']['retirement'] == true || $customerDetails['priorities']['retirement'] == 'true'){
            $coverAnswer = 'Yes';
        } else{
            $coverAnswer = 'No';
        }
        if ($customerDetails['priorities']['retirementDiscuss'] == true || $customerDetails['priorities']['retirementDiscuss'] == 'true'){
            $discussAnswer = 'Yes';
        } else{
            $discussAnswer = 'No';
        }

        // $needs = $customerDetails['selected_needs']['need_'.$need_sequence] ?? [];
        // $advanceDetails = $customerDetails['selected_needs']['need_'.$need_sequence]['advance_details'] ?? [];
        $needs = $customerDetails['selected_needs']['need_2'] ?? [];
        $advanceDetails = $customerDetails['selected_needs']['need_2']['advance_details'] ?? [];

        // Update specific keys with new values
        $needs = array_merge($needs, [
            'need_no' => 'N2',
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

        // Set the updated retirement_needs back to the customer_details session
        $customerDetails['selected_needs']['need_2'] = $needs;
        $customerDetails['selected_needs']['need_2']['advance_details'] = $advanceDetails;
        
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

        return redirect()->route('retirement.ideal');
        
    }

    public function validateIdeal(Request $request)
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
            'retirementIdealInput' => [
                'at_least_one_selected',
            ],
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $retirementIdealInput = $request->input('retirementIdealInput');
        
        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing retirement_needs from the session
        $selectedNeeds = $customerDetails['selected_needs'] ?? [];
        // $need_sequence = $this->calculateNeedSequence($request);
        $needs = $customerDetails['selected_needs']['need_2'] ?? [];
        $advanceDetails = $customerDetails['selected_needs']['need_2']['advance_details'] ?? [];

        // Update specific keys with new values
        $advanceDetails = array_merge($advanceDetails, [
            'ideal_retirement' => $retirementIdealInput
        ]);

        // Set the updated retirement_needs back to the customer_details session
        $customerDetails['selected_needs']['need_2']['advance_details'] = $advanceDetails;

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

        return redirect()->route('retirement.monthly.support');
    }

    public function validateRetirementMonthlySupport(Request $request){

        $customMessages = [
            'retirement_monthly_support.required' => 'You are required to enter an amount.',
            'retirement_monthly_support.regex' => 'You must enter number',
        ];

        $validatedData = Validator::make($request->all(), [
            'retirement_monthly_support' => [
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
        $retirement_monthly_support = str_replace(',','',$request->input('retirement_monthly_support'));
        $retirementTotalFund = floatval($retirement_monthly_support * 12);
        $totalRetirementFund = floatval($request->input('total_retirementFund'));
        
        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing retirement_needs from the session
        $advanceDetails = $customerDetails['selected_needs']['need_2']['advance_details'] ?? [];

        // Update specific keys with new values
        $advanceDetails = array_merge($advanceDetails, [
            'monthly_covered_amount' => $retirement_monthly_support,
            'covered_amount' => $retirement_monthly_support*12
        ]);

        if ($totalRetirementFund === $retirementTotalFund){
            $advanceDetails = array_merge($advanceDetails, [
                'total_retirement_needed' => $totalRetirementFund
            ]);
        }
        else{
            $advanceDetails = array_merge($advanceDetails, [
                'total_retirement_needed' => $retirementTotalFund
            ]);
        }

        // Set the updated retirement_needs back to the customer_details session
        $customerDetails['selected_needs']['need_2']['advance_details'] = $advanceDetails;

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
        return redirect()->route('retirement.period');
    }

    public function validateRetirementPeriod(Request $request){

        $customMessages = [
            'supporting_years.required' => 'You are required to enter a year.',
            'supporting_years.integer' => 'The year must be a number.',
            'supporting_years.min' => 'The year must be at least :min.',
            'supporting_years.max' => 'The year must not more than :max.',
            'retirement_age.required' => 'You are required to enter a year.',
            'retirement_age.integer' => 'The year must be a number.',
            'retirement_age.min' => 'The year must be at least :min.',
            'retirement_age.max' => 'The year must not more than :max.',
        ];

        $validatedData = Validator::make($request->all(), [
            'supporting_years' => 'required|integer|min:1|max:99',
            'retirement_age' => 'required|integer|min:1|max:99',
        ], $customMessages);
        
        
        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing retirement_needs from the session
        $advanceDetails = $customerDetails['selected_needs']['need_2']['advance_details'] ?? [];

        // Validation passed, perform any necessary processing.
        $supporting_years = $request->input('supporting_years');
        $retirement_age = $request->input('retirement_age');
        $retirementTotalFund = floatval($customerDetails['selected_needs']['need_2']['advance_details']['monthly_covered_amount'] * 12 * $supporting_years);
        $totalRetirementFund = floatval($request->input('total_retirementFund'));

        // Update specific keys with new values
        $advanceDetails = array_merge($advanceDetails, [
            'supporting_years' => $supporting_years,
            'remaining_years' => $retirement_age
        ]);

        if ($totalRetirementFund === $retirementTotalFund){

            $advanceDetails = array_merge($advanceDetails, [
                'total_retirement_needed' => $totalRetirementFund
            ]);
        }
        else{
            $advanceDetails = array_merge($advanceDetails, [
                'total_retirement_needed' => $retirementTotalFund
            ]);
        }

        // Set the updated retirement back to the customer_details session
        $customerDetails['selected_needs']['need_2']['advance_details'] = $advanceDetails;

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

        return redirect()->route('retirement.allocated.funds');
    }

    public function validateRetirementOthers(Request $request){

        Validator::extend('at_least_one_selected', function ($attribute, $value, $parameters, $validator) {
            if ($value !== null) {
                return true; 
            }
            
            $customMessage = "Please select at least one.";
            $validator->errors()->add($attribute, $customMessage);
            // $validator->errors()->add($attribute);
    
            return false;
        });

        $customMessages = [
            'other_income_sources_5_text.required_if' => 'Please enter a source of income.',
            // 'other_income_sources.required' => 'Please enter a source of income.',
            // 'other_income_sources.at_least_one_selected' => 'Please select at least one source of income.',
            'retirement_savings.regex' => 'The amount must be a number.',
        ];

        $validatedData = Validator::make($request->all(), [
            // 'other_income_sources_5_text' => 'required_if: other_income_sources_5|max:60',
            'other_income_sources_5_text' => 'required_if:other_income_sources_5,Others|max:60',
            'other_income_sources' => [
                'at_least_one_selected',
            ],
            'retirement_savings' => [
                'regex:/^[0-9,]+$/',
                'nullable',
                function ($attribute, $value, $fail) use ($request) {
                    // Remove commas and check if the value is at least 1
                    $numericValue = str_replace(',', '', $value);
                    $max = 20000000;
                    if (intval($numericValue) > $max) {
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

        // Get existing retirement_needs from the session
        $advanceDetails = $customerDetails['selected_needs']['need_2']['advance_details'] ?? [];

        // Validation passed, perform any necessary processing.
        $retirement_savings = str_replace(',','',$request->input('retirement_savings'));
        if ($retirement_savings === '' || $retirement_savings === 0){
            $retirement_savings = 0;
        }
        else{
            $retirement_savings = str_replace(',','',$request->input('retirement_savings'));
        }
        $newRetirementTotalAmountNeeded = floatval(($customerDetails['selected_needs']['need_2']['advance_details']['monthly_covered_amount'] * 12 * $customerDetails['selected_needs']['need_2']['advance_details']['supporting_years']) - $retirement_savings);
        $newRetirementPercentage = floatval($retirement_savings / ($customerDetails['selected_needs']['need_2']['advance_details']['monthly_covered_amount'] * 12 * $customerDetails['selected_needs']['need_2']['advance_details']['supporting_years']) * 100);
        $totalAmountNeeded = floatval($request->input('total_amountNeeded'));
        $totalPercentage = floatval($request->input('percentage'));
        $other_income_sources_5_text = $request->input('other_income_sources_5_text');
        $other_income_sources = $request->input('other_income_sources');
        

        // Update specific keys with new values
        $advanceDetails = array_merge($advanceDetails, [
            'existing_amount' => $retirement_savings,
            'other_sources_custom' => $other_income_sources_5_text,
            'other_sources' => $other_income_sources
        ]);

        if ($newRetirementTotalAmountNeeded === $totalAmountNeeded && $newRetirementPercentage === $totalPercentage){
            if ($newRetirementTotalAmountNeeded <= 0){
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
            if ($newRetirementTotalAmountNeeded <= 0){
                $advanceDetails = array_merge($advanceDetails, [
                    'insurance_amount' => '0',
                    'fund_percentage' => '100'
                ]);
            }
            else{
                $advanceDetails = array_merge($advanceDetails, [
                    'insurance_amount' => $newRetirementTotalAmountNeeded,
                    'fund_percentage' => $newRetirementPercentage
                ]);
            }
        }

        // Set the updated retirement back to the customer_details session
        $customerDetails['selected_needs']['need_2']['advance_details'] = $advanceDetails;

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
        $formattedArray = "<pre>" . print_r($customerDetails, true) . "</pre>";
        return ($formattedArray);
        // return redirect()->route('retirement.gap');
    }

    public function submitRetirementGap(Request $request){

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing retirement_needs from the session
        $advanceDetails = $customerDetails['selected_needs']['need_2']['advance_details'] ?? [];

        // Set the updated retirement back to the customer_details session
        $customerDetails['selected_needs']['need_2']['advance_details'] = $advanceDetails;

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

        if (isset($customerDetails['priorities']['education_discuss']) && ($customerDetails['priorities']['education_discuss'] === 'true' || $customerDetails['priorities']['education_discuss'] === true)) {
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
            return redirect()->route('existing.policy');
        }
    }

}