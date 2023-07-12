<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function submit(Request $request)
    {
        $validatedData = $request->validate([
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'title' => 'required|in:Mr.,Ms.,Mrs.,Madam,Datuk,Datin,Dato Seri,Datin Seri,Tan Sri,Puan Sri,Dr.,Tun,Sir,Justice,Others',
            'mobileNumber' => 'required|regex:/^0\d{10}$/',
            'housePhoneNumber' => 'nullable|regex:/^0\d{10}$/',
            'email' => 'required|email|max:255',

        ]);

        // Process the form data and perform any necessary actions

        return redirect()->route('avatar.welcome');
    }
}
