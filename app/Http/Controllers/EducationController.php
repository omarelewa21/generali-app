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

class EducationController extends Controller
{
   public function submitEducationNeeds(Request $request){

      $customMessages = [
         'educationSupportingAge.regex' => 'The age field must match the format 123456-78-9012.',
         'passportNumber.max' => 'The passport number field must not exceed :max characters.',
         'birthCert.max' => 'The birth certificate field must not exceed :max characters.',
         'policeNumber.max' => 'The police number field must not exceed :max characters.',
         'registrationNumber.max' => 'The registration number field must not exceed :max characters.',
         'btnradio.required' => 'Please select your habits.',
     ];

      $child_discovered = $request->input('education_other_savings');
      $amount = $request->input('education_saving_amount');

      $storedChoice = session('education_other_savings');
      $storedAmount = session('education_saving_amount');
   }

}