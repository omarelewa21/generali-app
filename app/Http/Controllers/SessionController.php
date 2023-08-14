<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function clearSessionData()
    {
        Session::flush();
        return response()->json(['message' => 'Session data cleared.']);
    }
}
