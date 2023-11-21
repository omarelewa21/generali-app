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
    
    public function getSessionData(Request $request)
    {
        // Retrieve session data
        $sessionData = $request->session()->all();

        // Return session data as JSON response
        return response()->json($sessionData);
    }
}
