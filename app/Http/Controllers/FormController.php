<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AvatarSelectionRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
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

    public function validateButton(Request $request)
    {
        // $request->validate([
        //     'data-required' => 'required|in:selected',
        // ]);

        // return response()->json([
        //     'validationPassed' => true,
        // ]);
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
            
            $customMessage = "At least one button must be selected.";
            $validator->errors()->add($attribute, $customMessage);
    
            return false;
        });

        $validator = Validator::make($request->all(), [
            'selectedButtonInput' => [
                'at_least_one_selected',
            ],
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validation passed, perform any necessary processing...
        // Add or update the data value in the array
        $selectedButtonInput = $request->input('selectedButtonInput');
        $arrayData['maritalStatus'] = $selectedButtonInput;

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);

        $dataUrl = $request->input('urlInput', 'welcome'); // Provide a default route name here
        return redirect()->route($dataUrl);
    }

}
