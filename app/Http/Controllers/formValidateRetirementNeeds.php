<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

use Illuminate\View\View;

class formValidateRetirementNeeds extends Controller
{
    public function submitRetirementAgeToRetire (Request $request): RedirectResponse
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

    public function validateAvatarSelection(Request $request)
    {
        $customMessages = [
            'ageToRetire.regex' => 'Age must be in numbers only',
        ];

        $validatedData = $request->validate([
            'selected_avatar' => 'required|in:self,spouse,kid,parent',

        ], $customMessages);

        // If validation passes, proceed to the next page
        return redirect()->route('retirement.ideal'); // Replace with the appropriate route
    }
}
