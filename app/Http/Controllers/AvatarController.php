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
        // $gender = $request->input('gender');
        // $color = $request->input('color');
    
        // // Retrieve the stored gender and image from the session
        // $storedGender = session('gender');
        // $storedImage = session('image');

        // Log::debug('gender' . $storedGender);
        // Log::debug('image' . $storedImage);

        // // Update the stored gender if a new gender is selected
        // if ($gender !== null) {
        //     $storedGender = $gender;
        // }
    
        // // Update the stored image based on the selected gender
        // if ($storedGender === 'female') {
        //     $storedImage = 'gender-female';
        // } elseif ($storedGender === 'male') {
        //     $storedImage = 'gender-male';
        // } else {
        //     $storedImage;
        // }
    
        // // Perform any necessary logic based on the selected gender and color
    
        // if ($storedGender === 'female' && $color !== null) {
        //     $storedImage .= '-color-' . $color;
        // } elseif ($storedGender === 'female' && $color === null) {
        //     $storedImage;
        // } elseif ($storedGender === 'male' && $color !== null) {
        //     $storedImage .= '-color-' . $color;
        // } elseif ($storedGender === 'male' && $color === null) {
        //     $storedImage;
        // } else {
        //     $storedImage;
        // }
    
        // // Store the updated gender and image in the session
        // session(['gender' => $storedGender, 'image' => $storedImage]);
     
        // return response()->json([
        //     'image' => asset('images/avatar/' . $storedImage . '.svg'),
        //     'gender' => $storedGender,
        //     'storedImage' => $storedImage,
        //     'storedGender' => $storedGender
        // ]);

        $gender = $request->input('gender');
        $color = $request->input('color');
        // $secondaryColor = $request->input('secondaryColor');
        // Log::debug($secondaryColor);

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
            $svgMainImage = 'gender-female';
        } elseif ($storedGender === 'male') {
            $storedImage = 'gender-male';
            $svgMainImage = 'gender-male';
        } else {
            $storedImage;
            $svgMainImage = 'gender-male';
        }

        // Perform any necessary logic based on the selected gender and color

        // if ($storedGender === 'female' && $color !== null) {
        //     $storedImage .= '-color-' . $color;
        // } elseif ($storedGender === 'female' && $color === null) {
        //     $storedImage;
        // } elseif ($storedGender === 'male' && $color !== null) {
        //     $storedImage .= '-color-' . $color;
        // } elseif ($storedGender === 'male' && $color === null) {
        //     $storedImage;
        // } else {
        //     $storedImage;
        // }

        // SVG editing code
        $svgPath = public_path('images/avatar/' . $svgMainImage . '.svg');
        $svg = simplexml_load_file($svgPath);
        $svg->registerXPathNamespace('svg', 'http://www.w3.org/2000/svg');
        $path = $svg->xpath('//svg:path[@d="M209.28 45.6884C209.28 45.6884 202.062 119.057 246.757 119.102C295.907 119.156 287.762 45.6884 287.762 45.6884C287.762 45.6884 287.501 14.3145 248.17 14.3145C212.115 14.3145 209.28 45.6884 209.28 45.6884Z"]');
        
        // Create the gradient fill element
        $gradient = $svg->addChild('linearGradient');
        $gradient['id'] = 'gradient-fill';
        $gradient['gradientTransform'] = 'rotate(90)';
        $gradientStop1 = $gradient->addChild('stop');
        $gradientStop1['offset'] = '0%';
        $gradientStop1['stop-color'] = '#'.$color;
        $gradientStop2 = $gradient->addChild('stop');
        $gradientStop2['offset'] = '100%';
        $gradientStop2['stop-color'] = '#FFFFFF';

        // Update the fill attribute of the path element to use the gradient
        $path[0]['fill'] = 'url(#gradient-fill)';

        $newSvgContent = $svg->asXML();
        $modifiedSvgPath = public_path('images/avatar/modified.svg');
        if ($color !== null) {
            $imageupdated = asset('images/avatar/modified.svg?cache=' . time());
        }
        else {
            $imageupdated = asset('images/avatar/' . $svgMainImage . '.svg');
        }
        file_put_contents($modifiedSvgPath, $newSvgContent);

        // Store the updated gender and image in the session
        session(['gender' => $storedGender, 'image' => $imageupdated]);

        return response()->json([
            'image' => $imageupdated,
            'gender' => $storedGender,
            'storedImage' => $imageupdated,
            'storedGender' => $storedGender
        ]);
    } 
}