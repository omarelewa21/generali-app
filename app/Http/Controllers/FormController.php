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
use libphonenumber\PhoneNumberUtil;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberType;
use libphonenumber\NumberParseException;

class FormController extends Controller {
    public function pdpa(Request $request)
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
            $decision = $request->input('decision');

            // Get the existing array from the session
            $arrayData = session('customer_details', []);

            // Add or update the data value in the array
            $arrayData['pdpa'] = $decision;

            // Store the updated array back into the session
            session(['customer_details' => $arrayData]);        
            
            return response()->json(['message' => 'Button click saved successfully']);
        } else {
            return response()->json(['error' => 'Invalid CSRF token'], 403);
        }
    }

    public function basicDetails(Request $request)
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
            // Fetch titles from the database
            $titles = DB::table('titles')->pluck('titles')->toArray();
            $full_number = $request->input('full_number');
            $full_number_house = $request->input('full_number_house');

            $validatedData = $request->validate([
                'firstName' => 'required|max:30',
                'lastName' => 'required|max:30',
                'title' => 'required|in:' . implode(',', $titles),
                'mobileNumber' => 'required',
                'email' => 'required|email:rfc,dns|max:255',
            ]);

            // Parse the phone number
            $phoneNumberUtil = PhoneNumberUtil::getInstance();

            try {
                $parsedPhoneNumber = $phoneNumberUtil->parse($full_number, null);

                if (!$phoneNumberUtil->isPossibleNumber($parsedPhoneNumber)) {
                    // Invalid phone number
                    return redirect()->back()->withErrors(['mobileNumber' => 'Invalid phone number format.'])->withInput();
                }
            } catch (NumberParseException $e) {
                // Invalid phone number format
                return redirect()->back()->withErrors(['mobileNumber' => 'Invalid phone number format.'])->withInput();
            }

            if (!empty($full_number_house)) {
                try {
                    $parsedPhoneNumberHouse = $phoneNumberUtil->parse($full_number_house, null);
            
                    if (!$phoneNumberUtil->isPossibleNumber($parsedPhoneNumberHouse)) {
                        // Invalid phone number
                        return redirect()->back()->withErrors(['housePhoneNumber' => 'Invalid phone number format.'])->withInput();
                    }
                } catch (NumberParseException $e) {
                    // Invalid phone number format
                    return redirect()->back()->withErrors(['housePhoneNumber' => 'Invalid phone number format.'])->withInput();
                }
            }

            // Get the existing customer_details array from the session
            $customerDetails = $request->session()->get('customer_details', []);

            // Add the new array inside the customer_details array
            $customerDetails['basic_details'] = [
                'title' => $validatedData['title'],
                'first_name' => $validatedData['firstName'],
                'last_name' => $validatedData['lastName'],
                'mobile_number' => $full_number,
                'house_phone_number' => $full_number_house,
                'email' => $validatedData['email']
            ];

            // Store the updated customer_details array back into the session
            $request->session()->put('customer_details', $customerDetails);

            // Process the form data and perform any necessary actions
            return redirect()->route('avatar.welcome');
        } else {
            return response()->json(['error' => 'Invalid CSRF token'], 403);
        }
    }

    public function submitIdentity(Request $request)
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
            // Fetch titles from the database
            $countries = DB::table('countries')->pluck('countries')->toArray();
            $idtypes = DB::table('idtypes')->pluck('idtypes')->toArray();
            $educationLevel = DB::table('education_levels')->pluck('level')->toArray();
            $occupation = DB::table('occupations')->pluck('name')->toArray();
            $dateOfBirth = $request->input('dateOfBirth');
            $day = $request->input('day');
            $month = $request->input('month');
            $year = $request->input('year');

            $customMessages = [
                'idNumber.regex' => 'The id number field must match the format 123456-78-9012.',
                'passportNumber.max' => 'The passport number field must not exceed :max characters.',
                'birthCert.max' => 'The birth certificate field must not exceed :max characters.',
                'policeNumber.max' => 'The police number field must not exceed :max characters.',
                'registrationNumber.max' => 'The registration number field must not exceed :max characters.',
                'btnradio.required' => 'Please select your habits.',
                'month.required' => 'The date of birth field is required.',
                'day.required' => 'The date of birth field is required.',
                'year.required' => 'The date of birth field is required.',
            ];

            $validatedData = $request->validate([
                'country' => 'required|in:' . implode(',', $countries),
                'idType' => 'required|in:' . implode(',', $idtypes),
                'idNumber' => [
                    'nullable',
                    Rule::requiredIf(function () use ($request) {
                        return !$request->input('passportNumber') && !$request->input('birthCert') && !$request->input('policeNumber') && !$request->input('registrationNumber');
                    }),
                    'regex:/^[0-9]{6}-[0-9]{2}-[0-9]{4}$/',
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
                'gender' => [
                    'nullable',
                    Rule::requiredIf(function () use ($request) {
                        return $request->input('idType') !== 'New IC';
                    }),
                    'max:15',
                ],
                'day' => [
                    'nullable',
                    Rule::requiredIf(function () use ($request) {
                        return $request->input('idType') !== 'New IC';
                    }),
                    'max:15',
                    function ($attribute, $value, $fail) use ($request) {
                        $year = $request->input('year');
                        $month = $request->input('month');
                        $day = $request->input('day');

                        $selectedDate = $year .'-'. $month .'-'. $day;
                        $currentDate = now()->toDateString();

                        if ($selectedDate > $currentDate) {
                            $fail('The selected date cannot be in the future.');
                        }
                    },
                ],
                'month' => [
                    'nullable',
                    Rule::requiredIf(function () use ($request) {
                        return $request->input('idType') !== 'New IC';
                    }),
                    'max:15',
                    function ($attribute, $value, $fail) use ($request) {
                        $year = $request->input('year');
                        $month = $request->input('month');
                        $day = $request->input('day');

                        $selectedDate = $year .'-'. $month .'-'. $day;
                        $currentDate = now()->toDateString();

                        if ($selectedDate > $currentDate) {
                            $fail('The selected date cannot be in the future.');
                        }
                    },
                ],
                'year' => [
                    'nullable',
                    Rule::requiredIf(function () use ($request) {
                        return $request->input('idType') !== 'New IC';
                    }),
                    'max:15',
                    function ($attribute, $value, $fail) use ($request) {
                        $year = $request->input('year');
                        $month = $request->input('month');
                        $day = $request->input('day');

                        $selectedDate = $year .'-'. $month .'-'. $day;
                        $currentDate = now()->toDateString();

                        if ($selectedDate > $currentDate) {
                            $fail('The selected date cannot be in the future.');
                        }
                    },
                ],
                'btnradio' => 'required|in:smoker,nonSmoker',
                'educationLevel' => 'required|in:' . implode(',', $educationLevel),
                'occupation' => 'required|in:' . implode(',', $occupation),
            ], $customMessages);

            // Get the existing customer_details array from the session
            $customerDetails = $request->session()->get('customer_details', []);

            // Get existing identity_details from the session
            $identityDetails = $customerDetails['identity_details'] ?? [];

            if ($day !== NULL && $day !== '') {
                $dob = $day . '-' . $month . '-' . $year;
            }
            else {
                $dob = substr($dateOfBirth, 0, 2) . '-' . substr($dateOfBirth, 3, 2) . '-' . substr($dateOfBirth, 6, 4);
            }

            // Update specific keys with new values
            $identityDetails = array_merge($identityDetails, [
                'country' => $validatedData['country'],
                'id_type' => $validatedData['idType'],
                'id_number' => $validatedData['idNumber'],
                'passport_number' => $validatedData['passportNumber'],
                'birth_cert' => $validatedData['birthCert'],
                'police_number' => $validatedData['policeNumber'],
                'registration_number' => $validatedData['registrationNumber'],
                'gender' => $validatedData['gender'],
                'dob' => $dob,
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
        } else {
            return response()->json(['error' => 'Invalid CSRF token'], 403);
        }
    }

    public function handleAvatarSelection(Request $request)
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
            // Define custom validation rule for button selection
            Validator::extend('at_least_one_selected', function ($attribute, $value, $parameters, $validator) {
                if ($value !== null && $value === 'single' || $value === 'married' || $value === 'married' || $value === 'divorced' || $value === 'widowed') {
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

                if (isset($customerDetails['identity_details'])) {
                    $customerDetails['identity_details'] = array_merge($customerDetails['identity_details'], $newData);
                }
                else {
                    $customerDetails['identity_details'] = $newData;
                }
                
                if ($maritalStatusButtonInput === 'single') {
                    $customerDetails['family_details']['dependant']['spouse'] = false;
                    $customerDetails['family_details']['dependant']['children'] = false;
                    unset($customerDetails['family_details']['dependant']['spouse_data']);
                    unset($customerDetails['family_details']['dependant']['children_data']);

                } else if ($maritalStatusButtonInput === 'married') {
                    $customerDetails['family_details']['dependant']['spouse'] = true;
                    $customerDetails['family_details']['dependant']['spouse_data'] = [
                        'relation' => 'Spouse'
                    ];
                    
                } else if ($maritalStatusButtonInput === 'divorced' || $maritalStatusButtonInput === 'widowed') {
                    $customerDetails['family_details']['dependant']['spouse'] = false;
                    unset($customerDetails['family_details']['dependant']['spouse_data']);
                }
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
        } else {
            return response()->json(['error' => 'Invalid CSRF token'], 403);
        }
    }

    public function familyDependantDetails(Request $request)
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
                'spouseFirstName' => 'required|max:30',
                'spouseLastName' => 'required|max:30',
                'spouseCountry' => 'required|in:' . implode(',', $countries),
                'spouseIdType' => 'required|in:' . implode(',', $idtypes),
                'spouseIdNumber' => [
                    'nullable',
                    Rule::requiredIf(function () use ($request) {
                        return !$request->input('spousePassportNumber') && !$request->input('spouseBirthCert') && !$request->input('spousePoliceNumber') && !$request->input('spouseRegistrationNumber');
                    }),
                    'regex:/^[0-9]{6}-[0-9]{2}-[0-9]{4}$/',
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
                foreach ($customerDetails['family_details']['dependant']['children_data'] as $childKey => $value) {
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
            }

            if (isset($customerDetails['family_details']['dependant']['parents']) && $customerDetails['family_details']['dependant']['parents'] === true) {
                foreach ($customerDetails['family_details']['dependant']['parents_data'] as $parentkey => $value) {
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
            }

            // Store the updated customer_details array back into the session
            $request->session()->put('customer_details', $customerDetails);
            Log::debug($customerDetails);
            // Process the form data and perform any necessary actions
            return redirect()->route('avatar.my.assets');
        } else {
            return response()->json(['error' => 'Invalid CSRF token'], 403);
        }
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

        // Process the form data and perform any necessary actions
        return redirect()->route('priorities.to.discuss');
    }
}
