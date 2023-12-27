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

class EducationController extends Controller
{
    public function validateEducationCoverageSelection(Request $request)
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

        // Get existing education_needs from the session
        $education = $customerDetails['education_needs'] ?? [];

        // Update specific keys with new values
        $education = array_merge($education, [
            'coverFor' => $relationshipInput,
            'selectedInsuredName' => $selectedInsuredNameInput,
            'selectedCoverForDob' => $selectedCoverForDobInput,
            'othersCoverForName' => $othersCoverForNameInput,
            'othersCoverForDob' => $othersCoverForDobInput
        ]);

        // Set the updated education_needs back to the customer_details session
        $customerDetails['education_needs'] = $education;

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

        return redirect()->route('education.amount.needed');
    }

    public function validateEducationAmountNeeded(Request $request){

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
        // $educationTotalFund = floatval($tertiary_education_amount / $tertiary_education_years);
        $totalEducationFund = floatval($request->input('total_educationNeeded'));

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing education_needs from the session
        $education = $customerDetails['education_needs'] ?? [];

        // Update specific keys with new values
        $education = array_merge($education, [
            'tertiaryEducationAmount' => $tertiary_education_amount,
            'tertiaryEducationYear' => $tertiary_education_years,
            'totalEducationNeeded' => $totalEducationFund
        ]);

        // if ($totalEducationFund === $educationTotalFund){

        //     $education = array_merge($education, [
        //         'totalEducationNeeded' => $totalEducationFund
        //     ]);
        // }
        // else{
        //     $education = array_merge($education, [
        //         'totalEducationNeeded' => $educationTotalFund
        //     ]);
        // }

        // Set the updated education back to the customer_details session
        $customerDetails['education_needs'] = $education;

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

        // Process the form data and perform any necessary actions
        //  $formattedArray = "<pre>" . print_r($customerDetails, true) . "</pre>";
        // return ($formattedArray);
        return redirect()->route('education.existing.fund');
    }

    // public function validateEducationAmount(Request $request){

    //     $customMessages = [
    //         'tertiary_education_amount.required' => 'You are required to enter an amount.',
    //         'tertiary_education_amount.regex' => 'You must enter number',
    //     ];

    //     $validatedData = Validator::make($request->all(), [
    //         'tertiary_education_amount' => [
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
    //     $tertiary_education_amount = str_replace(',','',$request->input('tertiary_education_amount'));
    //     $educationTotalFund = floatval($tertiary_education_amount);
    //     $totalEducationFund = floatval($request->input('total_educationFund'));

    //     // Get the existing customer_details array from the session
    //     $customerDetails = $request->session()->get('customer_details', []);

    //     // Get existing education_needs from the session
    //     $education = $customerDetails['education_needs'] ?? [];

    //     // Update specific keys with new values
    //     $education = array_merge($education, [
    //         'tertiaryEducationAmount' => $tertiary_education_amount
    //     ]);

    //     if ($totalEducationFund === $educationTotalFund){
    //         $education = array_merge($education, [
    //             'totalEducationNeeded' => $totalEducationFund
    //         ]);
    //     }
    //     else{
    //         $education = array_merge($education, [
    //             'totalEducationNeeded' => $educationTotalFund
    //         ]);
    //     }

    //     // Set the updated education_needs back to the customer_details session
    //     $customerDetails['education_needs'] = $education;

    //     // Store the updated customer_details array back into the session
    //     $request->session()->put('customer_details', $customerDetails);
    //     Log::debug($customerDetails);

    //     return redirect()->route('education.supporting.years');
    // }
    // public function validateEducationSupportingYears(Request $request){

    //     $customMessages = [
    //         'tertiary_education_years.required' => 'You are required to enter a year.',
    //         'tertiary_education_years.integer' => 'The year must be a number',
    //         'tertiary_education_years.min' => 'The year must be at least :min.',
    //         'tertiary_education_years.max' => 'The year must not more than :max.',
    //     ];

    //     $validatedData = Validator::make($request->all(), [
    //         'tertiary_education_years' => 'required|integer|min:1|max:99',
    //     ], $customMessages);
        
    //     if ($validatedData->fails()) {
    //         return redirect()->back()->withErrors($validatedData)->withInput();
    //     }

    //     // Get the existing customer_details array from the session
    //     $customerDetails = $request->session()->get('customer_details', []);

    //     // Get existing education_needs from the session
    //     $education = $customerDetails['education_needs'] ?? [];

    //     // Validation passed, perform any necessary processing.
    //     $tertiary_education_years = $request->input('tertiary_education_years');

    //     // Update specific keys with new values
    //     $education = array_merge($education, [
    //         'tertiaryEducationYear' => $tertiary_education_years
    //     ]);

    //     // Set the updated education_needs back to the customer_details session
    //     $customerDetails['education_needs'] = $education;

    //     // Store the updated customer_details array back into the session
    //     $request->session()->put('customer_details', $customerDetails);
    //     Log::debug($customerDetails);
    //     // $formattedArray = "<pre>" . print_r($customerDetails, true) . "</pre>";
    //     // return ($formattedArray);

    //     return redirect()->route('education.existing.fund');
    // }

    public function validateEducationExistingFund(Request $request){

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
        $education = $customerDetails['education_needs'] ?? [];

        // Validation passed, perform any necessary processing.
        $education_saving_amount = str_replace(',','',$request->input('education_saving_amount'));
        $education_other_savings = $request->input('education_other_savings');
        $totalAmountNeeded = floatval($request->input('total_amountNeeded'));
        $totalPercentage = floatval($request->input('percentage'));
        if ($education_saving_amount === '' || $education_saving_amount === null){
            $newEducationTotalAmountNeeded = floatval($customerDetails['education_needs']['totalEducationNeeded'] - 0);
            $newEducationPercentage = floatval(0 / $customerDetails['education_needs']['totalEducationNeeded'] * 100);
        } else{
            $newEducationTotalAmountNeeded = floatval($customerDetails['education_needs']['totalEducationNeeded'] - $education_saving_amount);
            $newEducationPercentage = floatval($education_saving_amount / $customerDetails['education_needs']['totalEducationNeeded'] * 100);
        }

        // Update specific keys with new values
        $education = array_merge($education, [
            'existingFund' => $education_other_savings,
            'existingFundAmount' => $education_saving_amount
        ]);

        if ($newEducationTotalAmountNeeded === $totalAmountNeeded && $newEducationPercentage === $totalPercentage){
            if ($newEducationTotalAmountNeeded <= 0){
                $education = array_merge($education, [
                    'totalAmountNeeded' => '0',
                    'fundPercentage' => '100'
                ]);
            }
            else{
                $education = array_merge($education, [
                    'totalAmountNeeded' => $totalAmountNeeded,
                    'fundPercentage' => $totalPercentage
                ]);
            }
        }
        else{
            if ($newEducationTotalAmountNeeded <= 0){
                $education = array_merge($education, [
                    'totalAmountNeeded' => '0',
                    'fundPercentage' => '100'
                ]);
            }
            else{
                $education = array_merge($education, [
                    'totalAmountNeeded' => $newEducationTotalAmountNeeded,
                    'fundPercentage' => $newEducationPercentage
                ]);
            }
        }

        // Set the updated education_needs back to the customer_details session
        $customerDetails['education_needs'] = $education;

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

        return redirect()->route('education.gap');
    }

    public function submitEducationGap(Request $request){

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing education_needs from the session
        $education = $customerDetails['education_needs'] ?? [];

        // Set the updated education_needs back to the customer_details session
        $customerDetails['education_needs'] = $education;

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

        // Process the form data and perform any necessary actions
        //  $formattedArray = "<pre>" . print_r($customerDetails, true) . "</pre>";
        // return ($formattedArray);
        if (isset($customerDetails['priorities']['savingsDiscuss']) && ($customerDetails['priorities']['savingsDiscuss'] === 'true' || $customerDetails['priorities']['savingsDiscuss'] === true)) {
            return redirect()->route('savings.home');
        } else if (isset($customerDetails['priorities']['investmentsDiscuss']) && ($customerDetails['priorities']['investmentsDiscuss'] === 'true' || $customerDetails['priorities']['investmentsDiscuss'] === true)) {
            return redirect()->route('investment.home');
        } else if (isset($customerDetails['priorities']['health-medicalDiscuss']) && ($customerDetails['priorities']['health-medicalDiscuss'] === 'true' || $customerDetails['priorities']['health-medicalDiscuss'] === true)) {
            return redirect()->route('health.medical.home');
        } else if (isset($customerDetails['priorities']['debt-cancellationDiscuss']) && ($customerDetails['priorities']['debt-cancellationDiscuss'] === 'true' || $customerDetails['priorities']['debt-cancellationDiscuss'] === true)) {
            return redirect()->route('debt.cancellation.home');
        }
        else {
            return redirect()->route('existing.policy');
        }
    }

}