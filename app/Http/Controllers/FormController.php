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
        $arrayData = session('passingArrays', []);

        // Add or update the data value in the array
        $arrayData['PDPA'] = $decision;

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);        
        
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
            'email' => 'required|email|max:255',
        ]);

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        // Add or update the data value in the array
        $arrayData['Title'] = $validatedData['title'];
        $arrayData['FirstName'] = $validatedData['firstName'];
        $arrayData['LastName'] = $validatedData['lastName'];
        $arrayData['PhoneCode'] = $validatedData['phoneCodeMobile'];
        $arrayData['MobileNumber'] = $validatedData['mobileNumber'];
        $arrayData['PhoneCodeHouse'] = $validatedData['phoneCodeHouse'];
        $arrayData['HousePhoneNumber'] = $validatedData['housePhoneNumber'];
        $arrayData['Email'] = $validatedData['email'];

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);

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

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        // Add or update the data value in the array
        $arrayData['Country'] = $validatedData['country'];
        $arrayData['IdType'] = $validatedData['idType'];
        $arrayData['IdNumber'] = $validatedData['idNumber'];
        $arrayData['PassportNumber'] = $validatedData['passportNumber'];
        $arrayData['BirthCert'] = $validatedData['birthCert'];
        $arrayData['PoliceNumber'] = $validatedData['policeNumber'];
        $arrayData['RegistrationNumber'] = $validatedData['registrationNumber'];
        $arrayData['DobDay'] = $validatedData['day'];
        $arrayData['DobMonth'] = $validatedData['month'];
        $arrayData['DobYear'] = $validatedData['year'];
        $arrayData['Habits'] = $validatedData['btnradio'];
        $arrayData['EducationLevel'] = $validatedData['educationLevel'];
        $arrayData['Occupation'] = $validatedData['occupation'];

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);

        // Process the form data and perform any necessary actions
        return redirect()->route('avatar.marital.status');
    }

    public function handleAvatarSelection(Request $request)
    {
        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

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

            if (isset($decodedValue['spouse']['status']) && $decodedValue['spouse']['status'] === 'yes' || !empty($decodedValue['children']) || !empty($decodedValue['parents'])) {
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

        // Add or update the data value in the array
        if ($maritalStatusButtonInput) {
            $arrayData['MaritalStatus'] = $maritalStatusButtonInput;
        }
        elseif ($familyDependantButtonInput) {
            $arrayData['FamilyDependant'] = $familyDependantButtonInput;
        }
        elseif ($assetsButtonInput) {
            $arrayData['Assets'] = $assetsButtonInput;
        }

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);
        Log::debug($arrayData);
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

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

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
            // 'siblingFirstName' => 'required|max:255',
            // 'siblingLastName' => 'required|max:255',
            // 'siblingYearsOfSupport' => 'required|numeric|max:100',
            // 'siblingday' => 'required',
            // 'siblingmonth' => 'required',
            // 'siblingyear' => 'required',
            // 'siblingMaritalStatus' => 'required|in:' . implode(',', $maritalStatus),
        ];

        if (isset($arrayData['FamilyDependant']['children'])) {
            foreach ($arrayData['FamilyDependant']['children'] as $key => $childName) {
                $commonRules[$childName . 'FirstName'] = 'required|max:255';
                $commonRules[$childName . 'LastName'] = 'required|max:255';
                $commonRules[$childName . 'GenderBtnradio'] = 'required|in:male,female';
                $commonRules[$childName . 'YearsOfSupport'] = 'required|numeric|max:100';
                $commonRules[$childName . 'day'] = 'required';
                $commonRules[$childName . 'month'] = 'required';
                $commonRules[$childName . 'year'] = 'required';
                $commonRules[$childName . 'MaritalStatus'] = 'required|in:' . implode(',', $maritalStatus);
            }
        }

        if (isset($arrayData['FamilyDependant']['parents'])) {
            foreach ($arrayData['FamilyDependant']['parents'] as $key => $parentsName) {
                $commonRules[$parentsName . 'FirstName'] = 'sometimes|required|max:255';
                $commonRules[$parentsName . 'LastName'] = 'sometimes|required|max:255';
                $commonRules[$parentsName . 'YearsOfSupport'] = 'sometimes|required|numeric|max:100';
                $commonRules[$parentsName . 'day'] = 'sometimes|required';
                $commonRules[$parentsName . 'month'] = 'sometimes|required';
                $commonRules[$parentsName . 'year'] = 'sometimes|required';
                $commonRules[$parentsName . 'MaritalStatus'] = 'required|in:' . implode(',', $maritalStatus);
            }
        }

        $validatedData = $request->validate($commonRules);

        if (isset($arrayData['FamilyDependant']['spouse']) && $arrayData['FamilyDependant']['spouse']['status'] === 'yes') {
            $arrayData['FamilyDependant']['spouse']['title'] = $validatedData['spouseTitle'];
            $arrayData['FamilyDependant']['spouse']['firstName'] = $validatedData['spouseFirstName'];
            $arrayData['FamilyDependant']['spouse']['lastName'] = $validatedData['spouseLastName'];
            $arrayData['FamilyDependant']['spouse']['country'] = $validatedData['spouseCountry'];
            $arrayData['FamilyDependant']['spouse']['idType'] = $validatedData['spouseIdType'];
            $arrayData['FamilyDependant']['spouse']['idNumber'] = $validatedData['spouseIdNumber'];
            $arrayData['FamilyDependant']['spouse']['passportNumber'] = $validatedData['spousePassportNumber'];
            $arrayData['FamilyDependant']['spouse']['birthCert'] = $validatedData['spouseBirthCert'];
            $arrayData['FamilyDependant']['spouse']['policeNumber'] = $validatedData['spousePoliceNumber'];
            $arrayData['FamilyDependant']['spouse']['registrationNumber'] = $validatedData['spouseRegistrationNumber'];
            $arrayData['FamilyDependant']['spouse']['gender'] = $validatedData['genderBtnradio'];
            $arrayData['FamilyDependant']['spouse']['habits'] = $validatedData['smokingBtnradio'];
            $arrayData['FamilyDependant']['spouse']['day'] = $validatedData['spouseday'];
            $arrayData['FamilyDependant']['spouse']['month'] = $validatedData['spousemonth'];
            $arrayData['FamilyDependant']['spouse']['year'] = $validatedData['spouseyear'];
            $arrayData['FamilyDependant']['spouse']['occupation'] = $validatedData['spouseOccupation'];
        }
        
        if (isset($arrayData['FamilyDependant']['children'])) {
            foreach ($arrayData['FamilyDependant']['children'] as $key => $childName) {
                $childData = array(
                    'firstName' => $validatedData[$childName . 'FirstName'],
                    'lastName' => $validatedData[$childName . 'LastName'],
                    'gender' => $validatedData[$childName . 'GenderBtnradio'],
                    'yearsOfSupport' => $validatedData[$childName . 'YearsOfSupport'],
                    'day' => $validatedData[$childName . 'day'],
                    'month' => $validatedData[$childName . 'month'],
                    'year' => $validatedData[$childName . 'year'],
                    'maritalStatus' => $validatedData[$childName . 'MaritalStatus']
                );
                
                $arrayData['FamilyDependant']['children_details'][$childName] = $childData;
            }
        }

        if (isset($arrayData['FamilyDependant']['parents'])) {
            foreach ($arrayData['FamilyDependant']['parents'] as $key => $parentsName) {
                $parentsData = array(
                    'firstName' => $validatedData[$parentsName . 'FirstName'],
                    'lastName' => $validatedData[$parentsName . 'LastName'],
                    'yearsOfSupport' => $validatedData[$parentsName . 'YearsOfSupport'],
                    'day' => $validatedData[$parentsName . 'day'],
                    'month' => $validatedData[$parentsName . 'month'],
                    'year' => $validatedData[$parentsName . 'year'],
                    'maritalStatus' => $validatedData[$parentsName . 'MaritalStatus'],
                );
                $arrayData['FamilyDependant']['parents_details'][$parentsName] = $parentsData;
            }
        }

        if (isset($arrayData['FamilyDependant']['siblings']) && $arrayData['FamilyDependant']['siblings']['status'] === 'yes') {
            $arrayData['FamilyDependant']['siblings']['firstName'] = $validatedData['siblingFirstName'];
            $arrayData['FamilyDependant']['siblings']['lastName'] = $validatedData['siblingLastName'];
            $arrayData['FamilyDependant']['siblings']['yearsOfSupport'] = $validatedData['siblingYearsOfSupport'];
            $arrayData['FamilyDependant']['siblings']['day'] = $validatedData['siblingday'];
            $arrayData['FamilyDependant']['siblings']['month'] = $validatedData['siblingmonth'];
            $arrayData['FamilyDependant']['siblings']['year'] = $validatedData['siblingyear'];
            $arrayData['FamilyDependant']['siblings']['maritalStatus'] = $validatedData['siblingMaritalStatus'];
        }
        
        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);

        Log::debug($arrayData);
        // Process the form data and perform any necessary actions
        return redirect()->route('avatar.my.assets');
    }
}
