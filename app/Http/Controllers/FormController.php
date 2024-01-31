<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use libphonenumber\PhoneNumberUtil;
use libphonenumber\NumberParseException;
use App\Models\SessionStorage;
use App\Services\TransactionService;

class FormController extends Controller {
    public function pdpa(Request $request,TransactionService $transactionService)
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
            $customerDetails = $request->session()->get('customer_details', []);
                        
            // Add or update the data value in the array
            $customerDetails['pdpa'] = $decision;

            // Store the updated array back into the session
            $request->session()->put('customer_details', $customerDetails);

            //save into session storage
            $transactionService->handleTransaction($request,$customerDetails);

            $transactionData = ['transaction_id' => $request->input('transaction_id')];

            return redirect()->route('basic.details')->with(['message' => 'Button click saved successfully'] + $transactionData);
        } else {
            return response()->json(['error' => 'Invalid CSRF token'], 403);
        }
    }

    public function basicDetails(Request $request,TransactionService $transactionService)
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
            // Fetch from the database
            $titles = DB::table('titles')->pluck('titles')->toArray();
            $full_number = $request->input('full_number');
            $full_number_house = $request->input('full_number_house');
            $parsedcountryCodeHouse = '';
            
            $validatedData = $request->validate([
                'fullName' => [
                    'required',
                    'regex:/^[A-Za-z,\s\/]{1,100}$/',
                    'max:100',
                ],
                'title' => 'required|in:' . implode(',', $titles),
                'mobileNumber' => 'required',
                'email' => 'required|email:rfc,dns|max:255',
            ]);

            // Parse the phone number
            $phoneNumberUtil = PhoneNumberUtil::getInstance();

            try {
                $parsedPhoneNumber = $phoneNumberUtil->parse($full_number, null);
                $countryCode = $parsedPhoneNumber->getCountryCode();
                $parsedcountryCode = '+' . $countryCode;

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
                    $countryCodeHouse = $parsedPhoneNumberHouse->getCountryCode();
                    $parsedcountryCodeHouse = '+' . $countryCodeHouse;
                    
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
                'full_name' => $validatedData['fullName'],
                'country_code' => $parsedcountryCode,
                'mobile_number' => $full_number,
                'house_phone_number_country_code' => $parsedcountryCodeHouse,
                'house_phone_number' => $full_number_house,
                'email' => $validatedData['email']
            ];

            // Store the updated customer_details array back into the session
            $request->session()->put('customer_details', $customerDetails);

            //save into session storage
            $transactionService->handleTransaction($request,$customerDetails);

            $transactionData = ['transaction_id' => $request->input('transaction_id')];
            
            return redirect()->route('avatar.welcome')->with($transactionData);
        } else {
            return response()->json(['error' => 'Invalid CSRF token'], 403);
        }
    }

    public function submitIdentity(Request $request,TransactionService $transactionService)
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
            // Fetch from the database
            $countries = DB::table('countries')->pluck('countries')->toArray();
            $idtypes = DB::table('idtypes')->pluck('idtypes')->toArray();
            $educationLevel = DB::table('education_levels')->pluck('level')->toArray();
            $occupation = DB::table('occupations')->pluck('name')->toArray();
            $day = $request->input('day');
            $month = $request->input('month');
            $year = $request->input('year');

            $customMessages = [
                'idNumber.regex' => 'The id number field must match the format 123456-78-9012.',
                'passportNumber.max' => 'The passport number field must not exceed :max characters.',
                'birthCert.max' => 'The birth certificate field must not exceed :max characters.',
                'policeNumber.max' => 'The police number field must not exceed :max characters.',
                'registrationNumber.max' => 'The registration number field must not exceed :max characters.',
                'btnradio.required' => 'The habits field is required.',
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
                'btnradio' => 'required|in:Smoker,Non-Smoker',
                'educationLevel' => 'required|in:' . implode(',', $educationLevel),
                'occupation' => 'required|in:' . implode(',', $occupation),
            ], $customMessages);

            // Get the existing customer_details array from the session
            $customerDetails = $request->session()->get('customer_details', []);

            // Get existing identity_details from the session
            $identityDetails = $customerDetails['identity_details'] ?? [];

            if ($day !== NULL && $day !== '') {
                $dob = $year . '-' . $month . '-' . $day;

                $selectedYear = $year;
                $currentYear = now()->year;

                $age = $currentYear - $selectedYear;
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
                'age'=> $age,
                'habits' => $validatedData['btnradio'],
                'education_level' => $validatedData['educationLevel'],
                'occupation' => $validatedData['occupation']
            ]);

            // Set the updated identity_details back to the customer_details session
            $customerDetails['identity_details'] = $identityDetails;

            // Store the updated customer_details array back into the session
            $request->session()->put('customer_details', $customerDetails);

            $transactionService->handleTransaction($request,$customerDetails);

            $transactionData = ['transaction_id' => $request->input('transaction_id')];

            // Process the form data and perform any necessary actions
            return redirect()->route('avatar.marital.status')->with($transactionData);
        } else {
            return response()->json(['error' => 'Invalid CSRF token'], 403);
        }
    }

    public function handleAvatarSelection(Request $request,TransactionService $transactionService)
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
                if ($value !== null && $value === 'Single' || $value === 'Married' || $value === 'Divorced' || $value === 'Widowed') {
                    return true;
                }
                
                $customMessage = "Please select at least one.";
                $validator->errors()->add($attribute, $customMessage);

                return false;
            });

            Validator::extend('at_least_one_selected_family', function ($attribute, $value, $fail, $validator) {

                $decodedValue = json_decode($value, true);

                if ((isset($decodedValue['spouse']) && $decodedValue['spouse'] === true) || (isset($decodedValue['children']) && $decodedValue['children'] === true) || (isset($decodedValue['parents']) && $decodedValue['parents'] === true) || (isset($decodedValue['siblings']) && $decodedValue['siblings'] === true)) {
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
                'familyDependentButtonInput' => [
                    'at_least_one_selected_family',
                ],
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Validation passed, perform any necessary processing.
            $maritalStatusButtonInput = $request->input('maritalStatusButtonInput');
            $familyDependentSerialized = $request->input('familyDependentButtonInput');
            $familyDependentButtonInput = json_decode($familyDependentSerialized, true);
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
                
                if ($maritalStatusButtonInput === 'Single') {
                    $customerDetails['family_details']['spouse'] = false;
                    $customerDetails['family_details']['children'] = false;
                    unset($customerDetails['family_details']['spouse_data']);
                    unset($customerDetails['family_details']['children_data']);

                } else if ($maritalStatusButtonInput === 'Married') {
                    $customerDetails['family_details']['spouse'] = true;
                    if (!isset($customerDetails['family_details']['spouse_data'])) {
                        $customerDetails['family_details']['spouse_data'] = [
                            'relation' => 'Spouse'
                        ];
                    }
                    
                } else if ($maritalStatusButtonInput === 'Divorced' || $maritalStatusButtonInput === 'Widowed') {
                    $customerDetails['family_details']['spouse'] = false;
                    unset($customerDetails['family_details']['spouse_data']);
                }
            }
            elseif ($familyDependentButtonInput) {
                $customerDetails['family_details'] = $familyDependentButtonInput;
            }
            elseif ($assetsButtonInput) {
                $customerDetails['assets'] = $assetsButtonInput;
            }

            // Store the updated customer_details array back into the session
            $request->session()->put('customer_details', $customerDetails);

            //save into session storage
            $transactionService->handleTransaction($request,$customerDetails);

            $transactionData = ['transaction_id' => $request->input('transaction_id')];

            // Store the updated array back into the session
            return redirect()->route($dataUrl)->with($transactionData);
        } else {
            return response()->json(['error' => 'Invalid CSRF token'], 403);
        }
    }

    public function familyDependentDetails(Request $request,TransactionService $transactionService)
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
            // Fetch from the database
            $maritalStatus = DB::table('marital_statuses')->pluck('maritalStatus')->toArray();
            $titles = DB::table('titles')->pluck('titles')->toArray();
            $countries = DB::table('countries')->pluck('countries')->toArray();
            $idtypes = DB::table('idtypes')->pluck('idtypes')->toArray();
            $occupation = DB::table('occupations')->pluck('name')->toArray();

            // Get the existing customer_details array from the session
            $customerDetails = $request->session()->get('customer_details', []); 

            $customMessages = [
                'month.required' => 'The date of birth field is required.',
                'day.required' => 'The date of birth field is required.',
                'year.required' => 'The date of birth field is required.',
                'siblingmonth.required' => 'The date of birth field is required.',
                'siblingday.required' => 'The date of birth field is required.',
                'siblingyear.required' => 'The date of birth field is required.',
            ];

            // Define the common validation rules for spouse
            $commonRules = [
                'spouseTitle' => 'required|in:' . implode(',', $titles),
                'spouseFullName' => [
                    'required',
                    'regex:/^[A-Za-z,\s\/]{1,100}$/',
                    'max:100',
                ],
                // 'spouseLastName' => 'required|max:30',
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
                'gender' => [
                    'nullable',
                    Rule::requiredIf(function () use ($request) {
                        return $request->input('spouseIdType') !== 'New IC';
                    }),
                    'max:15',
                ],
                'habits' => 'required|in:Smoker,Non-Smoker',
                'spouseOccupation' => 'required|in:' . implode(',', $occupation),
            ];

            $commonRulesSiblings = [
                'siblingFullName' => [
                    'required',
                    'regex:/^[A-Za-z,\s\/]{1,100}$/',
                    'max:100',
                ],
                // 'siblingLastName' => 'required|max:30',
                'siblingday' => [
                    'required',
                    function ($attribute, $value, $fail) use ($request) {
                        $year = $request->input('siblingyear');
                        $month = $request->input('siblingmonth');
                        $day = $request->input('siblingday');
        
                        $selectedDate = $year . '-' . $month . '-' . $day;
                        $currentDate = now()->toDateString();
        
                        if ($selectedDate > $currentDate) {
                            $fail('The selected date cannot be in the future.');
                        }
                    },
                ],
                'siblingmonth' => [
                    'required',
                    function ($attribute, $value, $fail) use ($request) {
                        $year = $request->input('siblingyear');
                        $month = $request->input('siblingmonth');
                        $day = $request->input('siblingday');
        
                        $selectedDate = $year . '-' . $month . '-' . $day;
                        $currentDate = now()->toDateString();
        
                        if ($selectedDate > $currentDate) {
                            $fail('The selected date cannot be in the future.');
                        }
                    },
                ],
                'siblingyear' => [
                    'required',
                    function ($attribute, $value, $fail) use ($request) {
                        $year = $request->input('siblingyear');
                        $month = $request->input('siblingmonth');
                        $day = $request->input('siblingday');
        
                        $selectedDate = $year . '-' . $month . '-' . $day;
                        $currentDate = now()->toDateString();
        
                        if ($selectedDate > $currentDate) {
                            $fail('The selected date cannot be in the future.');
                        }
                    },
                ],
                'siblingGender' => 'required|in:Male,Female',
                'siblingYearsOfSupport' => 'required|numeric|max:100',
                'siblingMaritalStatus' => 'required|in:' . implode(',', $maritalStatus),
            ];

            $customMessagesChild = [];
            $customMessagesParents = [];

            if (isset($customerDetails['family_details']['children']) && $customerDetails['family_details']['children'] === true) {
                foreach ($customerDetails['family_details']['children_data'] as $childKey => $value) {
                    $customMessagesChild[$childKey .'FullName.required'] = 'The child full name field is required.';
                    // $customMessagesChild[$childKey .'LastName.required'] = 'The child last name field is required.';
                    $customMessagesChild[$childKey .'Gender.required'] = 'The child gender field is required.';
                    $customMessagesChild[$childKey .'day.required'] = 'The child date of birth field is required.';
                    $customMessagesChild[$childKey .'month.required'] = 'The child date of birth field is required.';
                    $customMessagesChild[$childKey .'year.required'] = 'The child date of birth field is required.';
                    $customMessagesChild[$childKey .'YearsOfSupport.required'] = 'The child years of support field is required.';
                    $customMessagesChild[$childKey .'MaritalStatus.required'] = 'The child marital status field is required.';
                    
                    $commonRulesChild[$childKey . 'FullName'] = [
                        'required',
                        'regex:/^[A-Za-z,\s\/]{1,100}$/',
                        'max:100',
                    ];
                    // $commonRulesChild[$childKey . 'LastName'] = 'required|max:30';
                    $commonRulesChild[$childKey . 'Gender'] = 'required|in:Male,Female';
                    $commonRulesChild[$childKey . 'YearsOfSupport'] = 'required|numeric|max:100';
                    $commonRulesChild[$childKey . 'day'] = [
                        'required',
                        function ($attribute, $value, $fail) use ($request, $childKey) {
                            $year = $request->input($childKey . 'year');
                            $month = $request->input($childKey . 'month');
                            $day = $request->input($childKey . 'day');
            
                            $selectedDate = $year . '-' . $month . '-' . $day;
                            $currentDate = now()->toDateString();
            
                            if ($selectedDate > $currentDate) {
                                $fail('The selected date cannot be in the future.');
                            }
                        },
                    ];
                    $commonRulesChild[$childKey . 'month'] = [
                        'required',
                        function ($attribute, $value, $fail) use ($request, $childKey) {
                            $year = $request->input($childKey . 'year');
                            $month = $request->input($childKey . 'month');
                            $day = $request->input($childKey . 'day');
            
                            $selectedDate = $year . '-' . $month . '-' . $day;
                            $currentDate = now()->toDateString();
            
                            if ($selectedDate > $currentDate) {
                                $fail('The selected date cannot be in the future.');
                            }
                        },
                    ];
                    $commonRulesChild[$childKey . 'year'] = [
                        'required',
                        function ($attribute, $value, $fail) use ($request, $childKey) {
                            $year = $request->input($childKey . 'year');
                            $month = $request->input($childKey . 'month');
                            $day = $request->input($childKey . 'day');
            
                            $selectedDate = $year . '-' . $month . '-' . $day;
                            $currentDate = now()->toDateString();
            
                            if ($selectedDate > $currentDate) {
                                $fail('The selected date cannot be in the future.');
                            }
                        },
                    ];
                    $commonRulesChild[$childKey . 'MaritalStatus'] = 'required|in:' . implode(',', $maritalStatus);
                }
            }

            if (isset($customerDetails['family_details']['parents']) && $customerDetails['family_details']['parents'] === true) {
                foreach ($customerDetails['family_details']['parents_data'] as $parentkey => $value) {

                    $customMessagesParents[$parentkey .'FullName.required'] = 'The parent full name field is required.';
                    // $customMessagesParents[$parentkey .'LastName.required'] = 'The parent last name field is required.';
                    $customMessagesParents[$parentkey .'Gender.required'] = 'The parent gender field is required.';
                    $customMessagesParents[$parentkey .'day.required'] = 'The parent date of birth field is required.';
                    $customMessagesParents[$parentkey .'month.required'] = 'The parent date of birth field is required.';
                    $customMessagesParents[$parentkey .'year.required'] = 'The parent date of birth field is required.';
                    $customMessagesParents[$parentkey .'YearsOfSupport.required'] = 'The parent years of support field is required.';
                    $customMessagesParents[$parentkey .'MaritalStatus.required'] = 'The parent marital status field is required.';

                    $commonRulesParents[$parentkey . 'FullName'] = [
                        'required',
                        'regex:/^[A-Za-z,\s\/]{1,100}$/',
                        'max:100',
                    ];
                    // $commonRulesParents[$parentkey . 'LastName'] = 'required|max:30';
                    $commonRulesParents[$parentkey . 'Gender'] = 'required|in:Male,Female';
                    $commonRulesParents[$parentkey . 'YearsOfSupport'] = 'required|numeric|max:100';
                    $commonRulesParents[$parentkey . 'day'] = [
                        'required',
                        function ($attribute, $value, $fail) use ($request, $parentkey) {
                            $year = $request->input($parentkey . 'year');
                            $month = $request->input($parentkey . 'month');
                            $day = $request->input($parentkey . 'day');
            
                            $selectedDate = $year . '-' . $month . '-' . $day;
                            $currentDate = now()->toDateString();
            
                            if ($selectedDate > $currentDate) {
                                $fail('The selected date cannot be in the future.');
                            }
                        },
                    ];
                    $commonRulesParents[$parentkey . 'month'] = [
                        'required',
                        function ($attribute, $value, $fail) use ($request, $parentkey) {
                            $year = $request->input($parentkey . 'year');
                            $month = $request->input($parentkey . 'month');
                            $day = $request->input($parentkey . 'day');
            
                            $selectedDate = $year . '-' . $month . '-' . $day;
                            $currentDate = now()->toDateString();
            
                            if ($selectedDate > $currentDate) {
                                $fail('The selected date cannot be in the future.');
                            }
                        },
                    ];
                    $commonRulesParents[$parentkey . 'year'] = [
                        'required',
                        function ($attribute, $value, $fail) use ($request, $parentkey) {
                            $year = $request->input($parentkey . 'year');
                            $month = $request->input($parentkey . 'month');
                            $day = $request->input($parentkey . 'day');
            
                            $selectedDate = $year . '-' . $month . '-' . $day;
                            $currentDate = now()->toDateString();
            
                            if ($selectedDate > $currentDate) {
                                $fail('The selected date cannot be in the future.');
                            }
                        },
                    ];
                    $commonRulesParents[$parentkey . 'MaritalStatus'] = 'required|in:' . implode(',', $maritalStatus);
                }
            }

            if (isset ($customerDetails['family_details']['spouse']) && $customerDetails['family_details']['spouse'] === true) {
                $validatedData = $request->validate($commonRules, $customMessages);

                $day = $request->input('day');
                $month = $request->input('month');
                $year = $request->input('year');

                if ($day !== NULL && $day !== '') {
                    $dob = $year . '-' . $month . '-' . $day;

                    $selectedYear = $year;
                    $currentYear = now()->year;

                    $age = $currentYear - $selectedYear;
                }

                $marital_status = $customerDetails['identity_details']['marital_status'];

                if (isset ($customerDetails['family_details']['children']) && $customerDetails['family_details']['children'] === true) {
                    $numOfChildren = count($customerDetails['family_details']['children_data']);
                }
                else {
                    $numOfChildren = '0';
                }
                
                $newData = [
                    'title' => $validatedData['spouseTitle'],
                    'full_name' => $validatedData['spouseFullName'],
                    // 'last_name' => $validatedData['spouseLastName'],
                    'country' => $validatedData['spouseCountry'],
                    'id_type' => $validatedData['spouseIdType'],
                    'id_number' => $validatedData['spouseIdNumber'],
                    'passport_number' => $validatedData['spousePassportNumber'],
                    'birth_cert' => $validatedData['spouseBirthCert'],
                    'police_number' => $validatedData['spousePoliceNumber'],
                    'registration_number' => $validatedData['spouseRegistrationNumber'],
                    'dob' => $dob,
                    'age' => $age,
                    'gender' => $validatedData['gender'],
                    'habits' => $validatedData['habits'],
                    'occupation' => $validatedData['spouseOccupation'],
                    'marital_status' => $marital_status,
                    'children' => $numOfChildren
                ];
                $customerDetails['family_details']['spouse_data'] = array_merge($customerDetails['family_details']['spouse_data'], $newData);
            }

            if (isset ($customerDetails['family_details']['children']) && $customerDetails['family_details']['children'] === true) {
                foreach ($customerDetails['family_details']['children_data'] as $childKey => $value) {
                    $validatedData = $request->validate($commonRulesChild, $customMessagesChild);

                    $day = $request->input($childKey .'day');
                    $month = $request->input($childKey .'month');
                    $year = $request->input($childKey .'year');

                    if ($day !== NULL && $day !== '') {
                        $dob = $year . '-' . $month . '-' . $day;

                        $selectedYear = $year;
                        $currentYear = now()->year;

                        $age = $currentYear - $selectedYear;
                    }

                    $childData = [
                        'full_name' => $validatedData[$childKey . 'FullName'],
                        // 'last_name' => $validatedData[$childKey . 'LastName'],
                        'gender' => $validatedData[$childKey . 'Gender'],
                        'years_support' => $validatedData[$childKey . 'YearsOfSupport'],
                        'dob' => $dob,
                        'age' => $age,
                        'marital_status' => $validatedData[$childKey . 'MaritalStatus'],
                    ];

                    $customerDetails['family_details']['children_data'][$childKey] = array_merge($customerDetails['family_details']['children_data'][$childKey], $childData);
                }

                $numChildren = count($customerDetails['family_details']['children_data']);

                $newChildData = [
                    'children' => $numChildren
                ];

                if (isset($customerDetails['identity_details'])) {
                    $customerDetails['identity_details'] = array_merge($customerDetails['identity_details'], $newChildData);
                }
                else {
                    $customerDetails['identity_details'] = $newChildData;
                }
            }

            if (isset($customerDetails['family_details']['parents']) && $customerDetails['family_details']['parents'] === true) {
                foreach ($customerDetails['family_details']['parents_data'] as $parentkey => $value) {
                    $validatedData = $request->validate($commonRulesParents, $customMessagesParents);

                    $day = $request->input($parentkey .'day');
                    $month = $request->input($parentkey .'month');
                    $year = $request->input($parentkey .'year');

                    if ($day !== NULL && $day !== '') {
                        // $dob = $day . '-' . $month . '-' . $year;
                        $dob = $year . '-' . $month . '-' . $day;
                    }

                    $parentsData = [
                        'full_name' => $validatedData[$parentkey . 'FullName'],
                        // 'last_name' => $validatedData[$parentkey . 'LastName'],
                        'gender' => $validatedData[$parentkey . 'Gender'],
                        'years_support' => $validatedData[$parentkey . 'YearsOfSupport'],
                        'dob' => $dob,
                        'marital_status' => $validatedData[$parentkey . 'MaritalStatus'],
                    ];
                    $customerDetails['family_details']['parents_data'][$parentkey] = array_merge($customerDetails['family_details']['parents_data'][$parentkey], $parentsData);
                }
            }

            if (isset ($customerDetails['family_details']['siblings']) && $customerDetails['family_details']['siblings'] === true) {
                $validatedData = $request->validate($commonRulesSiblings, $customMessages);

                $day = $request->input('siblingday');
                $month = $request->input('siblingmonth');
                $year = $request->input('siblingyear');

                if ($day !== NULL && $day !== '') {
                    // $dob = $day . '-' . $month . '-' . $year;
                    $dob = $year . '-' . $month . '-' . $day;
                }

                $siblingData = [
                    'full_name' => $validatedData['siblingFullName'],
                    // 'last_name' => $validatedData['siblingLastName'],
                    'gender' => $validatedData['siblingGender'],
                    'dob' => $dob,
                    'years_support' => $validatedData['siblingYearsOfSupport'],
                    'marital_status' => $validatedData['siblingMaritalStatus']
                ];
                $customerDetails['family_details']['siblings_data'] = array_merge($customerDetails['family_details']['siblings_data'], $siblingData);
            }

            // Store the updated customer_details array back into the session
            $request->session()->put('customer_details', $customerDetails);

            //save into session storage
            $transactionService->handleTransaction($request,$customerDetails);

            $transactionData = ['transaction_id' => $request->input('transaction_id')];

            // Process the form data and perform any necessary actions
            return redirect()->route('avatar.my.assets')->with($transactionData);
        } else {
            return response()->json(['error' => 'Invalid CSRF token'], 403);
        }
    }

    public function topPriorities(Request $request,TransactionService $transactionService)
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

            $validator = Validator::make($request->all(), [
                'topPrioritiesButtonInput' => [
                    'at_least_one_selected',
                ],
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $topPrioritiesSerialized = $request->input('topPrioritiesButtonInput');
            $topPrioritiesButtonInput = json_decode($topPrioritiesSerialized, true);
            
            $topPrioritiesButtonInput = array_filter($topPrioritiesButtonInput, function($value) {
                return $value !== null;
            });
            $topPrioritiesButtonInput = array_values($topPrioritiesButtonInput);
            
            // Get the existing customer_details array from the session
            $customerDetails = $request->session()->get('customer_details', []);

            $customerDetails['priorities_level'] = $topPrioritiesButtonInput;
            unset($customerDetails['priorities']);

            // Store the updated customer_details array back into the session
            $request->session()->put('customer_details', $customerDetails);
            
            //save into session storage
            $transactionService->handleTransaction($request,$customerDetails);

            $transactionData = ['transaction_id' => $request->input('transaction_id')];

            // Process the form data and perform any necessary actions
            return redirect()->route('priorities.to.discuss')->with($transactionData);
        } else {
            return response()->json(['error' => 'Invalid CSRF token'], 403);
        }
    }

    public function priorities(Request $request ,TransactionService $transactionService)
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
            $checkboxValues = $request->all();
            $requiredPriorities = ['protection', 'retirement', 'health-medical', 'education', 'savings', 'debt-cancellation', 'investments', 'others'];

            // Get the existing array from the session
            $customerDetails = $request->session()->get('customer_details', []);
            
            // Get the current priorities from the session
            $priorities = isset($customerDetails['priorities_level']) ? $customerDetails['priorities_level'] : [];

            // Check if all required priorities are present
            if (count(array_intersect($requiredPriorities, $priorities)) === count($requiredPriorities)) {
                // All required priorities are present
                $customerDetails['customers_choice'] = '1';
            } else {
                // Only partial priorities are present
                $customerDetails['customers_choice'] = '2';
            }

            // Add or update the data value in the array
            $customerDetails['priorities'] = $checkboxValues;

            // Store the updated array back into the session
            $request->session()->put('customer_details', $customerDetails);
            
            //save into session storage
            $transactionService->handleTransaction($request,$customerDetails);

            $transactionData = ['transaction_id' => $request->input('transaction_id')];

            return response()->json(['message' => 'Button click saved successfully']);
        } else {
            return response()->json(['error' => 'Invalid CSRF token'], 403);
        }
    }

    public function existingPolicy(Request $request ,TransactionService $transactionService)
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
            $companies = DB::table('companies')->pluck('companies')->toArray();
            $plans = DB::table('policy_plans')->pluck('policy_plans')->toArray();
            $mode = DB::table('premium_modes')->pluck('Modes')->toArray();

            $policy = $request->input('policy');
            $policy2 = $request->input('policy2');
            $policy3 = $request->input('policy3');
            $policy4 = $request->input('policy4');

            // Get the existing customer_details array from the session
            $customerDetails = $request->session()->get('customer_details', []);

            $validatedData = $request->validate([
                'policyRole' => 'required',
                'policyFirstName' => 'required',
                'policyLastName' => 'required',
                'company' => 'required|in:' . implode(',', $companies),
                'companyOthers' => [
                    'nullable',
                    Rule::requiredIf(function () use ($request) {
                        return $request->input('company') === 'Others';
                    })
                ],
                'inceptionYear' => [
                    'required',
                    'regex:/^(19\d{2}|20\d{2})$/',
                    function ($attribute, $value, $fail) {
                        $currentYear = date('Y');
                        if (intval($value) < 1900 || intval($value) > $currentYear) {
                            $fail('The year must be a valid year between 1900 and '.$currentYear.'.');
                        }
                    },
                ],
                'policyPlan' => 'required|in:' . implode(',', $plans),
                'maturityYear' => [
                    'required',
                    'regex:/^(19\d{2}|20\d{2})$/',
                    function ($attribute, $value, $fail) use ($request) {
                        $dob = $request->session()->get('customer_details.identity_details.dob', []);
                        $dobYear = substr($dob, -4);
                        $currentYear = date('Y');
                        $customerAge = $currentYear - $dobYear;
                        $maturityYear = 100 - $customerAge;
                        $allowedYear = $currentYear + $maturityYear;

                        if (intval($value) < $currentYear || intval($value) > $allowedYear) {
                            $fail('The year must be a valid year between '.$currentYear.' and '.$allowedYear.'.');
                        }
                    },
                ],
                'premiumMode' => 'required|in:' . implode(',', $mode),
                'premiumContribution' => [
                    'required',
                    'regex:/^\$?(\d{1,2}(,\d{3})*|\d{1,8})$/',
                ],
                'lifeCoverage' => [
                    'required',
                    'regex:/^\$?(\d{1,2}(,\d{3})*|\d{1,8})$/',
                ],
                'criticalIllness' => [
                    'required',
                    'regex:/^\$?(\d{1,2}(,\d{3})*|\d{1,8})$/',
                ],
                'policyFirstName2'=> 'nullable',
                'policyFirstName3'=> 'nullable',
            ]);

            // $validatedData = $request->validate([
            //     'policyRole' => 'required',
            //     'policyFirstName' => 'required',
            //     'policyLastName' => 'required',
            //     'policyRole2' => 'nullable',
            //     'policyFirstName2' => 'nullable',
            //     'policyLastName2' => 'nullable',
            //     // 'company2' => 'required|in:' . implode(',', $companies),
            //     // 'companyOthers2' => [
            //     //     'nullable',
            //     //     Rule::requiredIf(function () use ($request) {
            //     //         return $request->input('company2') === 'Others';
            //     //     })
            //     // ],
            //     // 'inceptionYear2' => [
            //     //     'required',
            //     //     'regex:/^(19\d{2}|20\d{2})$/',
            //     //     function ($attribute, $value, $fail) {
            //     //         $currentYear = date('Y');
            //     //         if (intval($value) < 1900 || intval($value) > $currentYear) {
            //     //             $fail('The year must be a valid year between 1900 and '.$currentYear.'.');
            //     //         }
            //     //     },
            //     // ],
            //     // 'policyPlan2' => 'required|in:' . implode(',', $plans),
            //     // 'maturityYear2' => [
            //     //     'required',
            //     //     'regex:/^(19\d{2}|20\d{2})$/',
            //     //     function ($attribute, $value, $fail) use ($request) {
            //     //         $dob = $request->session()->get('customer_details.identity_details.dob', []);
            //     //         $dobYear = substr($dob, -4);
            //     //         $currentYear = date('Y');
            //     //         $customerAge = $currentYear - $dobYear;
            //     //         $maturityYear = 100 - $customerAge;
            //     //         $allowedYear = $currentYear + $maturityYear;

            //     //         if (intval($value) < $currentYear || intval($value) > $allowedYear) {
            //     //             $fail('The year must be a valid year between '.$currentYear.' and '.$allowedYear.'.');
            //     //         }
            //     //     },
            //     // ],
            //     // 'premiumMode2' => 'required|in:' . implode(',', $mode),
            //     // 'premiumContribution2' => [
            //     //     'required',
            //     //     'regex:/^\$?(\d{1,2}(,\d{3})*|\d{1,8})$/',
            //     // ],
            //     // 'lifeCoverage2' => [
            //     //     'required',
            //     //     'regex:/^\$?(\d{1,2}(,\d{3})*|\d{1,8})$/',
            //     // ],
            //     // 'criticalIllness2' => [
            //     //     'required',
            //     //     'regex:/^\$?(\d{1,2}(,\d{3})*|\d{1,8})$/',
            //     // ],
            // ]);

            // Add the new array inside the customer_details array
            if ($policy) {
                $customerDetails['existing_policy']['policy_1'] = [
                    'role' => $validatedData['policyRole'],
                    'first_name' => $validatedData['policyFirstName'],
                    'last_name' => $validatedData['policyLastName'],
                    'company' => $validatedData['company'],
                    'company_others' => $validatedData['companyOthers'],
                    'inception_year' => $validatedData['inceptionYear'],
                    'policy_plan' => $validatedData['policyPlan'],
                    'maturity_Year' => $validatedData['maturityYear'],
                    'premium_mode' => $validatedData['premiumMode'],
                    'premium_contribution' => $validatedData['premiumContribution'],
                    'life_coverage' => $validatedData['lifeCoverage'],
                    'critical_illness' => $validatedData['criticalIllness']
                ];
            }
            
            if ($policy2) {
                $customerDetails['existing_policy']['policy_2'] = [
                    // 'role' => $validatedData['policyRole2'],
                    // 'first_name' => $validatedData['policyFirstName2'],
                    // 'last_name' => $validatedData['policyLastName2'],
                    // 'company' => $validatedData['company2'],
                    // 'company_others' => $validatedData['companyOthers2'],
                    // 'inception_year' => $validatedData['inceptionYear2'],
                    // 'policy_plan' => $validatedData['policyPlan2'],
                    // 'maturity_Year' => $validatedData['maturityYear2'],
                    // 'premium_mode' => $validatedData['premiumMode2'],
                    // 'premium_contribution' => $validatedData['premiumContribution2'],
                    // 'life_coverage' => $validatedData['lifeCoverage2'],
                    // 'critical_illness' => $validatedData['criticalIllness2']
                ];
            }

            if ($policy3) {
                $customerDetails['existing_policy']['policy_3'] = [
                    'name' => $validatedData['policyFirstName3']
                ];
            }

            if ($policy4) {
                $customerDetails['existing_policy']['policy_4'] = [
                    'name' => $validatedData['policyFirstName4']
                ];
            }

            // Store the updated customer_details array back into the session
            $request->session()->put('customer_details', $customerDetails);
            
            //save into session storage
            $transactionService->handleTransaction($request,$customerDetails);

            $transactionData = ['transaction_id' => $request->input('transaction_id')];

            return redirect()->route('summary.monthly-goals')->with($transactionData);
        } else {
            return response()->json(['error' => 'Invalid CSRF token'], 403);
        }
    }

    public function createNewForm(Request $request)
    {
        // Regenerate the session ID
        $session = $request->session()->regenerate();
        $sessionId = $request->session()->getId();

        // Store the form token in the session
        session(['session_id' => $sessionId]);

        return view('pages/main/welcome');
    }
}
