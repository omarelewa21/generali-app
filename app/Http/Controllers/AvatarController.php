<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\TransactionService;
use Illuminate\Support\Facades\Log;

class AvatarController extends Controller
{
    public function changeImage(Request $request, TransactionService $transactionService)
    {
        // Define custom validation rule for button selection
        Validator::extend('at_least_one_selected', function ($attribute, $value, $parameters, $validator) {
            if ($value !== null && $value === 'Male' || $value === 'Female') {
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

        // Get the existing customer_details array from the session
        $customerDetails = $request->session()->get('customer_details', []);        

        // Add the new array inside the customer_details array
        $customerDetails['avatar'] = [
            'gender' => $genderSelection,
            'image' => $genderImage,
            'skin_tone' => $skintone
        ];
        Log::debug($customerDetails);
        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);

        //use service to update and insert record 
        $transactionService->handleTransaction($request,$customerDetails);
        $transactionData = ['transaction_id' => $request->input('transaction_id')];

        return redirect()->route('identity.details',$transactionData);
    } 
}