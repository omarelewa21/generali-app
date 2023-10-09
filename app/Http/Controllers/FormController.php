<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AvatarSelectionRequest;
use Illuminate\Support\Facades\Response;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;

class FormController extends Controller {
    public function pdpa(Request $request)
    {
        $decision = $request->input('decision');

        // Get the existing array from the session
        $arrayData = session('customer_details', []);

        // Add or update the data value in the array
        $arrayData['pdpa'] = $decision;

        // Store the updated array back into the session
        session(['customer_details' => $arrayData]);        
        
        return response()->json(['message' => 'Button click saved successfully']);
    }

    public function basicDetails(Request $request)
    {
        // Fetch titles from the database
        $titles = DB::table('titles')->pluck('titles')->toArray();
        $code = DB::table('countries')->pluck('phone_code')->toArray();
    
        $validatedData = $request->validate([
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'title' => 'required|in:' . implode(',', $titles),
            'phoneCodeMobile' => 'required|in:' . implode(',', $code),
            'mobileNumber' => 'required|regex:/^[1-9]\d{8,9}$/',
            'phoneCodeHouse' => 'required|in:' . implode(',', $code),
            'housePhoneNumber' => 'nullable|regex:/^[1-9]\d{8,9}$/',
            'email' => 'required|email:rfc,dns|max:255',
        ]);

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Add the new array inside the customer_details array
        $customerDetails['basic_details'] = [
            'title' => $validatedData['title'],
            'first_name' => $validatedData['firstName'],
            'last_name' => $validatedData['lastName'],
            'phone_code_mobile' => $validatedData['phoneCodeMobile'],
            'mobile_number' => $validatedData['mobileNumber'],
            'phone_code_house' => $validatedData['phoneCodeHouse'],
            'house_phone_number' => $validatedData['housePhoneNumber'],
            'email' => $validatedData['email']
        ];

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        
        // Process the form data and perform any necessary actions
        return redirect()->route('avatar.welcome');
    }

    public function submitIdentity(Request $request)
    {
        // Fetch titles from the database
        $countries = DB::table('countries')->pluck('countries')->toArray();
        $idtypes = DB::table('idtypes')->pluck('idtypes')->toArray();
        $educationLevel = DB::table('education_levels')->pluck('level')->toArray();
        $occupation = DB::table('occupations')->pluck('name')->toArray();

        $customMessages = [
            'idNumber.regex' => 'The id number field must match the format 123456-78-9012.',
            'passportNumber.max' => 'The passport number field must not exceed :max characters.',
            'birthCert.max' => 'The birth certificate field must not exceed :max characters.',
            'policeNumber.max' => 'The police number field must not exceed :max characters.',
            'registrationNumber.max' => 'The registration number field must not exceed :max characters.',
            'btnradio.required' => 'Please select your habits.',
        ];

        $validatedData = $request->validate([
            'country' => 'required|in:' . implode(',', $countries),
            'idType' => 'required|in:' . implode(',', $idtypes),
            'idNumber' => [
                'nullable',
                Rule::requiredIf(function () use ($request) {
                    return !$request->input('passportNumber') && !$request->input('birthCert') && !$request->input('policeNumber') && !$request->input('registrationNumber');
                }),
                'regex:/^\d{6}-\d{2}-\d{4}$/',
            ],
            'passportNumber' => [
                'nullable',
                Rule::requiredIf(function () use ($request) {
                    return !$request->input('idNumber') && !$request->input('birthCert') && !$request->input('policeNumber') && !$request->input('registrationNumber');
                }),
                'max:15',
            ],
            'birthCert' => [
                'nullable',
                Rule::requiredIf(function () use ($request) {
                    return !$request->input('idNumber') && !$request->input('passportNumber') && !$request->input('policeNumber') && !$request->input('registrationNumber');
                }),
                'max:15',
            ],
            'policeNumber' => [
                'nullable',
                Rule::requiredIf(function () use ($request) {
                    return !$request->input('idNumber') && !$request->input('passportNumber') && !$request->input('birthCert') && !$request->input('registrationNumber');
                }),
                'max:15',
            ],
            'registrationNumber' => [
                'nullable',
                Rule::requiredIf(function () use ($request) {
                    return !$request->input('idNumber') && !$request->input('passportNumber') && !$request->input('birthCert') && !$request->input('policeNumber');
                }),
                'max:15',
            ],
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
            'btnradio' => 'required|in:smoker,nonSmoker',
            'educationLevel' => 'required|in:' . implode(',', $educationLevel),
            'occupation' => 'required|in:' . implode(',', $occupation),
        ], $customMessages);

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // Get existing identity_details from the session
        $identityDetails = $customerDetails['identity_details'] ?? [];

        // Update specific keys with new values
        $identityDetails = array_merge($identityDetails, [
            'country' => $validatedData['country'],
            'id_type' => $validatedData['idType'],
            'id_number' => $validatedData['idNumber'],
            'passport_number' => $validatedData['passportNumber'],
            'birth_cert' => $validatedData['birthCert'],
            'police_number' => $validatedData['policeNumber'],
            'registration_number' => $validatedData['registrationNumber'],
            'dob_day' => $validatedData['day'],
            'dob_month' => $validatedData['month'],
            'dob_year' => $validatedData['year'],
            'habits' => $validatedData['btnradio'],
            'education_level' => $validatedData['educationLevel'],
            'occupation' => $validatedData['occupation']
        ]);

        // Set the updated identity_details back to the customer_details session
        $customerDetails['identity_details'] = $identityDetails;

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);

        // Process the form data and perform any necessary actions
        return redirect()->route('avatar.marital.status');
    }

    public function handleAvatarSelection(Request $request)
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

        Validator::extend('at_least_one_selected_family', function ($attribute, $value, $fail, $validator) {

            $decodedValue = json_decode($value, true);

            if ((isset($decodedValue['spouse']) && $decodedValue['spouse'] === true) || (isset($decodedValue['children']) && $decodedValue['children'] === true) || (isset($decodedValue['parents']) && $decodedValue['parents'] === true)) {
                return true;
            }
        
            // If any of the conditions are not met, add a different error message
            $customMessage = "Please select at least one.";
            $validator->errors()->add($attribute, $customMessage);
        
            return false;
        });    
        
        $validator = Validator::make($request->all(), [
            'maritalStatusButtonInput' => [
                'at_least_one_selected',
            ],
            'familyDependantButtonInput' => [
                'at_least_one_selected_family',
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $maritalStatusButtonInput = $request->input('maritalStatusButtonInput');
        $familyDependantSerialized = $request->input('familyDependantButtonInput');
        $familyDependantButtonInput = json_decode($familyDependantSerialized, true);
        $assetsSerialized = $request->input('assetsButtonInput');
        $assetsButtonInput = json_decode($assetsSerialized, true);
        $dataUrl = $request->input('urlInput');

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);
        
        // Add or update the data value in the array
        if ($maritalStatusButtonInput) {
            $newData = [
                'marital_status' => $maritalStatusButtonInput
            ];

            $customerDetails['identity_details'] = array_merge($customerDetails['identity_details'], $newData);
        }
        elseif ($familyDependantButtonInput) {
            $customerDetails['family_details'] = [
                'dependant' => $familyDependantButtonInput
            ];
        }
        elseif ($assetsButtonInput) {
            $customerDetails['assets'] = $assetsButtonInput;
        }

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        
        // Store the updated array back into the session
        return redirect()->route($dataUrl);
    }

    public function familyDependantDetails(Request $request)
    {
        // Fetch spouseMaritalStatus from the database
        $maritalStatus = DB::table('marital_statuses')->pluck('maritalStatus')->toArray();
        $titles = DB::table('titles')->pluck('titles')->toArray();
        $countries = DB::table('countries')->pluck('countries')->toArray();
        $idtypes = DB::table('idtypes')->pluck('idtypes')->toArray();
        $occupation = DB::table('occupations')->pluck('name')->toArray();

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []); 
        
        // Define the common validation rules for spouse
        $commonRules = [
            'spouseTitle' => 'required|in:' . implode(',', $titles),
            'spouseFirstName' => 'required|max:255',
            'spouseLastName' => 'required|max:255',
            'spouseCountry' => 'required|in:' . implode(',', $countries),
            'spouseIdType' => 'required|in:' . implode(',', $idtypes),
            'spouseIdNumber' => [
                'nullable',
                Rule::requiredIf(function () use ($request) {
                    return !$request->input('spousePassportNumber') && !$request->input('spouseBirthCert') && !$request->input('spousePoliceNumber') && !$request->input('spouseRegistrationNumber');
                }),
                'regex:/^\d{6}-\d{2}-\d{4}$/',
            ],
            'spousePassportNumber' => [
                'nullable',
                Rule::requiredIf(function () use ($request) {
                    return !$request->input('spouseIdNumber') && !$request->input('spouseBirthCert') && !$request->input('spousePoliceNumber') && !$request->input('spouseRegistrationNumber');
                }),
                'max:15',
            ],
            'spouseBirthCert' => [
                'nullable',
                Rule::requiredIf(function () use ($request) {
                    return !$request->input('spouseIdNumber') && !$request->input('spousePassportNumber') && !$request->input('spousePoliceNumber') && !$request->input('spouseRegistrationNumber');
                }),
                'max:15',
            ],
            'spousePoliceNumber' => [
                'nullable',
                Rule::requiredIf(function () use ($request) {
                    return !$request->input('spouseIdNumber') && !$request->input('spousePassportNumber') && !$request->input('spouseBirthCert') && !$request->input('spouseRegistrationNumber');
                }),
                'max:15',
            ],
            'spouseRegistrationNumber' => [
                'nullable',
                Rule::requiredIf(function () use ($request) {
                    return !$request->input('spouseIdNumber') && !$request->input('spousePassportNumber') && !$request->input('spouseBirthCert') && !$request->input('spousePoliceNumber');
                }),
                'max:15',
            ],
            'genderBtnradio' => 'required|in:male,female',
            'smokingBtnradio' => 'required|in:smoker,nonSmoker',
            'spouseday' => 'required',
            'spousemonth' => 'required',
            'spouseyear' => 'required',
            'spouseOccupation' => 'required|in:' . implode(',', $occupation),
        ];

        if (isset($customerDetails['family_details']['dependant']['children']) && $customerDetails['family_details']['dependant']['children'] === true) {
            foreach ($customerDetails['family_details']['dependant']['children_data'] as $childKey => $value) {
                $commonRulesChild[$childKey . 'FirstName'] = 'required|max:255';
                $commonRulesChild[$childKey . 'LastName'] = 'required|max:255';
                $commonRulesChild[$childKey . 'GenderBtnradio'] = 'required|in:male,female';
                $commonRulesChild[$childKey . 'YearsOfSupport'] = 'required|numeric|max:100';
                $commonRulesChild[$childKey . 'day'] = 'required';
                $commonRulesChild[$childKey . 'month'] = 'required';
                $commonRulesChild[$childKey . 'year'] = 'required';
                $commonRulesChild[$childKey . 'MaritalStatus'] = 'required|in:' . implode(',', $maritalStatus);
            }
        }

        if (isset($customerDetails['family_details']['dependant']['parents']) && $customerDetails['family_details']['dependant']['parents'] === true) {
            foreach ($customerDetails['family_details']['dependant']['parents_data'] as $parentkey => $value) {
                $commonRulesParents[$parentkey . 'FirstName'] = 'required|max:255';
                $commonRulesParents[$parentkey . 'LastName'] = 'required|max:255';
                $commonRulesParents[$parentkey . 'GenderBtnradio'] = 'required|in:male,female';
                $commonRulesParents[$parentkey . 'YearsOfSupport'] = 'required|numeric|max:100';
                $commonRulesParents[$parentkey . 'day'] = 'required';
                $commonRulesParents[$parentkey . 'month'] = 'required';
                $commonRulesParents[$parentkey . 'year'] = 'required';
                $commonRulesParents[$parentkey . 'MaritalStatus'] = 'required|in:' . implode(',', $maritalStatus);
            }
        }
        
        if (isset ($customerDetails['family_details']['dependant']['spouse']) && $customerDetails['family_details']['dependant']['spouse'] === true) {
            $validatedData = $request->validate($commonRules);

            $newData = [
                'title' => $validatedData['spouseTitle'],
                'first_name' => $validatedData['spouseFirstName'],
                'last_name' => $validatedData['spouseLastName'],
                'country' => $validatedData['spouseCountry'],
                'id_type' => $validatedData['spouseIdType'],
                'id_number' => $validatedData['spouseIdNumber'],
                'passport_number' => $validatedData['spousePassportNumber'],
                'birth_cert' => $validatedData['spouseBirthCert'],
                'police_number' => $validatedData['spousePoliceNumber'],
                'registration_number' => $validatedData['spouseRegistrationNumber'],
                'gender' => $validatedData['genderBtnradio'],
                'habits' => $validatedData['smokingBtnradio'],
                'day' => $validatedData['spouseday'],
                'month' => $validatedData['spousemonth'],
                'year' => $validatedData['spouseyear'],
                'occupation' => $validatedData['spouseOccupation']
            ];
            $customerDetails['family_details']['dependant']['spouse_data'] = array_merge($customerDetails['family_details']['dependant']['spouse_data'], $newData);
        }
        
        if (isset ($customerDetails['family_details']['dependant']['children']) && $customerDetails['family_details']['dependant']['children'] === true) {
            $validatedData = $request->validate($commonRulesChild);

            $childData = [
                'first_name' => $validatedData[$childKey . 'FirstName'],
                'last_name' => $validatedData[$childKey . 'LastName'],
                'gender' => $validatedData[$childKey . 'GenderBtnradio'],
                'years_support' => $validatedData[$childKey . 'YearsOfSupport'],
                'day' => $validatedData[$childKey . 'day'],
                'month' => $validatedData[$childKey . 'month'],
                'year' => $validatedData[$childKey . 'year'],
                'marital_status' => $validatedData[$childKey . 'MaritalStatus']
            ];
            $customerDetails['family_details']['dependant']['children_data'][$childKey] = array_merge($customerDetails['family_details']['dependant']['children_data'][$childKey], $childData);
        }

        if (isset($customerDetails['family_details']['dependant']['parents']) && $customerDetails['family_details']['dependant']['parents'] === true) {
            $validatedData = $request->validate($commonRulesParents);

            $parentsData = [
                'first_name' => $validatedData[$parentkey . 'FirstName'],
                'last_name' => $validatedData[$parentkey . 'LastName'],
                'gender' => $validatedData[$parentkey . 'GenderBtnradio'],
                'years_support' => $validatedData[$parentkey . 'YearsOfSupport'],
                'day' => $validatedData[$parentkey . 'day'],
                'month' => $validatedData[$parentkey . 'month'],
                'year' => $validatedData[$parentkey . 'year'],
                'marital_status' => $validatedData[$parentkey . 'MaritalStatus'],
            ];
            $customerDetails['family_details']['dependant']['parents_data'][$parentkey] = array_merge($customerDetails['family_details']['dependant']['parents_data'][$parentkey], $parentsData);
        }

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);

        Log::debug($customerDetails);
        // Process the form data and perform any necessary actions
        return redirect()->route('avatar.my.assets');
    }

    public function topPriorities(Request $request)
    {
        $topPrioritiesSerialized = $request->input('topPrioritiesButtonInput');
        $topPrioritiesButtonInput = json_decode($topPrioritiesSerialized, true);
        
        // // Get the existing array from the session
        //$arrayData = session('passingArrays', []);

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);

        // // Add or update the data value in the array
        //$arrayData['TopPriorities'] = $topPrioritiesButtonInput;

        $customerDetails['financial_priorities'] = $topPrioritiesButtonInput;

        // // Store the updated array back into the session
        //session(['passingArrays' => $arrayData]);

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);

        Log::debug($customerDetails);
        // Process the form data and perform any necessary actions
        return redirect()->route('priorities.to.discuss');
    }
}
