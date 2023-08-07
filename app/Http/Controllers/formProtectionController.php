<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

use Illuminate\View\View;



class formProtectionController extends Controller
{

    public function submitProtectionMonthlySupport(Request $request): RedirectResponse
    {
        $customMessages = [
            'protectionFunds.required' => 'Please fill in the amount of monthly support you would like to provide',
            'protectionFunds.min' => 'Please enter a value greater than 0',
            'protectionFunds.max' => 'Please enter a value less than 120',
        ];
        $validatedData = $request->validate([
            'protectionFunds' => 'required|min:1|max:120',
        ], $customMessages);
    
        return redirect()->route('protection.supporting.years');
    }


    
}
