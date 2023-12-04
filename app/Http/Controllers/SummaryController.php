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

class SummaryController extends Controller
{
    public function validateSummaryMonthlyGoals(Request $request)
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

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        $formattedArray = "<pre>" . print_r($customerDetails, true) . "</pre>";
        return ($formattedArray);
        // return redirect()->route('summary.expected-income');
    }

}