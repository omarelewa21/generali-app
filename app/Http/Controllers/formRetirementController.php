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

        // Get the existing array from the session
        $arrayDataRetirement = session('passingArraysRetirement', []);
        $arrayDataRetirement['retirementSelectedAvatar'] = $retirementSelectedAvatar;

        // Store the updated array back into the session
        session(['passingArraysRetirement' =>  $arrayDataRetirement]);
        
        Log::info('Session Data:', Session::all());

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

        // Get the existing array from the session
        $arrayDataRetirement = session('passingArraysRetirement', []);

        $arrayDataRetirement['retirementIdeal'] = $retirementIdeal;

        // Store the updated array back into the session
        session(['passingArraysRetirement' =>  $arrayDataRetirement]);

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
        
        // Get the existing array from the session
        $arrayDataRetirement = session('passingArraysRetirement', []);
        
        $arrayDataRetirement['retirementAgeToRetire'] = $retirementAgeToRetire;

        // Store the updated array back into the session
        session(['passingArraysRetirement' =>  $arrayDataRetirement]);

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
            'retirementAllocatedFunds' => 'required|numeric_commas_stripped|min:1',
            

        ], $customMessages);

        $retirementAllocatedFunds = $request->input('retirementAllocatedFunds');

        $retirementAllocatedFunds = (int) preg_replace('/[^\d]/', '', $validatedData['retirementAllocatedFunds']);


        $TotalRetirementValue = $retirementAllocatedFunds * 12;
        // Get the existing array from the session
        $arrayDataRetirement = session('passingArraysRetirement', []);

        //update the array
        $arrayDataRetirement['retirementAllocatedFunds'] = $retirementAllocatedFunds;
        $arrayDataRetirement['TotalRetirementValue'] = $TotalRetirementValue;

        $formattedRetirementAllocatedFunds = number_format($retirementAllocatedFunds, 0, '.', ',');
        $formattedTotalRetirementValue = number_format($TotalRetirementValue, 0,'.', ',');

        $arrayDataRetirement['formattedRetirementAllocatedFunds'] = $formattedRetirementAllocatedFunds;
        $arrayDataRetirement['formattedTotalRetirementValue'] = $formattedTotalRetirementValue;

        // Store the updated array back into the session
        session(['passingArraysRetirement' =>  $arrayDataRetirement]);
        Log::info('Session Data:', Session::all());

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

        // Get the existing array from the session
        $arrayDataRetirement = session('passingArraysRetirement', []);

        $retirementAllocatedFunds = session('passingArraysRetirement.retirementAllocatedFunds');

        $TotalRetirementValue = $retirementAllocatedFunds * 12 * $retirementYearsTillRetire;

        //update the array
        $arrayDataRetirement['retirementAllocatedFunds'] = $retirementAllocatedFunds;
        $arrayDataRetirement['retirementYearsTillRetire'] = $retirementYearsTillRetire;
        $arrayDataRetirement['TotalRetirementValue'] = $TotalRetirementValue;

        $formattedTotalRetirementValue = number_format($TotalRetirementValue, 0,'.', ',');

        $arrayDataRetirement['formattedTotalRetirementValue'] = $formattedTotalRetirementValue;

        // Store the updated array back into the session
        session(['passingArraysRetirement' =>  $arrayDataRetirement]);
        Log::info('Session Data:', Session::all());

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
            'retirementAllocatedFundsAside' => 'required|integer|min:0',
            'retirementOtherSourceOfIncome' => 'required|integer|min:0',
        ], $customMessages);

        $retirementAllocatedFundsAside = $request->input('retirementAllocatedFundsAside');
        $retirementOtherSourceOfIncome = $request->input('retirementOtherSourceOfIncome');

        $retirementAllocatedFundsAsideTotal = $retirementAllocatedFundsAside + $retirementOtherSourceOfIncome ;
        
        $retirementAllocatedFunds = session('passingArraysRetirement.retirementAllocatedFunds');
        $retirementYearsTillRetire = session('passingArraysRetirement.retirementYearsTillRetire');
        $TotalRetirementValue = session('passingArraysRetirement.TotalRetirementValue');

        if ($retirementAllocatedFundsAsideTotal > $TotalRetirementValue){
            $retirementGap = 0;
            $retirementPercentage = 100;
        }
        else {
            $retirementGap = $TotalRetirementValue - $retirementAllocatedFundsAsideTotal;
            $retirementPercentage = intval(($retirementAllocatedFundsAsideTotal / $TotalRetirementValue) * 100);
        }

        // Get the existing array from the session
        $arrayDataRetirement = session('passingArraysRetirement', []);

        //update the array
        $arrayDataRetirement['retirementAllocatedFunds'] = $retirementAllocatedFunds;
        $arrayDataRetirement['retirementYearsTillRetire'] = $retirementYearsTillRetire;
        $arrayDataRetirement['retirementAllocatedFundsAside'] = $retirementAllocatedFundsAside;
        $arrayDataRetirement['retirementOtherSourceOfIncome'] = $retirementOtherSourceOfIncome;
        $arrayDataRetirement['retirementAllocatedFundsAsideTotal'] = $retirementAllocatedFundsAsideTotal;
        $arrayDataRetirement['TotalRetirementValue'] = $TotalRetirementValue;
        $arrayDataRetirement['retirementPercentage'] = $retirementPercentage;
        $arrayDataRetirement['retirementGap'] = $retirementGap;

        $formattedTotalRetirementValue = number_format($TotalRetirementValue, 0,'.', ',');

        $arrayDataRetirement['formattedTotalRetirementValue'] = $formattedTotalRetirementValue;

        // Store the updated array back into the session
        session(['passingArraysRetirement' =>  $arrayDataRetirement]);
        Log::info('Session Data:', Session::all());

        return redirect()->route('retirement.gap')    
                ->withInput(); 
    }

}
