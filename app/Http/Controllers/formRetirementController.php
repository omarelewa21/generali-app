<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use SebastianBergmann\Environment\Console;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class formRetirementController extends Controller
{
    public function submitRetirementCoverage(Request $request)
    {
        $customMessages = [
            'retirementSelectedAvatar' => 'Please select an option',
        ];
        $validatedData = $request->validate([
            'retirementSelectedAvatar' => 'required|in:self,spouse,children,parent',

        ], $customMessages);

        // Process the form data and perform any necessary actions
        return redirect()->route('retirement.ideal')
        ->withInput(); 
    }


    public function submitRetirementAgeToRetire(Request $request)
    {
        $customMessages = [
            'retirementAgeToRetire.required' => 'You are required to enter the age.',
            'retirementAgeToRetire.integer' => 'The age must be a number',
            'retirementAgeToRetire.min' => 'The age must be at least :min.',
            'retirementAgeToRetire.max' => 'The age must not more than :max.',
        ];
        $validatedData = $request->validate([
            'retirementAgeToRetire' => 'required|integer|min:1|max:100',

        ], $customMessages);

        // Process the form data and perform any necessary actions
        return redirect()->route('retirement.allocated.funds')
        ->withInput(); 
    }
}
