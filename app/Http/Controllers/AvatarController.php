<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CustomerService;
use Illuminate\Support\Facades\Log;
use App\Services\TransactionService;
use Illuminate\Support\Facades\Validator;
use App\Services\AvatarService;

class AvatarController extends Controller
{
    public function changeImage(Request $request,CustomerService $customerService, TransactionService $transactionService,AvatarService $avatarService)
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

        // Determine the latest array key
        $latestKey = array_key_last($customerDetails);

        $customerId = $customerService->handleCustomer($request,$customerDetails,$latestKey);
        $transactionId = $transactionService->handleTransaction($customerId);
        $avatarId = $avatarService->handleAvatar($customerDetails,$customerId);

        $customerDetails = array_merge([
            'transaction_id' => $transactionId,
            'customer_id' => $customerId
        ], $customerDetails);

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);

        return redirect()->route('identity.details');
    } 
}