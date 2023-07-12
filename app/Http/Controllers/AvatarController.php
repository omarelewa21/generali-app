<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;


class AvatarController extends Controller
{
    public function changeImage(Request $request)
    {
        $gender = $request->input('gender');
        Log::debug('Gender: ' . $gender);

        // Perform any necessary logic based on the selected gender
        // if ($gender === 'male') {
        //     // Additional logic for male gender
        //     // For example, you can set a different image path or perform specific actions
        //     return Response::json(['message' => 'male']);
        // }

        return response()->json(['image' => asset('images/avatar/gender-' . ($gender ?? 'male') . '.svg')]);
    }

}
