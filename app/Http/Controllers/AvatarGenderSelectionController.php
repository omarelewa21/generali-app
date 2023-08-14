<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;

class AvatarGenderSelectionController extends Controller
{
    public function newChangeImage(Request $request)
    {
        $gender = $request->input('genderSelection');

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        // Determine the image based on the selected gender
        if ($gender === 'Female') {
            $storedImage = 'gender-female';
            // Store the updated image in the session
            $arrayData['genderSelection'] = $storedImage;
        } elseif ($gender === 'Male') {
            $storedImage = 'gender-male';
            // Store the updated image in the session
            $arrayData['genderSelection'] = $storedImage;
        } else {
            // Handle other cases if needed
            $storedImage = 'default-image';
            // Store the updated image in the session
            $arrayData['genderSelection'] = $storedImage;
        }

         // Store the updated array back into the session
         session(['passingArrays' => $arrayData]);

         // Log the session data to the Laravel log file
         \Log::info('Session Data:', $arrayData);

        return redirect()->route('identity.details');
    }

}