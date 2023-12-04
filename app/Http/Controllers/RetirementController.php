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

class RetirementController extends Controller
{
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
            'retirementSelectedAvatarInput' => [
                'at_least_one_selected',
            ],
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $retirementSelectedAvatarInput = $request->input('retirementSelectedAvatarInput');
        $retirementSelectedImage = $request->input('retirementSelectedAvatarImage');

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing retirement_needs from the session
        $retirement = $customerDetails['retirement_needs'] ?? [];
        
        // Update specific keys with new values
        $retirement = array_merge($retirement, [
            'coveragePerson' => $retirementSelectedAvatarInput
        ]);

        // Set the updated identity_details back to the customer_details session
        $customerDetails['retirement_needs'] = $retirement;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

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
        $retirement = $customerDetails['retirement_needs'] ?? [];

        // Update specific keys with new values
        $retirement = array_merge($retirement, [
            'idealRetirement' => $retirementIdealInput
        ]);

        // Set the updated identity_details back to the customer_details session
        $customerDetails['retirement_needs'] = $retirement;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

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
        $retirement = $customerDetails['retirement_needs'] ?? [];

        // Update specific keys with new values
        $retirement = array_merge($retirement, [
            'monthlySupportAmount' => $retirement_monthly_support
        ]);

        if ($totalRetirementFund === $retirementTotalFund){
            $retirement = array_merge($retirement, [
                'totalRetirementNeeded' => $totalRetirementFund
            ]);
        }
        else{
            $retirement = array_merge($retirement, [
                'totalRetirementNeeded' => $retirementTotalFund
            ]);
        }

        // Set the updated identity_details back to the customer_details session
        $customerDetails['retirement_needs'] = $retirement;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

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
        $retirement = $customerDetails['retirement_needs'] ?? [];

        // Validation passed, perform any necessary processing.
        $supporting_years = $request->input('supporting_years');
        $retirement_age = $request->input('retirement_age');
        $retirementTotalFund = floatval($customerDetails['retirement_needs']['monthlySupportAmount'] * 12 * $supporting_years);
        $totalRetirementFund = floatval($request->input('total_retirementFund'));

        // Update specific keys with new values
        $retirement = array_merge($retirement, [
            'supportingYears' => $supporting_years,
            'retirementAge' => $retirement_age
        ]);

        if ($totalRetirementFund === $retirementTotalFund){

            $retirement = array_merge($retirement, [
                'totalRetirementNeeded' => $totalRetirementFund
            ]);
        }
        else{
            $retirement = array_merge($retirement, [
                'totalRetirementNeeded' => $retirementTotalFund
            ]);
        }

        // Set the updated retirement back to the customer_details session
        $customerDetails['retirement_needs'] = $retirement;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        // Process the form data and perform any necessary actions
        //  $formattedArray = "<pre>" . print_r($customerDetails, true) . "</pre>";
        // return ($formattedArray);
        return redirect()->route('retirement.allocated.funds');
    }

    // public function validateSupportingYears(Request $request){

    //     $customMessages = [
    //         'supporting_years.required' => 'You are required to enter a year.',
    //         'supporting_years.integer' => 'The year must be a number',
    //         'supporting_years.min' => 'The year must be at least :min.',
    //         'supporting_years.max' => 'The year must not more than :max.',
    //     ];

    //     $validatedData = Validator::make($request->all(), [
    //         'supporting_years' => 'required|integer|min:1|max:99',
    //     ], $customMessages);
        
    //     if ($validatedData->fails()) {
    //         return redirect()->back()->withErrors($validatedData)->withInput();
    //     }

    //     // Get the existing customer_details array from the session
    //     $customerDetails = $request->session()->get('customer_details', []);

    //     // Get existing retirement_needs from the session
    //     $retirement = $customerDetails['retirement_needs'] ?? [];

    //     // Validation passed, perform any necessary processing.
    //     $supporting_years = $request->input('supporting_years');
    //     $newRetirementTotalFund = floatval($supporting_years * $customerDetails['retirement_needs']['totalRetirementNeeded']);
    //     $newTotalRetirementNeeded = floatval($request->input('newTotal_retirementNeeded'));

    //     // Update specific keys with new values
    //     $retirement = array_merge($retirement, [
    //         'supportingYears' => $supporting_years
    //     ]);

    //     if ($newRetirementTotalFund === $newTotalRetirementNeeded){
    //         $retirement = array_merge($retirement, [
    //             'newTotalRetirementNeeded' => $newTotalRetirementNeeded
    //         ]);
    //     }
    //     else{
    //         $retirement = array_merge($retirement, [
    //             'newTotalRetirementNeeded' => $newRetirementTotalFund
    //         ]);
    //     }

    //     // Set the updated retirement back to the customer_details session
    //     $customerDetails['retirement_needs'] = $retirement;

    //     // Store the updated customer_details array back into the session
    //     $request->session()->put('customer_details', $customerDetails);
    //     Log::debug($customerDetails);

    //     return redirect()->route('retirement.retire.age');
    // }

    // public function validateRetireAge(Request $request){

    //     $customMessages = [
    //         'retirement_age.required' => 'You are required to enter a year.',
    //         'retirement_age.integer' => 'The year must be a number',
    //         'retirement_age.min' => 'The year must be at least :min.',
    //         'retirement_age.max' => 'The year must not more than :max.',
    //     ];

    //     $validatedData = Validator::make($request->all(), [
    //         'retirement_age' => 'required|integer|min:1|max:99',
    //     ], $customMessages);
        
    //     if ($validatedData->fails()) {
    //         return redirect()->back()->withErrors($validatedData)->withInput();
    //     }

    //     // Validation passed, perform any necessary processing.
    //     $retirement_age = $request->input('retirement_age');

    //     // Get the existing customer_details array from the session
    //     $customerDetails = $request->session()->get('customer_details', []);

    //     // Get existing retirement_needs from the session
    //     $retirement = $customerDetails['retirement_needs'] ?? [];

    //     // Update specific keys with new values
    //     $retirement = array_merge($retirement, [
    //         'retirementAge' => $retirement_age
    //     ]);

    //     // Set the updated retirement back to the customer_details session
    //     $customerDetails['retirement_needs'] = $retirement;

    //     // Store the updated customer_details array back into the session
    //     $request->session()->put('customer_details', $customerDetails);
    //     Log::debug($customerDetails);

    //     return redirect()->route('retirement.others');
    // }

    public function validateRetirementOthers(Request $request){

        $customMessages = [
            'other_income_sources.required' => 'Please enter a source of income.',
            'retirement_savings.regex' => 'The amount must be a number.',
        ];

        $validatedData = Validator::make($request->all(), [
            'other_income_sources' => 'required|max:60',
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
        $retirement = $customerDetails['retirement_needs'] ?? [];

        // Validation passed, perform any necessary processing.
        $other_income_sources = $request->input('other_income_sources');
        $retirement_savings = str_replace(',','',$request->input('retirement_savings'));
        if ($retirement_savings === '' || $retirement_savings === 0){
            $retirement_savings = 0;
        }
        else{
            $retirement_savings = str_replace(',','',$request->input('retirement_savings'));
        }
        $newRetirementTotalAmountNeeded = floatval(($customerDetails['retirement_needs']['monthlySupportAmount'] * 12 * $customerDetails['retirement_needs']['supportingYears']) - $retirement_savings);
        $newRetirementPercentage = floatval($retirement_savings / ($customerDetails['retirement_needs']['monthlySupportAmount'] * 12 * $customerDetails['retirement_needs']['supportingYears']) * 100);
        $totalAmountNeeded = floatval($request->input('total_amountNeeded'));
        $totalPercentage = floatval($request->input('percentage'));
        

        // Update specific keys with new values
        $retirement = array_merge($retirement, [
            'retirementSavingsAmount' => $retirement_savings,
            'otherIncomeResources' => $other_income_sources
        ]);

        if ($newRetirementTotalAmountNeeded === $totalAmountNeeded && $newRetirementPercentage === $totalPercentage){
            if ($newRetirementTotalAmountNeeded <= 0){
                $retirement = array_merge($retirement, [
                    'totalAmountNeeded' => '0',
                    'fundPercentage' => '100'
                ]);
            }
            else{
                $retirement = array_merge($retirement, [
                    'totalAmountNeeded' => $totalAmountNeeded,
                    'fundPercentage' => $totalPercentage
                ]);
            }
        }
        else{
            if ($newRetirementTotalAmountNeeded <= 0){
                $retirement = array_merge($retirement, [
                    'totalAmountNeeded' => '0',
                    'fundPercentage' => '100'
                ]);
            }
            else{
                $retirement = array_merge($retirement, [
                    'totalAmountNeeded' => $newRetirementTotalAmountNeeded,
                    'fundPercentage' => $newRetirementPercentage
                ]);
            }
        }

        // Set the updated retirement back to the customer_details session
        $customerDetails['retirement_needs'] = $retirement;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);
        // $formattedArray = "<pre>" . print_r($customerDetails, true) . "</pre>";
        // return ($formattedArray);
        return redirect()->route('retirement.gap');
    }

    public function submitRetirementGap(Request $request){

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing retirement_needs from the session
        $retirement = $customerDetails['retirement_needs'] ?? [];

        // Set the updated retirement back to the customer_details session
        $customerDetails['retirement_needs'] = $retirement;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        // // Process the form data and perform any necessary actions
        //  $formattedArray = "<pre>" . print_r($customerDetails, true) . "</pre>";
        // return ($formattedArray);
        return redirect()->route('education.home');
    }

}