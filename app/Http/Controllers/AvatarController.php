<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AvatarController extends Controller
{
    public function changeImage(Request $request)
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

        $validator = Validator::make($request->all(), [
            'genderSelection' => [
                'at_least_one_selected',
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validation passed, perform any necessary processing.
        // Add or update the data value in the array
        $genderSelection = $request->input('genderSelection');
        $genderImage = $request->input('genderImage');
        $skintone = $request->input('skinSelection');

        if ($genderSelection) {
            $arrayData['Gender'] = $genderSelection;
        }

        if ($genderImage !== null) {
            $arrayData['AvatarImage'] = $genderImage; 
        }

        if ($skintone !== null) {
            $arrayData['SkinTone'] = $skintone; 
        }

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);
        
        return redirect()->route('identity.details');
    } 
}