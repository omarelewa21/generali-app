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

class HealthMedicalController extends Controller
{
    public function validateHealthMedicalSelection(Request $request)
    {
        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing healthMedical_needs from the session
        $healthMedical = $customerDetails['health-medical_needs'] ?? [];

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
            'healthMedicalSelectedInput' => [
                'at_least_one_selected',
            ],
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $healthMedicalSelectedInput = $request->input('healthMedicalSelectedInput');

        // Update specific keys with new values
        $healthMedical = array_merge($healthMedical, [
            'coverageSelection' => $healthMedicalSelectedInput
        ]);

        // Set the updated health-medical_needs back to the customer_details session
        $customerDetails['health-medical_needs'] = $healthMedical;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);
    
        return redirect()->route('health.medical.'.str_replace(' ', '.', $healthMedicalSelectedInput).'.coverage');
    }

    // Critical Illness
    public function validateCriticalIllnessCoverageSelection(Request $request)
    {
        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing healthMedical_needs from the session
        $healthMedical = $customerDetails['health-medical_needs'] ?? [];

        // Get existing critical_illness from the session
        $criticalIllness = $customerDetails['health-medical_needs']['critical_illness'] ?? [];

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
            'criticalIllnessSelectedInput' => [
                'at_least_one_selected',
            ],
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $criticalIllnessSelectedInput = $request->input('criticalIllnessSelectedInput');

        // Update specific keys with new values
        $criticalIllness = array_merge($criticalIllness, [
            'coveragePerson' => $criticalIllnessSelectedInput
        ]);

        // Set the updated critical_illness back to the customer_details session
        $customerDetails['health-medical_needs']['critical_illness'] = $criticalIllness;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);
    
        return redirect()->route('health.medical.critical.amount.needed');
    }
    public function validateCriticalIllnessAmountNeeded(Request $request)
    {
        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing healthMedical_needs from the session
        $healthMedical = $customerDetails['health-medical_needs'] ?? [];

        // Set the updated critical_illness back to the customer_details session
        $criticalIllness = $customerDetails['health-medical_needs']['critical_illness'] ?? [];

        $customMessages = [
            'critical_amount_needed.required' => 'You are required to enter an amount.',
            'critical_amount_needed.regex' => 'You must enter number',
            'critical_year.required' => 'You are required to enter a year.',
            'critical_year.integer' => 'The year must be a number.',
            'critical_year.min' => 'The year must be at least :min.',
            'critical_year.max' => 'The year must not more than :max.',
        ];

        $validatedData = Validator::make($request->all(), [
            'critical_year' => 'required|integer|min:1|max:99',
            'critical_amount_needed' => [
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
                        $fail('Your amount must not more than RM' .number_format(floatval($max)). 'per annual.');
                    }
                },
            ],
        ], $customMessages);
        
        
        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $critical_amount_needed = str_replace(',','',$request->input('critical_amount_needed'));
        $supportingYears = $request->input('critical_year');
        $healthMedicalTotalFund = floatval($critical_amount_needed * 12 * $supportingYears);
        $totalHealthMedicalNeeded = floatval($request->input('total_healthMedicalNeeded'));

        // Update specific keys with new values
        $criticalIllness = array_merge($criticalIllness, [
            'neededAmount' => $critical_amount_needed,
            'year' => $supportingYears
        ]);

        if ($totalHealthMedicalNeeded === $healthMedicalTotalFund){

            $criticalIllness = array_merge($criticalIllness, [
                'totalHealthMedicalNeeded' => $totalHealthMedicalNeeded
            ]);
        }
        else{
            $criticalIllness = array_merge($criticalIllness, [
                'totalHealthMedicalNeeded' => $healthMedicalTotalFund
            ]);
        }

        // Set the updated critical_illness back to the customer_details session
        $customerDetails['health-medical_needs']['critical_illness'] = $criticalIllness;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);
    
        // $formattedArray = "<pre>" . print_r($customerDetails, true) . "</pre>";
        // return ($formattedArray);
        return redirect()->route('health.medical.critical.existing.protection');
    }

    public function validateCriticalIllnessExistingProtection(Request $request){

        $customMessages = [
            'critical_existing_protection.required' => 'Please select an option',
            'existing_protection_amount.required_if' => 'You are required to enter an amount.',
            'existing_protection_amount.regex' => 'The amount must be a number',
        ];

        $validatedData = Validator::make($request->all(), [
            'critical_existing_protection' => 'required|in:yes,no',
            'existing_protection_amount' => [
                'nullable',
                'regex:/^[0-9,]+$/',
                'required_if:critical_existing_protection,yes',
                function ($attribute, $value, $fail) use ($request) {
                    // Remove commas and check if the value is at least 1
                    $numericValue = str_replace(',', '', $value);
                    $min = 1;
                    $max = 20000000;
                    if (intval($numericValue) < $min && $request->input('critical_existing_protection') === 'yes') {
                        $fail('Your amount must be at least ' .$min. '.');
                    }
                    if (intval($numericValue) > $max && $request->input('critical_existing_protection') === 'yes') {
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

        // Get existing healthMedical_needs from the session
        $healthMedical = $customerDetails['health-medical_needs'] ?? [];

        // Get existing critical_illness from the session
        $criticalIllness = $customerDetails['health-medical_needs']['critical_illness'] ?? [];

        // Validation passed, perform any necessary processing.
        $existing_protection_amount = str_replace(',','',$request->input('existing_protection_amount'));
        $critical_existing_protection = $request->input('critical_existing_protection');
        $newTotalAmountNeeded = floatval($customerDetails['health-medical_needs']['critical_illness']['totalHealthMedicalNeeded'] - $existing_protection_amount);
        $totalAmountNeeded = floatval($request->input('total_amountNeeded'));
        $totalPercentage = floatval($request->input('percentage'));
        $newPercentage = floatval($existing_protection_amount / $customerDetails['health-medical_needs']['critical_illness']['totalHealthMedicalNeeded'] * 100);

        // Update specific keys with new values
        $criticalIllness = array_merge($criticalIllness, [
            'existingProtection' => $critical_existing_protection,
            'existingProtectionAmount' => $existing_protection_amount
        ]);

        if ($newTotalAmountNeeded === $totalAmountNeeded && $newPercentage === $totalPercentage){
            if ($newTotalAmountNeeded <= 0){
                $criticalIllness = array_merge($criticalIllness, [
                    'totalAmountNeeded' => '0',
                    'fundPercentage' => '100'
                ]);
            }
            else{
                $criticalIllness = array_merge($criticalIllness, [
                    'totalAmountNeeded' => $totalAmountNeeded,
                    'fundPercentage' => $totalPercentage
                ]);
            }
        }
        else{
            if ($newTotalAmountNeeded <= 0){
                $criticalIllness = array_merge($criticalIllness, [
                    'totalAmountNeeded' => '0',
                    'fundPercentage' => '100'
                ]);
            }
            else{
                $criticalIllness = array_merge($criticalIllness, [
                    'totalAmountNeeded' => $newTotalAmountNeeded,
                    'fundPercentage' => $newPercentage
                ]);
            }
        }

        // Set the updated critical_illness back to the customer_details session
        $customerDetails['health-medical_needs']['critical_illness'] = $criticalIllness;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        // // Process the form data and perform any necessary actions
        return redirect()->route('health.medical.critical.gap');
    }

    public function submitCriticalIllnessGap(Request $request){

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing healthMedical_needs from the session
        $healthMedical = $customerDetails['health-medical_needs'] ?? [];

        // Get existing critical_illness from the session
        $criticalIllness = $customerDetails['health-medical_needs']['critical_illness'] ?? [];

        // Set the updated critical_illness back to the customer_details session
        $customerDetails['health-medical_needs']['critical_illness'] = $criticalIllness;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        // // Process the form data and perform any necessary actions
        return redirect()->route('debt.cancellation.home');
    }


    //Medical Planning
    public function validateMedicalPlanningCoverageSelection(Request $request)
    {
        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing healthMedical_needs from the session
        $healthMedical = $customerDetails['health-medical_needs'] ?? [];

        // Get existing medical_planning from the session
        $medicalPlanning = $customerDetails['health-medical_needs']['medical_planning'] ?? [];

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
            'medicalPlanningSelectedInput' => [
                'at_least_one_selected',
            ],
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $medicalPlanningSelectedInput = $request->input('medicalPlanningSelectedInput');

        // Update specific keys with new values
        $medicalPlanning = array_merge($medicalPlanning, [
            'coveragePerson' => $medicalPlanningSelectedInput
        ]);

        // Set the updated medical_planning back to the customer_details session
        $customerDetails['health-medical_needs']['medical_planning'] = $medicalPlanning;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);
    
        return redirect()->route('health.medical.planning.hospital.selection');
    }

    public function validateMedicalPlanningHospitalSelection(Request $request)
    {
        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing healthMedical_needs from the session
        $healthMedical = $customerDetails['health-medical_needs'] ?? [];

        // Get existing medical_planning from the session
        $medicalPlanning = $customerDetails['health-medical_needs']['medical_planning'] ?? [];

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
            'medicalHospitalSelectedInput' => [
                'at_least_one_selected',
            ],
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $medicalHospitalSelectedInput = $request->input('medicalHospitalSelectedInput');

        // Update specific keys with new values
        $medicalPlanning = array_merge($medicalPlanning, [
            'typeOfHospital' => $medicalHospitalSelectedInput
        ]);

        // Set the updated medical_planning back to the customer_details session
        $customerDetails['health-medical_needs']['medical_planning'] = $medicalPlanning;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        return redirect()->route('health.medical.planning.room.selection');
    }

    public function validateMedicalPlanningRoomSelection(Request $request)
    {
        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing healthMedical_needs from the session
        $healthMedical = $customerDetails['health-medical_needs'] ?? [];

        // Get existing medical_planning from the session
        $medicalPlanning = $customerDetails['health-medical_needs']['medical_planning'] ?? [];

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
            'roomTypeInput' => [
                'at_least_one_selected',
            ],
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $roomTypeInput = $request->input('roomTypeInput');

        // Update specific keys with new values
        $medicalPlanning = array_merge($medicalPlanning, [
            'roomOption' => $roomTypeInput
        ]);

        // Set the updated medical_planning back to the customer_details session
        $customerDetails['health-medical_needs']['medical_planning'] = $medicalPlanning;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);
        // $formattedArray = "<pre>" . print_r($customerDetails, true) . "</pre>";
        // return ($formattedArray);
        return redirect()->route('health.medical.planning.amount.needed');
    }

    public function validateMedicalPlanningAmountNeeded(Request $request)
    {
        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing healthMedical_needs from the session
        $healthMedical = $customerDetails['health-medical_needs'] ?? [];

        // Get existing medical_planning from the session
        $medicalPlanning = $customerDetails['health-medical_needs']['medical_planning'] ?? [];

        $customMessages = [
            'medical_amount_needed.required' => 'You are required to enter an amount.',
            'medical_amount_needed.regex' => 'You must enter number',
            'medical_year.required' => 'You are required to enter a year.',
            'medical_year.integer' => 'The year must be a number.',
            'medical_year.min' => 'The year must be at least :min.',
            'medical_year.max' => 'The year must not more than :max.',
        ];

        $validatedData = Validator::make($request->all(), [
            'medical_year' => 'required|integer|min:1|max:99',
            'medical_amount_needed' => [
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
                        $fail('Your amount must not more than RM' .number_format(floatval($max)). 'per annual.');
                    }
                },
            ],
        ], $customMessages);
        
        
        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $medical_amount_needed = str_replace(',','',$request->input('medical_amount_needed'));
        $supportingYears = $request->input('medical_year');
        $healthMedicalTotalFund = floatval($medical_amount_needed * 12 * $supportingYears);
        $totalHealthMedicalNeeded = floatval($request->input('total_healthMedicalNeeded'));

        // Update specific keys with new values
        $medicalPlanning = array_merge($medicalPlanning, [
            'neededAmount' => $medical_amount_needed,
            'year' => $supportingYears
        ]);

        if ($totalHealthMedicalNeeded === $healthMedicalTotalFund){

            $medicalPlanning = array_merge($medicalPlanning, [
                'totalHealthMedicalNeeded' => $totalHealthMedicalNeeded
            ]);
        }
        else{
            $medicalPlanning = array_merge($medicalPlanning, [
                'totalHealthMedicalNeeded' => $healthMedicalTotalFund
            ]);
        }

        // Set the updated medical_planning back to the customer_details session
        $customerDetails['health-medical_needs']['medical_planning'] = $medicalPlanning;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        return redirect()->route('health.medical.planning.existing.protection');
    }

    public function validateMedicalPlanningExistingProtection(Request $request){

        $customMessages = [
            'medical_existing_protection.required' => 'Please select an option',
            'existing_protection_amount.required_if' => 'You are required to enter an amount.',
            'existing_protection_amount.regex' => 'The amount must be a number',
        ];

        $validatedData = Validator::make($request->all(), [
            'medical_existing_protection' => 'required|in:yes,no',
            'existing_protection_amount' => [
                'nullable',
                'regex:/^[0-9,]+$/',
                'required_if:medical_existing_protection,yes',
                function ($attribute, $value, $fail) use ($request) {
                    // Remove commas and check if the value is at least 1
                    $numericValue = str_replace(',', '', $value);
                    $min = 1;
                    $max = 20000000;
                    if (intval($numericValue) < $min && $request->input('medical_existing_protection') === 'yes') {
                        $fail('Your amount must be at least ' .$min. '.');
                    }
                    if (intval($numericValue) > $max && $request->input('medical_existing_protection') === 'yes') {
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

        // Get existing healthMedical_needs from the session
        $healthMedical = $customerDetails['health-medical_needs'] ?? [];

        // Get existing medical_planning from the session
        $medicalPlanning = $customerDetails['health-medical_needs']['medical_planning'] ?? [];

        // Validation passed, perform any necessary processing.
        $existing_protection_amount = str_replace(',','',$request->input('existing_protection_amount'));
        $medical_existing_protection = $request->input('medical_existing_protection');
        $newTotalAmountNeeded = floatval($customerDetails['health-medical_needs']['medical_planning']['totalHealthMedicalNeeded'] - $existing_protection_amount);
        $totalAmountNeeded = floatval($request->input('total_amountNeeded'));
        $totalPercentage = floatval($request->input('percentage'));
        $newPercentage = floatval($existing_protection_amount / $customerDetails['health-medical_needs']['medical_planning']['totalHealthMedicalNeeded'] * 100);

        // Update specific keys with new values
        $medicalPlanning = array_merge($medicalPlanning, [
            'existingProtection' => $medical_existing_protection,
            'existingProtectionAmount' => $existing_protection_amount
        ]);

        if ($newTotalAmountNeeded === $totalAmountNeeded && $newPercentage === $totalPercentage){
            if ($newTotalAmountNeeded <= 0){
                $medicalPlanning = array_merge($medicalPlanning, [
                    'totalAmountNeeded' => '0',
                    'fundPercentage' => '100'
                ]);
            }
            else{
                $medicalPlanning = array_merge($medicalPlanning, [
                    'totalAmountNeeded' => $totalAmountNeeded,
                    'fundPercentage' => $totalPercentage
                ]);
            }
        }
        else{
            if ($newTotalAmountNeeded <= 0){
                $medicalPlanning = array_merge($medicalPlanning, [
                    'totalAmountNeeded' => '0',
                    'fundPercentage' => '100'
                ]);
            }
            else{
                $medicalPlanning = array_merge($medicalPlanning, [
                    'totalAmountNeeded' => $newTotalAmountNeeded,
                    'fundPercentage' => $newPercentage
                ]);
            }
        }

        // Set the updated medicalPlanning back to the customer_details session
        $customerDetails['health-medical_needs']['medical_planning'] = $medicalPlanning;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        // // Process the form data and perform any necessary actions
        return redirect()->route('health.medical.planning.gap');
    }

    public function submitMedicalPlanningGap(Request $request){

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing healthMedical_needs from the session
        $healthMedical = $customerDetails['health-medical_needs'] ?? [];

        // Get existing medical_planning from the session
        $medicalPlanning = $customerDetails['health-medical_needs']['medical_planning'] ?? [];

        // Set the updated medical_planning back to the customer_details session
        $customerDetails['health-medical_needs']['medical_planning'] = $medicalPlanning;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        // // Process the form data and perform any necessary actions
        return redirect()->route('debt.cancellation.home');
    }
}