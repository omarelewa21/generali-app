<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class formValidateRetirementNeeds extends Controller
{
    public function submitRetirementAgeToRetire (Request $request)
    {

        $customMessages = [
            'ageToRetire.regex' => 'Age must be in numbers only',
        ];

        $validatedData = $request->validate([
            'ageToRetire' => 'required',

        ], $customMessages);

        // Process the form data and perform any necessary actions
        return redirect()->route('retirement.allocated.funds');
    }
}
