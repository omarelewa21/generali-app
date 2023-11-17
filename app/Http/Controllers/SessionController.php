<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class SessionController extends Controller
{
    public function clearSessionData()
    {
        Session::flush();
        return response()->json(['message' => 'Session data cleared.']);
    }

    // public function getSession()
    // {
    //     $data = [
    //         'key' => 'value',
    //         'another_key' => 'another_value',
    //     ];
    //     return view('pages.avatar.avatar-family-dependant')->with($data);
    // }
}
