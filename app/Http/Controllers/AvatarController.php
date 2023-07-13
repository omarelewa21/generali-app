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
        $color = $request->input('color');
    
        // Retrieve the stored gender and image from the session
        $storedGender = session('gender');
        $storedImage = session('image');

        // Update the stored gender if a new gender is selected
        if ($gender !== null) {
            $storedGender = $gender;
        }
    
        // Update the stored image based on the selected gender
        if ($storedGender === 'female') {
            $storedImage = 'gender-female';
        } elseif ($storedGender === 'male') {
            $storedImage = 'gender-male';
        } else {
            $storedImage;
        }
    
        // Perform any necessary logic based on the selected gender and color
    
        if ($storedGender === 'female' && $color !== null) {
            $storedImage .= '-color-' . $color;
        } elseif ($storedGender === 'female' && $color === null) {
            $storedImage;
        } elseif ($storedGender === 'male' && $color !== null) {
            $storedImage .= '-color-' . $color;
        } elseif ($storedGender === 'male' && $color === null) {
            $storedImage;
        } else {
            $storedImage;
        }
    
        // Store the updated gender and image in the session
        session(['gender' => $storedGender, 'image' => $storedImage]);
     
        return response()->json([
            'image' => asset('images/avatar/' . $storedImage . '.svg'),
            'gender' => $storedGender,
            'storedImage' => $storedImage,
            'storedGender' => $storedGender
        ]);
    } 
}