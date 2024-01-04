<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\SessionStorage; 

class AvatarController extends Controller
{
    public function changeImage(Request $request)
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

        // Store the updated customer_details array back into the session
        $request->session()->put('customer_details', $customerDetails);
        Log::debug($customerDetails);

        try {
            DB::transaction(function () use ($request,$customerDetails) {
                $sessionStorage = new SessionStorage();
                $sessionStorage->data = json_encode($customerDetails);
                $route = strval(request()->path());
                $sessionStorage->page_route = $route;
                $sessionId = $request->session()->getId();
                $sessionStorage->session_id = $sessionId; 
                $fullName = $customerDetails['basic_details']['full_name'] ?? NULL;

                //if session from request able to match with db then do update
                $dbSessionId = SessionStorage::findSessionId($sessionId)->get();

                if (!empty($dbSessionId)) {
                    SessionStorage::where('session_id',$dbSessionId[0]['session_id'])
                    ->update(['data' => $sessionStorage->data, 
                              'page_route' => $sessionStorage->page_route,
                              'customer_name' => $fullName
                            ]);
                }
                else
                {
                    $sessionStorage->save();
                }               
             
            });
        } catch (\Exception $e) {
            Log::debug($e);
            DB::rollBack();
        }
        return redirect()->route('identity.details');
    } 
}