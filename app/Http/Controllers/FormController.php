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
    public function saveButtonClick(Request $request)
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

    public function submit(Request $request)
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
            'btnradio' => 'required|in:smoker,nonSmoker',
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

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);

        Log::debug($arrayData);

        // // Process the form data and perform any necessary actions
        return redirect()->route('avatar.marital.status');
    }

    public function validateAvatar(Request $request)
    {
        $request->validate([
            'data-required' => 'required|in:selected',
        ]);

        return response()->json([
            'validationPassed' => true,
        ]);
    }
    public function handleAvatarSelection(Request $request)
    {
        // Get the selected avatar from the hidden input field
        $selectedMaritalStatus = $request->input('selectedAvatarInput');
        $dataUrl = $request->input('urlInput');
        $selectedFamilies = $request->input('selectedFamilies');
        Log::debug($request->all());
        Log::debug($selectedFamilies);

        // You can access the data for each entry like this:
        // foreach ($selectedFamilies as $family) {
        //     $key = $family['key'];
        //     $value = $family['value'];
        // }

        // Perform any additional actions based on the validation result.
        // For example, you can save the selection to the database.

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        // Add or update the value in the array
        if ($selectedMaritalStatus !== null) {
            // If not equal to null, then replace the data in $arrayData['maritalStatus']
            $arrayData['maritalStatus'] = $selectedMaritalStatus;
        }
        //$arrayData['families'] = $value;

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);

        // Log the session data to the Laravel log file
        \Log::info('Session Data:', $arrayData);

        return redirect()->route($dataUrl);
    }
}
