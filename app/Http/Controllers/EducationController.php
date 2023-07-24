<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class EducationController extends Controller
{
   public function store(Request $request){
        $child_discovered = $request->input('education_other_savings');
        $amount = $request->input('education_saving_amount');

        $storedChoice = session('education_other_savings');
        $storedAmount = session('education_saving_amount');
   }

}