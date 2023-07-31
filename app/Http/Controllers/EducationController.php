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
         'educationNumber.regex' => 'The value must be a number.',
     ];

     $validatedData = $request->validate([
      'idType' => 'required|in:New IC,Passport,Birth Certificate,Police / Army,Registration',
      'idNumber' => [
          'nullable',
          Rule::requiredIf(function () use ($request) {
              return !$request->input('passportNumber') && !$request->input('birthCert') && !$request->input('policeNumber') && !$request->input('registrationNumber');
          }),
          'regex:/^\d{6}-\d{2}-\d{4}$/',
      ],
      'passportNumber' => [
          'nullable',
          Rule::requiredIf(function () use ($request) {
              return !$request->input('idNumber') && !$request->input('birthCert') && !$request->input('policeNumber') && !$request->input('registrationNumber');
          }),
          'max:15',
      ],
  ], $customMessages);

      $child_discovered = $request->input('education_other_savings');
      $amount = $request->input('education_saving_amount');

      $storedChoice = session('education_other_savings');
      $storedAmount = session('education_saving_amount');
   }


   // hello testing here
}