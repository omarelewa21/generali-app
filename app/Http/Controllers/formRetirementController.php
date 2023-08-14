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

        $retirementSelectedAvatar = $request->input('retirementSelectedAvatar');

        Session::put('retirementSelectedAvatar', $retirementSelectedAvatar);

        return redirect()->route('retirement.ideal')
            ->withInput();
    }

public function submitRetirementIdeal(Request $request)
    {
        $customMessages = [
            'retirementIdeal' => 'Please select an option',
        ];
        $validatedData = $request->validate([
            'retirementIdeal' => 'required|in:option 1,option 2,option 3,option 4',

        ], $customMessages);

        $retirementIdeal = $request->input('retirementIdeal');

        Session::put('retirementIdeal', $retirementIdeal);

        return redirect()->route('retirement.age.to.retire')
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

        $retirementAgeToRetire = $request->input('retirementAgeToRetire');
        
        Session::put('retirementAgeToRetire', $retirementAgeToRetire);

        return redirect()->route('retirement.allocated.funds')
        ->withInput(); 
    }
    public function submitRetirementAllocatedFunds(Request $request)
    {
        $customMessages = [
            'retirementAllocatedFunds.required' => 'You are required to enter an amount.',
            'retirementAllocatedFunds.integer' => 'The amount must be a number',
            'retirementAllocatedFunds.min' => 'The amount must be at least :min.',
        ];

        $validatedData = $request->validate([
            'retirementAllocatedFunds' => 'required|integer|min:1',

        ], $customMessages);

        $retirementAllocatedFunds = $request->input('retirementAllocatedFunds');
        
        $TotalRetirementValue = $retirementAllocatedFunds * 12;
        $progressTotalRetirementValue = ($TotalRetirementValue / $TotalRetirementValue) * 100;

        // Format the calculated values for display
        $formattedTotalRetirementValue = 'RM' . number_format($TotalRetirementValue, 2, ',');
        $formattedProgressTotalRetirementValue = number_format($progressTotalRetirementValue, 2, ',');

        Session::put('retirementAllocatedFunds', $retirementAllocatedFunds);
        Session::put('TotalRetirementValue', $formattedTotalRetirementValue);
        

        return redirect()->route('retirement.years.till.retire')    
                ->withInput(); 
    }
    public function submitRetirementYearsTillRetire(Request $request)
    {
        $customMessages = [
            'retirementYearsTillRetire.required' => 'You are required to enter the number of years.',
            'retirementYearsTillRetire.integer' => 'The number of years must be a number',
            'retirementYearsTillRetire.min' => 'The number of years must be at least :min.',
            'retirementYearsTillRetire.max' => 'The number of years must not more than :max.',
        ];
        $validatedData = $request->validate([
            'retirementYearsTillRetire' => 'required|integer|min:1|max:100',

        ], $customMessages);
        $retirementYearsTillRetire = $request->input('retirementYearsTillRetire');

        $TotalRetirementValue = $retirementYearsTillRetire * 12;

        Session::put('TotalRetirementValue', $TotalRetirementValue);
        Session::put('retirementYearsTillRetire', $retirementYearsTillRetire);

        // Process the form data and perform any necessary actions
        return redirect()->route('retirement.allocated.funds.aside')
        ->withInput(); 
    }

    public function submitRetirementAllocatedFundsAside(Request $request)
    {
        $customMessages = [
            'retirementAllocatedFundsAside.required' => 'You are required to enter an amount.',
            'retirementAllocatedFundsAside.integer' => 'The amount must be a number',
            'retirementAllocatedFundsAside.min' => 'The amount must be at least :min.',
            'retirementOtherSourceOfIncome.required' => 'You are required to enter an amount.',
            'retirementOtherSourceOfIncome.integer' => 'The amount must be a number',
            'retirementOtherSourceOfIncome.min' => 'The amount must be at least :min.',
        ];

        $validatedData = $request->validate([
            'retirementAllocatedFundsAside' => 'required|integer|min:1',
            'retirementOtherSourceOfIncome' => 'required|integer|min:1',
        ], $customMessages);

        $retirementYearsTillRetire = $request->input('retirementYearsTillRetire');

        $TotalRetirementValue = $retirementYearsTillRetire * 12;

        Session::put('TotalRetirementValue', $TotalRetirementValue);
        Session::put('retirementYearsTillRetire', $retirementYearsTillRetire);


        return redirect()->route('retirement.gap')    
                ->withInput(); 
    }

}
