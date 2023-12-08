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

class SavingsController extends Controller
{

    public function validateSavingsCoverageSelection(Request $request)
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
            'savingsSelectedAvatarInput' => [
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

        // Get existing savings_needs from the session
        $savings = $customerDetails['savings_needs'] ?? [];

        // Update specific keys with new values
        $savings = array_merge($savings, [
            'coverFor' => $relationshipInput,
            'selectedInsuredName' => $selectedInsuredNameInput,
            'selectedCoverForDob' => $selectedCoverForDobInput,
            'othersCoverForName' => $othersCoverForNameInput,
            'othersCoverForDob' => $othersCoverForDobInput
        ]);

        // Set the updated savings_needs back to the customer_details session
        $customerDetails['savings_needs'] = $savings;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        // return redirect()->route('savings.goals');
        return redirect()->route('savings.goals');
    }

    public function goals(Request $request)
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
                'savingsSelectedAvatarInput' => [
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

            

            // $validatedData = Validator::make($request->all(), [
            //     'savings_goals_amount' => [
            //         'required',
            //         'regex:/^[0-9,]+$/',
            //         function ($attribute, $value, $fail) {
            //             // Remove commas and check if the value is at least 1
            //             $numericValue = str_replace(',', '', $value);
            //             $min = 1;
            //             $max = 20000000;
            //             if (intval($numericValue) < $min) {
            //                 $fail('Your amount must be at least ' .$min. '.');
            //             }
            //             if (intval($numericValue) > $max) {
            //                 $fail('Your amount must not more than RM' .number_format(floatval($max)). '.');
            //             }
            //         },
            //     ],
            // ], $customMessages);

            // $validator = Validator::make($request->all(), [
            //     'savingsGoalsButtonInput' => [
            //         'at_least_one_selected',
            //     ],
            // ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $savings_goals_amount = str_replace(',','',$request->input('savings_goals_amount'));
            $savingsGoalsSerialized = $request->input('savingsGoalsButtonInput');
            $savingsGoalsButtonInput = json_decode($savingsGoalsSerialized, true);
            
            // $savingsGoalsButtonInput = array_filter($savingsGoalsButtonInput, function($value) {
            //     return $value !== null;
            // });
            // $savingsGoalsButtonInput = array_values($savingsGoalsButtonInput);

            // Get the existing customer_details array from the session
            $customerDetails = $request->session()->get('customer_details', []);

            // Get existing savings_needs from the session
            $savings = $customerDetails['savings_needs'] ?? [];

            $savings = array_merge($savings, [
                // 'goalTarget' => $savingsSelectedAvatarInput,
                'goalsAmount' => $savings_goals_amount
            ]);

            // Set the updated savings_needs back to the customer_details session
            $customerDetails['savings_needs'] = $savings;

            // Store the updated customer_details array back into the session
            $request->session()->put('customer_details', $customerDetails);
            Log::debug($customerDetails);

            // Process the form data and perform any necessary actions
            return redirect()->route('savings.amount.needed');
        } else {
            return response()->json(['error' => 'Invalid CSRF token'], 403);
        }
    }
    public function validateSavingsAmountNeeded(Request $request){

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing savings_needs from the session
        $savings = $customerDetails['savings_needs'] ?? [];

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
        $savingsTotalAmountNeeded = floatval($customerDetails['savings_needs']['goalsAmount'] - $savingsTotalFund);
        $totalAmountNeeded = floatval($request->input('total_amountNeeded'));
        $totalPercentage = floatval($request->input('percentage'));
        $savingsTotalPercentage = floatval($savingsTotalFund / $customerDetails['savings_needs']['goalsAmount'] * 100);

        // Update specific keys with new values
        $savings = array_merge($savings, [
            'monthlyInvestmentAmount' => $savings_monthly_payment,
            'investmentTimeFrame' => $savings_goal_duration
        ]);

        if ($totalSavingsNeeded === $savingsTotalFund && $savingsTotalAmountNeeded === $totalAmountNeeded && $totalPercentage === $savingsTotalPercentage){
            if ($savingsTotalAmountNeeded <= 0){
                $savings = array_merge($savings, [
                    'totalAmountNeeded' => '0',
                    'fundPercentage' => '100'
                ]);
            }
            else{
                $savings = array_merge($savings, [
                    'totalAmountNeeded' => $totalAmountNeeded,
                    'fundPercentage' => $totalPercentage
                ]);
            }
            $savings = array_merge($savings, [
                'totalSavingsNeeded' => $totalSavingsNeeded
            ]);
        }
        else{
            $savings = array_merge($savings, [
                'totalSavingsNeeded' => $savingsTotalFund
            ]);
            if ($savingsTotalAmountNeeded <= 0){
                $savings = array_merge($savings, [
                    'totalAmountNeeded' => '0',
                    'fundPercentage' => '100'
                ]);
            }
            else{
                $savings = array_merge($savings, [
                    'totalAmountNeeded' => $savingsTotalAmountNeeded,
                    'fundPercentage' => $savingsTotalPercentage
                ]);
            }
        }

        // Set the updated savings_needs back to the customer_details session
        $customerDetails['savings_needs'] = $savings;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        // Process the form data and perform any necessary actions
        return redirect()->route('savings.annual.return');
    }

    // public function validateMonthlyPayment(Request $request)
    // {
    //     $customMessages = [
    //         'savings_monthly_payment.required' => 'You are required to enter an amount.',
    //         'savings_monthly_payment.regex' => 'You must enter number',
    //     ];

    //     $validatedData = Validator::make($request->all(), [
    //         'savings_monthly_payment' => [
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
    //     $savings_monthly_payment = str_replace(',','',$request->input('savings_monthly_payment'));
    //     $savingsTotalFund = floatval($savings_monthly_payment * 12);
    //     $totalSavingsNeeded = floatval($request->input('total_savingsNeeded'));

    //     // Get the existing customer_details array from the session
    //     $customerDetails = $request->session()->get('customer_details', []);

    //     // Get existing savings_needs from the session
    //     $savings = $customerDetails['savings_needs'] ?? [];

    //     // Update specific keys with new values
    //     $savings = array_merge($savings, [
    //         'monthlyInvestmentAmount' => $savings_monthly_payment
    //     ]);

    //     if ($totalSavingsNeeded === $savingsTotalFund){
    //         $savings = array_merge($savings, [
    //             'totalSavingsNeeded' => $totalSavingsNeeded
    //         ]);
    //     }
    //     else{
    //         $savings = array_merge($savings, [
    //             'totalSavingsNeeded' => $savingsTotalFund
    //         ]);
    //     }

    //     // Set the updated savings_needs back to the customer_details session
    //     $customerDetails['savings_needs'] = $savings;

    //     // Store the updated customer_details array back into the session
    //     $request->session()->put('customer_details', $customerDetails);
    //     Log::debug($customerDetails);

    //     return redirect()->route('savings.goal.duration');
    // }

    // public function validateGoalDuration(Request $request)
    // {
    //     $customMessages = [
    //         'savings_goal_duration.required' => 'You are required to enter a year.',
    //         'savings_goal_duration.integer' => 'The year must be a number',
    //         'savings_goal_duration.min' => 'The year must be at least :min.',
    //         'savings_goal_duration.max' => 'The year must not more than :max.',
    //     ];

    //     $validatedData = Validator::make($request->all(), [
    //         'savings_goal_duration' => 'required|integer|min:1|max:99',
    //     ], $customMessages);
        
    //     if ($validatedData->fails()) {
    //         return redirect()->back()->withErrors($validatedData)->withInput();
    //     }

    //     // Get the existing customer_details array from the session
    //     $customerDetails = $request->session()->get('customer_details', []);

    //     // Get existing savings_needs from the session
    //     $savings = $customerDetails['savings_needs'] ?? [];

    //     // Validation passed, perform any necessary processing.
    //     $savings_goal_duration = $request->input('savings_goal_duration');
    //     $newSavingsTotalFund = floatval($savings_goal_duration * $customerDetails['savings_needs']['totalSavingsNeeded']);
    //     $newTotalSavingsNeeded = $request->input('newTotal_savingsNeeded');

    //     $savings = array_merge($savings, [
    //         'investmentTimeFrame' => $savings_goal_duration
    //     ]);

    //     if ($newSavingsTotalFund === $newTotalSavingsNeeded){
    //         $savings = array_merge($savings, [
    //             'newTotalSavingsNeeded' => $newTotalSavingsNeeded
    //         ]);
    //     }
    //     else{
    //         $savings = array_merge($savings, [
    //             'newTotalSavingsNeeded' => $newSavingsTotalFund
    //         ]);
    //     }

    //     // Set the updated savings_needs back to the customer_details session
    //     $customerDetails['savings_needs'] = $savings;

    //     // Store the updated customer_details array back into the session
    //     $request->session()->put('customer_details', $customerDetails);
    //     Log::debug($customerDetails);
        
    //     return redirect()->route('savings.annual.return');
    // }

    public function validateSavingsAnnualReturn(Request $request){

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
        $savings = $customerDetails['savings_needs'] ?? [];

        // Validation passed, perform any necessary processing.
        $savings_goal_pa = $request->input('savings_goal_pa');

        // Update specific keys with new values
        $savings = array_merge($savings, [
            'annualReturn' => $savings_goal_pa
        ]);

        // Set the updated savings_needs back to the customer_details session
        $customerDetails['savings_needs'] = $savings;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        //  $formattedArray = "<pre>" . print_r($customerDetails, true) . "</pre>";
        // return ($formattedArray);
        return redirect()->route('savings.risk.profile');
    }
    

    public function validateSavingsRiskProfile(Request $request){

        // Define custom validation rule for button selection
        // Validator::extend('at_least_one_selected', function ($attribute, $value, $parameters, $validator) {
        //     if ($value !== null) {
        //         return true;
        //     }
            
        //     $customMessage = "Please select at least one risk.";
        //     $validator->errors()->add($attribute, $customMessage);
    
        //     return false;
        // });

        // Validator::extend('at_least_one_potential_selected', function ($attribute, $value, $parameters, $validator) {
        //     if ($value !== null) {
        //         return true;
        //     }
            
        //     $customMessage = "Please select at least one potential return.";
        //     $validator->errors()->add($attribute, $customMessage);
    
        //     return false;
        // });

        // $validator = Validator::make($request->all(), [
        //     'savingsRiskProfileInput' => [
        //         'at_least_one_selected',
        //     ],
        //     'savingsPotentialReturnInput' => [
        //         'at_least_one_potential_selected',
        //     ],
        // ]);


        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }
        $customMessages = [
            'savingsRiskProfileInput.required' => 'Please select a risk level.',
            'savingsRiskProfileInput.in' => 'Invalid risk level selected.',
            'savingsPotentialReturnInput.required_if' => 'Please select a potential return for the chosen risk level.',
        ];

        $validatedData = Validator::make($request->all(), [
            'savingsRiskProfileInput' => 'required|in:High Risk,Medium Risk,Low Risk',
            // 'savingsPotentialReturnInput' => 'required|in:High Risk,Medium Risk,Low Risk',
            'savingsPotentialReturnInput' => 'required_if:savingsRiskProfileInput,High Risk,Medium Risk,Low Risk',
            
        ], $customMessages);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $savingsRiskProfileInput = $request->input('savingsRiskProfileInput');
        $savingsPotentialReturnInput = $request->input('savingsPotentialReturnInput');

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing savings_needs from the session
        $savings = $customerDetails['savings_needs'] ?? [];

        // Update specific keys with new values
        $savings = array_merge($savings, [
            'riskProfile' => $savingsRiskProfileInput,
            'potentialReturn' => $savingsPotentialReturnInput
        ]);

        // Set the updated savings_needs back to the customer_details session
        $customerDetails['savings_needs'] = $savings;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);
        
        // // Process the form data and perform any necessary actions
        // $formattedArray = "<pre>" . print_r($customerDetails, true) . "</pre>";
        // return ($formattedArray);
        return redirect()->route('savings.gap');
    }

    public function submitSavingsGap(Request $request){

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing savings_needs from the session
        $savings = $customerDetails['savings_needs'] ?? [];

        // Set the updated savings_needs back to the customer_details session
        $customerDetails['savings_needs'] = $savings;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);
        
        // // Process the form data and perform any necessary actions
        
        return redirect()->route('investment.home');
    }

}