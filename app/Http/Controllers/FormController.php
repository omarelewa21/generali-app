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
    
        $validatedData = $request->validate([
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'title' => 'required|in:' . implode(',', $titles),
            'mobileNumber' => 'required|regex:/^[1-9]\d{8,9}$/',
            'housePhoneNumber' => 'nullable|regex:/^[1-9]\d{8,9}$/',
            'email' => 'required|email|max:255',
        ]);

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        // Add or update the data value in the array
        $arrayData['Title'] = $validatedData['title'];
        $arrayData['FirstName'] = $validatedData['firstName'];
        $arrayData['LastName'] = $validatedData['lastName'];
        $arrayData['MobileNumber'] = $validatedData['mobileNumber'];
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

            if (isset($decodedValue['spouse']) && $decodedValue['spouse'] === 'yes' || !empty($decodedValue['children']) || !empty($decodedValue['parents']) || isset($decodedValue['siblings']) && $decodedValue['siblings'] === 'yes') {
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
            // 'familyDependantButtonInput' => [
            //     'at_least_one_selected_family',
            // ],
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validation passed, perform any necessary processing.
        $maritalStatusButtonInput = $request->input('maritalStatusButtonInput');
        $familyDependantSerialized = $request->input('familyDependantButtonInput');
        $familyDependantButtonInput = json_decode($familyDependantSerialized, true);
        $dataUrl = $request->input('urlInput');

        // Add or update the data value in the array
        if ($maritalStatusButtonInput) {
            $arrayData['MaritalStatus'] = $maritalStatusButtonInput;
        }
        elseif ($familyDependantButtonInput) {
            $arrayData['FamilyDependant'] = $familyDependantButtonInput;
        }

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);
        return redirect()->route($dataUrl);
    }

    public function familyDependantDetails(Request $request)
    {
        // Fetch spouseMaritalStatus from the database
        $maritalStatus = DB::table('marital_statuses')->pluck('maritalStatus')->toArray();

        $validatedData = $request->validate([
            'spouseFirstName' => 'sometimes|required|max:255',
            'spouseLastName' => 'sometimes|required|max:255',
            'spouseYearsOfSupport' => 'sometimes|required|numeric|max:100',
            'spouseday' => 'sometimes|required',
            'spousemonth' => 'sometimes|required',
            'spouseyear' => 'sometimes|required',
            'spouseMaritalStatus' => 'required_with:spouseFirstName|in:' . implode(',', $maritalStatus),
            'child_1FirstName' => 'sometimes|required|max:255',
            'child_1LastName' => 'sometimes|required|max:255',
            'child_1YearsOfSupport' => 'sometimes|required|numeric|max:100',
            'child_1day' => 'sometimes|required',
            'child_1month' => 'sometimes|required',
            'child_1year' => 'sometimes|required',
            'child_1MaritalStatus' => 'required_with:child_1FirstName|in:' . implode(',', $maritalStatus),
            'child_2FirstName' => 'sometimes|required|max:255',
            'child_2LastName' => 'sometimes|required|max:255',
            'child_2YearsOfSupport' => 'sometimes|required|numeric|max:100',
            'child_2day' => 'sometimes|required',
            'child_2month' => 'sometimes|required',
            'child_2year' => 'sometimes|required',
            'child_2MaritalStatus' => 'required_with:child_2FirstName|in:' . implode(',', $maritalStatus),
            'parent_1FirstName' => 'sometimes|required|max:255',
            'parent_1LastName' => 'sometimes|required|max:255',
            'parent_1YearsOfSupport' => 'sometimes|required|numeric|max:100',
            'parent_1day' => 'sometimes|required',
            'parent_1month' => 'sometimes|required',
            'parent_1year' => 'sometimes|required',
            'parent_1MaritalStatus' => 'required_with:child_2FirstName|in:' . implode(',', $maritalStatus),
            'parent_2FirstName' => 'sometimes|required|max:255',
            'parent_2LastName' => 'sometimes|required|max:255',
            'parent_2YearsOfSupport' => 'sometimes|required|numeric|max:100',
            'parent_2day' => 'sometimes|required',
            'parent_2month' => 'sometimes|required',
            'parent_2year' => 'sometimes|required',
            'parent_2MaritalStatus' => 'required_with:child_2FirstName|in:' . implode(',', $maritalStatus),
        ]);

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        // // Create the 'familyDependant' array if it doesn't exist
        // if (!isset($arrayData['FamilyDependant'])) {
        //     $arrayData['FamilyDependant'] = [];
        // }

        if ($arrayData['FamilyDependant']['spouse']['status'] === 'yes') {
            $arrayData['FamilyDependant']['spouse']['FirstName'] = $validatedData['spouseFirstName'];
            $arrayData['FamilyDependant']['spouse']['LastName'] = $validatedData['spouseLastName'];
            $arrayData['FamilyDependant']['spouse']['YearsOfSupport'] = $validatedData['spouseYearsOfSupport'];
            $arrayData['FamilyDependant']['spouse']['Day'] = $validatedData['spouseday'];
            $arrayData['FamilyDependant']['spouse']['Month'] = $validatedData['spousemonth'];
            $arrayData['FamilyDependant']['spouse']['Year'] = $validatedData['spouseyear'];
            $arrayData['FamilyDependant']['spouse']['MaritalStatus'] = $validatedData['spouseMaritalStatus'];
        }
        elseif (isset($arrayData['FamilyDependant']['children'])) {
            Log::debug('yes');
            foreach ($validatedData['children'] as $key => $childData) {
                $arrayData['FamilyDependant']['children'][$key]['FirstName'] = $childData['FirstName'];
                $arrayData['FamilyDependant']['children'][$key]['LastName'] = $childData['LastName'];
                $arrayData['FamilyDependant']['children'][$key]['YearsOfSupport'] = $childData['YearsOfSupport'];
                $arrayData['FamilyDependant']['children'][$key]['Day'] = $childData['day'];
                $arrayData['FamilyDependant']['children'][$key]['Month'] = $childData['month'];
                $arrayData['FamilyDependant']['children'][$key]['Year'] = $childData['year'];
                $arrayData['FamilyDependant']['children'][$key]['MaritalStatus'] = $childData['MaritalStatus'];
            }
        }

        // foreach ($arrayData['FamilyDependant'] as $accordion) {
        //     if ($accordion === 'yes') {
                
        //     } elseif ($accordion === 'child_1') {
        //         $arrayData['familyDependant'][$accordion]['FirstName'] = $validatedData['child_1FirstName'];
        //         $arrayData['familyDependant'][$accordion]['LastName'] = $validatedData['child_1LastName'];
        //         $arrayData['familyDependant'][$accordion]['YearsOfSupport'] = $validatedData['child_1YearsOfSupport'];
        //         $arrayData['familyDependant'][$accordion]['Day'] = $validatedData['child_1day'];
        //         $arrayData['familyDependant'][$accordion]['Month'] = $validatedData['child_1month'];
        //         $arrayData['familyDependant'][$accordion]['Year'] = $validatedData['child_1year'];
        //         $arrayData['familyDependant'][$accordion]['MaritalStatus'] = $validatedData['child_1MaritalStatus'];
        //     } elseif ($accordion === 'child_2') {
        //         $arrayData['familyDependant'][$accordion]['FirstName'] = $validatedData['child_2FirstName'];
        //         $arrayData['familyDependant'][$accordion]['LastName'] = $validatedData['child_2LastName'];
        //         $arrayData['familyDependant'][$accordion]['YearsOfSupport'] = $validatedData['child_2YearsOfSupport'];
        //         $arrayData['familyDependant'][$accordion]['Day'] = $validatedData['child_2day'];
        //         $arrayData['familyDependant'][$accordion]['Month'] = $validatedData['child_2month'];
        //         $arrayData['familyDependant'][$accordion]['Year'] = $validatedData['child_2year'];
        //         $arrayData['familyDependant'][$accordion]['MaritalStatus'] = $validatedData['child_2MaritalStatus'];
        //     } elseif ($accordion === 'parent_1') {
        //         $arrayData['familyDependant'][$accordion]['FirstName'] = $validatedData['parent_1FirstName'];
        //         $arrayData['familyDependant'][$accordion]['LastName'] = $validatedData['parent_1LastName'];
        //         $arrayData['familyDependant'][$accordion]['YearsOfSupport'] = $validatedData['parent_1YearsOfSupport'];
        //         $arrayData['familyDependant'][$accordion]['Day'] = $validatedData['parent_1day'];
        //         $arrayData['familyDependant'][$accordion]['Month'] = $validatedData['parent_1month'];
        //         $arrayData['familyDependant'][$accordion]['Year'] = $validatedData['parent_1year'];
        //         $arrayData['familyDependant'][$accordion]['MaritalStatus'] = $validatedData['parent_1MaritalStatus'];
        //     } elseif ($accordion === 'parent_2') {
        //         $arrayData['familyDependant'][$accordion]['FirstName'] = $validatedData['parent_2FirstName'];
        //         $arrayData['familyDependant'][$accordion]['LastName'] = $validatedData['parent_2LastName'];
        //         $arrayData['familyDependant'][$accordion]['YearsOfSupport'] = $validatedData['parent_2YearsOfSupport'];
        //         $arrayData['familyDependant'][$accordion]['Day'] = $validatedData['parent_2day'];
        //         $arrayData['familyDependant'][$accordion]['Month'] = $validatedData['parent_2month'];
        //         $arrayData['familyDependant'][$accordion]['Year'] = $validatedData['parent_2year'];
        //         $arrayData['familyDependant'][$accordion]['MaritalStatus'] = $validatedData['parent_2MaritalStatus'];
        //     }
        // }
        
        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);

        Log::debug($arrayData);
        // Process the form data and perform any necessary actions
        return redirect()->route('avatar.my.assets');
    }
}
