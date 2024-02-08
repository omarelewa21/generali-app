<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\SessionStorage; 

class HealthMedicalController extends Controller
{
    // protected $need_sequence;

    // public function calculateNeedSequence(Request $request) {

    //     $customerDetails = $request->session()->get('customer_details', []);

    //     // Set the default value for $need_sequence
    //     $need_sequence = 0;

    //     $protectionDiscuss = isset($customerDetails['priorities']['protectionDiscuss']) && ($customerDetails['priorities']['protectionDiscuss'] == true || $customerDetails['priorities']['protectionDiscuss'] == 'true');
    //     $retirementDiscuss = isset($customerDetails['priorities']['retirementDiscuss']) && ($customerDetails['priorities']['retirementDiscuss'] == true || $customerDetails['priorities']['retirementDiscuss'] == 'true');
    //     $educationDiscuss = isset($customerDetails['priorities']['educationDiscuss']) && ($customerDetails['priorities']['educationDiscuss'] == true || $customerDetails['priorities']['educationDiscuss'] == 'true');
    //     $savingsDiscuss = isset($customerDetails['priorities']['savingsDiscuss']) && ($customerDetails['priorities']['savingsDiscuss'] == true || $customerDetails['priorities']['savingsDiscuss'] == 'true');
    //     $investmentsDiscuss = isset($customerDetails['priorities']['investmentsDiscuss']) && ($customerDetails['priorities']['investmentsDiscuss'] == true || $customerDetails['priorities']['investmentsDiscuss'] == 'true');

    //     // Alternatively, you can use a simpler version using the ternary operator:
    //     $need_sequence = (
    //         $protectionDiscuss ? (
    //             $retirementDiscuss ? (
    //                 $educationDiscuss ? (
    //                     $savingsDiscuss ? (
    //                         $investmentsDiscuss ? 6 : 5
    //                     ) : ($investmentsDiscuss ? 5 : 4)
    //                 ) : (
    //                     $savingsDiscuss ? (
    //                         $investmentsDiscuss ? 5 : 4
    //                     ) : ($investmentsDiscuss ? 4 : 3)
    //                 )
    //             ) : (
    //                 $educationDiscuss ? (
    //                     $savingsDiscuss ? (
    //                         $investmentsDiscuss ? 5 : 4
    //                     ) : ($investmentsDiscuss ? 4 : 3)
    //                 ) : (
    //                     $savingsDiscuss ? (
    //                         $investmentsDiscuss ? 4 : 3
    //                     ) : ($investmentsDiscuss ? 3 : 2)
    //                 )
    //             )
    //         ) : (
    //             $retirementDiscuss ? (
    //                 $educationDiscuss ? (
    //                     $savingsDiscuss ? (
    //                         $investmentsDiscuss ? 5 : 4
    //                     ) : ($investmentsDiscuss ? 4 : 3)
    //                 ) : (
    //                     $savingsDiscuss ? (
    //                         $investmentsDiscuss ? 4 : 3
    //                     ) : ($investmentsDiscuss ? 3 : 2)
    //                 )
    //             ) : (
    //                 $educationDiscuss ? (
    //                     $savingsDiscuss ? (
    //                         $investmentsDiscuss ? 4 : 3
    //                     ) : ($investmentsDiscuss ? 3 : 2)
    //                 ) : (
    //                     $savingsDiscuss ? (
    //                         $investmentsDiscuss ? 3 : 2
    //                     ) : ($investmentsDiscuss ? 2 : 1)
    //                 )
    //             )
    //         )
    //     );        

    //     return $need_sequence;
    // }

    public function validateHealthMedicalSelection(Request $request)
    {
        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);
        $selectedNeeds = $customerDetails['selected_needs'] ?? [];

        // Get existing healthMedical_needs from the session
        $needs = $customerDetails['selected_needs']['need_6'] ?? [];
        $advanceDetails = $customerDetails['selected_needs']['need_6']['advance_details'] ?? [];
        $criticalIllness = $customerDetails['selected_needs']['need_6']['advance_details']['critical_illness'] ?? [];
        $medicalPlanning = $customerDetails['selected_needs']['need_6']['advance_details']['health_care'] ?? [];

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
            'selectionHealthMedicalInput' => [
                'at_least_one_selected',
            ],
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $healthMedicalSelectedInput = $request->input('selectionHealthMedicalInput');
        $selectionCriticalInput = $request->input('selectionCriticalInput');
        $selectionMedicalInput = $request->input('selectionMedicalInput');

        $index = array_search('health-medical', $customerDetails['priorities_level'], true);
        if ($customerDetails['priorities']['health-medical'] == true || $customerDetails['priorities']['health-medical'] == 'true'){
            $coverAnswer = 'Yes';
        } else{
            $coverAnswer = 'No';
        }
        if ($customerDetails['priorities']['health-medical_discuss'] == true || $customerDetails['priorities']['health-medical_discuss'] == 'true'){
            $discussAnswer = 'Yes';
        } else{
            $discussAnswer = 'No';
        }
        if ($selectionCriticalInput != null || $selectionCriticalInput != ''){
            $criticalPlan = 'Yes';
        } else{
            $criticalPlan = 'No';
        }
        if ($selectionMedicalInput != null || $selectionMedicalInput != ''){
            $medicalPlan = 'Yes';
        } else{
            $medicalPlan = 'No';
        }

        // Update specific keys with new values
        $needs = array_merge($needs, [
            'need_no' => 'N6',
            'priority' => $index+1,
            'cover' => $coverAnswer,
            'discuss' => $discussAnswer,
            'number_of_selection' => $healthMedicalSelectedInput,
        ]);
        $criticalIllness = array_merge($criticalIllness, [
            'critical_illness_plan' => $criticalPlan
        ]);
        $medicalPlanning = array_merge($medicalPlanning, [
            'medical_care_plan' => $medicalPlan
        ]);

        if ($selectionCriticalInput === '' || $selectionCriticalInput === null ){
            $criticalIllness = array_merge($criticalIllness, [
                'relationship' => '',
                'child_name' => '',
                'child_dob' => '',
                'spouse_name' => '',
                'spouse_dob' => '',
                'covered_amount' => '',
                'year' => '',
                'goals_amount' => '',
                'existing_protection' => '',
                'existing_amount' => '',
                'insurance_amount' => '',
                'fund_percentage' => ''
            ]);
        }
        if ($selectionMedicalInput === '' || $selectionMedicalInput === null){
            $medicalPlanning = array_merge($medicalPlanning, [
                'relationship' => '',
                'child_name' => '',
                'child_dob' => '',
                'spouse_name' => '',
                'spouse_dob' => '',
                'type_of_hospital' => '',
                'room_option' => '',
                'covered_amount' => '',
                'year' => '',
                'goals_amount' => '',
                'existing_protection' => '',
                'existing_amount' => '',
                'insurance_amount' => '',
                'fund_percentage' => ''
            ]);
        }

        // Set the updated health-medical_needs back to the customer_details session
        $customerDetails['selected_needs']['need_6'] = $needs;
        $customerDetails['selected_needs']['need_6']['advance_details']['critical_illness'] = $criticalIllness;
        $customerDetails['selected_needs']['need_6']['advance_details']['health_care'] = $medicalPlanning;

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

        if ($criticalPlan === 'Yes'){
            return redirect()->route('health.medical.critical.illness.coverage');
        }
        else{
            return redirect()->route('health.medical.medical.planning.coverage');
        }
        
    }

    // Critical Illness
    public function validateCriticalIllnessCoverageSelection(Request $request)
    {
        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing healthMedical_needs from the session
        $criticalIllness = $customerDetails['selected_needs']['need_6']['advance_details']['critical_illness'] ?? [];

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

        // Update specific keys with new values
        $criticalIllness = array_merge($criticalIllness, [
            'relationship' => $relationshipInput,
            'child_name' => $selectedInsuredNameInput,
            'child_dob' => $selectedCoverForDobInput,
            'spouse_name' => $othersCoverForNameInput,
            'spouse_dob' => $othersCoverForDobInput
        ]);

        // Set the updated critical_illness back to the customer_details session
        $customerDetails['selected_needs']['need_6']['advance_details']['critical_illness'] = $criticalIllness;

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

        return redirect()->route('health.medical.critical.amount.needed');
    }
    public function validateCriticalIllnessAmountNeeded(Request $request)
    {
        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Set the updated critical_illness back to the customer_details session
        $criticalIllness = $customerDetails['selected_needs']['need_6']['advance_details']['critical_illness'] ?? [];

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
            'covered_amount' => $critical_amount_needed,
            'year' => $supportingYears
        ]);

        if ($totalHealthMedicalNeeded === $healthMedicalTotalFund){

            $criticalIllness = array_merge($criticalIllness, [
                'goals_amount' => $totalHealthMedicalNeeded
            ]);
        }
        else{
            $criticalIllness = array_merge($criticalIllness, [
                'goals_amount' => $healthMedicalTotalFund
            ]);
        }

        // Set the updated critical_illness back to the customer_details session
        $customerDetails['selected_needs']['need_6']['advance_details']['critical_illness'] = $criticalIllness;

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

        // Get existing critical_illness from the session
        $criticalIllness = $customerDetails['selected_needs']['need_6']['advance_details']['critical_illness'] ?? [];

        // Validation passed, perform any necessary processing.
        $existing_protection_amount = str_replace(',','',$request->input('existing_protection_amount'));
        $critical_existing_protection = $request->input('critical_existing_protection');
        $newTotalAmountNeeded = floatval($customerDetails['selected_needs']['need_6']['advance_details']['critical_illness']['goals_amount'] - $existing_protection_amount);
        $totalAmountNeeded = floatval($request->input('total_amountNeeded'));
        $totalPercentage = floatval($request->input('percentage'));
        $newPercentage = floatval($existing_protection_amount / $customerDetails['selected_needs']['need_6']['advance_details']['critical_illness']['goals_amount'] * 100);

        // Update specific keys with new values
        $criticalIllness = array_merge($criticalIllness, [
            'existing_protection' => $critical_existing_protection,
            'existing_amount' => $existing_protection_amount
        ]);

        if ($newTotalAmountNeeded === $totalAmountNeeded && $newPercentage === $totalPercentage){
            if ($newTotalAmountNeeded <= 0){
                $criticalIllness = array_merge($criticalIllness, [
                    'insurance_amount' => '0',
                    'fund_percentage' => '100'
                ]);
            }
            else{
                $criticalIllness = array_merge($criticalIllness, [
                    'insurance_amount' => $totalAmountNeeded,
                    'fund_percentage' => $totalPercentage
                ]);
            }
        }
        else{
            if ($newTotalAmountNeeded <= 0){
                $criticalIllness = array_merge($criticalIllness, [
                    'insurance_amount' => '0',
                    'fund_percentage' => '100'
                ]);
            }
            else{
                $criticalIllness = array_merge($criticalIllness, [
                    'insurance_amount' => $newTotalAmountNeeded,
                    'fund_percentage' => $newPercentage
                ]);
            }
        }

        // Set the updated critical_illness back to the customer_details session
        $customerDetails['selected_needs']['need_6']['advance_details']['critical_illness'] = $criticalIllness;

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
        return redirect()->route('health.medical.critical.gap');
    }

    public function submitCriticalIllnessGap(Request $request){

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing healthMedical_needs from the session
        $criticalIllness = $customerDetails['selected_needs']['need_6']['advance_details']['critical_illness'] ?? [];

        // Get existing critical_illness from the session
        $customerDetails['selected_needs']['need_6']['advance_details']['critical_illness'] = $criticalIllness;

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
        if ($customerDetails['selected_needs']['need_6']['advance_details']['health_care']['medical_care_plan'] === 'Yes'){
            return redirect()->route('health.medical.medical.planning.coverage');
        } else{
            return redirect()->route('debt.cancellation.home');
        }
    }


    //Medical Planning
    public function validateMedicalPlanningCoverageSelection(Request $request)
    {
        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing healthMedical_needs from the session
        $medicalPlanning = $customerDetails['selected_needs']['need_6']['advance_details']['health_care'] ?? [];

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

        // Update specific keys with new values
        $medicalPlanning = array_merge($medicalPlanning, [
            'relationship' => $relationshipInput,
            'child_name' => $selectedInsuredNameInput,
            'child_dob' => $selectedCoverForDobInput,
            'spouse_name' => $othersCoverForNameInput,
            'spouse_dob' => $othersCoverForDobInput
        ]);

        // Set the updated medical_planning back to the customer_details session
        $customerDetails['selected_needs']['need_6']['advance_details']['health_care'] = $medicalPlanning;

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

        return redirect()->route('health.medical.planning.hospital.selection');
    }

    public function validateMedicalPlanningHospitalSelection(Request $request)
    {
        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing medical_planning from the session
        $medicalPlanning = $customerDetails['selected_needs']['need_6']['advance_details']['health_care'] ?? [];

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
            'type_of_hospital' => $medicalHospitalSelectedInput
        ]);

        // Set the updated medical_planning back to the customer_details session
        $customerDetails['selected_needs']['need_6']['advance_details']['health_care'] = $medicalPlanning;

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

        return redirect()->route('health.medical.planning.room.selection');
    }

    public function validateMedicalPlanningRoomSelection(Request $request)
    {
        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing medical_planning from the session
        $medicalPlanning = $customerDetails['selected_needs']['need_6']['advance_details']['health_care'] ?? [];

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
            'room_option' => $roomTypeInput
        ]);

        // Set the updated medical_planning back to the customer_details session
        $customerDetails['selected_needs']['need_6']['advance_details']['health_care'] = $medicalPlanning;

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

        return redirect()->route('health.medical.planning.amount.needed');
    }

    public function validateMedicalPlanningAmountNeeded(Request $request)
    {
        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing medical_planning from the session
        $medicalPlanning = $customerDetails['selected_needs']['need_6']['advance_details']['health_care'] ?? [];

        $customMessages = [
            'medical_amount_needed.required' => 'You are required to enter an amount.',
            'medical_amount_needed.regex' => 'You must enter number',
        ];

        $validatedData = Validator::make($request->all(), [
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
        $healthMedicalTotalFund = floatval($medical_amount_needed * $supportingYears);
        $totalHealthMedicalNeeded = floatval($request->input('total_healthMedicalNeeded'));

        // Update specific keys with new values
        $medicalPlanning = array_merge($medicalPlanning, [
            'covered_amount' => $medical_amount_needed,
        ]);

        if ($totalHealthMedicalNeeded === $healthMedicalTotalFund){

            $medicalPlanning = array_merge($medicalPlanning, [
                'goals_amount' => $totalHealthMedicalNeeded
            ]);
        }
        else{
            $medicalPlanning = array_merge($medicalPlanning, [
                'goals_amount' => $healthMedicalTotalFund
            ]);
        }

        // Set the updated medical_planning back to the customer_details session
        $customerDetails['selected_needs']['need_6']['advance_details']['health_care'] = $medicalPlanning;

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

        // Get existing medical_planning from the session
        $medicalPlanning = $customerDetails['selected_needs']['need_6']['advance_details']['health_care'] ?? [];

        // Validation passed, perform any necessary processing.
        $existing_protection_amount = str_replace(',','',$request->input('existing_protection_amount'));
        $medical_existing_protection = $request->input('medical_existing_protection');
        $newTotalAmountNeeded = floatval($customerDetails['selected_needs']['need_6']['advance_details']['health_care']['goals_amount'] - $existing_protection_amount);
        $totalAmountNeeded = floatval($request->input('total_amountNeeded'));
        $totalPercentage = floatval($request->input('percentage'));
        $newPercentage = floatval($existing_protection_amount / $customerDetails['selected_needs']['need_6']['advance_details']['health_care']['goals_amount'] * 100);

        // Update specific keys with new values
        $medicalPlanning = array_merge($medicalPlanning, [
            'existing_protection' => $medical_existing_protection,
            'existing_amount' => $existing_protection_amount
        ]);

        if ($newTotalAmountNeeded === $totalAmountNeeded && $newPercentage === $totalPercentage){
            if ($newTotalAmountNeeded <= 0){
                $medicalPlanning = array_merge($medicalPlanning, [
                    'insurance_amount' => '0',
                    'fund_percentage' => '100'
                ]);
            }
            else{
                $medicalPlanning = array_merge($medicalPlanning, [
                    'insurance_amount' => $totalAmountNeeded,
                    'fund_percentage' => $totalPercentage
                ]);
            }
        }
        else{
            if ($newTotalAmountNeeded <= 0){
                $medicalPlanning = array_merge($medicalPlanning, [
                    'insurance_amount' => '0',
                    'fund_percentage' => '100'
                ]);
            }
            else{
                $medicalPlanning = array_merge($medicalPlanning, [
                    'insurance_amount' => $newTotalAmountNeeded,
                    'fund_percentage' => $newPercentage
                ]);
            }
        }

        // Set the updated medicalPlanning back to the customer_details session
        $customerDetails['selected_needs']['need_6']['advance_details']['health_care'] = $medicalPlanning;

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
        return redirect()->route('health.medical.planning.gap');
    }

    public function submitMedicalPlanningGap(Request $request){

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing medical_planning from the session
        $medicalPlanning = $customerDetails['selected_needs']['need_6']['advance_details']['health_care'] ?? [];

        // Set the updated medical_planning back to the customer_details session
        $customerDetails['selected_needs']['need_6']['advance_details']['health_care'] = $medicalPlanning;

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
        if (isset($customerDetails['priorities']['debt-cancellation_discuss']) && ($customerDetails['priorities']['debt-cancellation_discuss'] === 'true' || $customerDetails['priorities']['debt-cancellation_discuss'] === true)) {
            return redirect()->route('debt.cancellation.home');
        }
        else {
            return redirect()->route('existing.policy');
        }
    }
}