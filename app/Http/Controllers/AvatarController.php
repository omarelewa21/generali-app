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
            $svgMainImage = 'gender-female';
        } elseif ($storedGender === 'male') {
            $storedImage = 'gender-male';
            $svgMainImage = 'gender-male';
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

        if ($color !== null) {
            // SVG editing code
            $svgPath = public_path('images/avatar-general/' . $svgMainImage . '.svg');
            $svg = simplexml_load_file($svgPath);
            $svg->registerXPathNamespace('svg', 'http://www.w3.org/2000/svg');

            // Create the first gradient fill element
            $gradient1 = $svg->addChild('linearGradient');
            $gradient1['id'] = 'gradient-fill-1';
            $gradient1['x1'] = '248.557';
            $gradient1['y1'] = '80.3592';
            $gradient1['x2'] = '248.557';
            $gradient1['y2'] = '125.632';
            $gradient1['gradientUnits'] = 'userSpaceOnUse';
            $gradientStop1_1 = $gradient1->addChild('stop');
            $gradientStop1_1['stop-color'] = '#FCD7CB';
            $gradientStop1_2 = $gradient1->addChild('stop');
            $gradientStop1_2['offset'] = '1';
            $gradientStop1_2['stop-color'] = '#' . $color;

            // Create the second gradient fill element
            $gradient2 = $svg->addChild('linearGradient');
            $gradient2['id'] = 'gradient-fill-2';
            $gradient2['x1'] = '270.589';
            $gradient2['y1'] = '81.8994';
            $gradient2['x2'] = '238.193';
            $gradient2['y2'] = '180.996';
            $gradient2['gradientUnits'] = 'userSpaceOnUse';
            $gradientStop2_1 = $gradient2->addChild('stop');
            $gradientStop2_1['stop-color'] = '#FCD7CB';
            $gradientStop2_2 = $gradient2->addChild('stop');
            $gradientStop2_2['offset'] = '1';
            $gradientStop2_2['stop-color'] = '#' . $color;

            // Create the third gradient fill element
            $gradient3 = $svg->addChild('linearGradient');
            $gradient3['id'] = 'gradient-fill-3';
            $gradient3['gradientUnits'] = 'userSpaceOnUse';
            $gradientStop3_1 = $gradient3->addChild('stop');
            $gradientStop3_1['stop-color'] = '#FCD7CB';
            $gradientStop3_2 = $gradient3->addChild('stop');
            $gradientStop3_2['offset'] = '1';
            $gradientStop3_2['stop-color'] = '#' . $color;

            // Create the fourth gradient fill element
            $gradient4 = $svg->addChild('linearGradient');
            $gradient4['id'] = 'gradient-fill-4';
            $gradient4['x1'] = '333.547';
            $gradient4['y1'] = '226.825';
            $gradient4['x2'] = '326.692';
            $gradient4['y2'] = '233.233';
            $gradient4['gradientUnits'] = 'userSpaceOnUse';
            $gradientStop4_1 = $gradient4->addChild('stop');
            $gradientStop4_1['stop-color'] = '#FCD7CB';
            $gradientStop4_2 = $gradient4->addChild('stop');
            $gradientStop4_2['offset'] = '1';
            $gradientStop4_2['stop-color'] = '#' . $color;

            // Create the fifth gradient fill element
            $gradient5 = $svg->addChild('linearGradient');
            $gradient5['id'] = 'gradient-fill-5';
            $gradient5['x1'] = '209.505';
            $gradient5['y1'] = '236.049';
            $gradient5['x2'] = '218.051';
            $gradient5['y2'] = '229.876';
            $gradient5['gradientUnits'] = 'userSpaceOnUse';
            $gradientStop5_1 = $gradient5->addChild('stop');
            $gradientStop5_1['stop-color'] = '#FCD7CB';
            $gradientStop5_2 = $gradient5->addChild('stop');
            $gradientStop5_2['offset'] = '1';
            $gradientStop5_2['stop-color'] = '#' . $color;

            // Update the first path to use the first gradient
            $path1 = $svg->xpath('//svg:path[@d="M209.28 45.6884C209.28 45.6884 202.062 119.057 246.757 119.102C295.907 119.156 287.762 45.6884 287.762 45.6884C287.762 45.6884 287.501 14.3145 248.17 14.3145C212.115 14.3145 209.28 45.6884 209.28 45.6884Z"]');
            $path1[0]['fill'] = 'url(#gradient-fill-1)';

            // Update the second path to use the second gradient
            $path2 = $svg->xpath('//svg:path[@d="M215.346 63.8389C215.346 63.8389 217.02 107.058 215.787 123.362C215.031 133.388 181.262 148.638 181.262 162.375C217.605 165.095 304.367 187.56 304.367 172.58C304.367 157.6 268.618 148.476 267.043 136.324C265.468 124.164 263.254 102.068 263.254 102.068L230.619 96.7712L215.355 63.8389H215.346Z"]');
            $path2[0]['fill'] = 'url(#gradient-fill-2)';

            // Update the third path to use the second gradient
            $path3 = $svg->xpath('//svg:path[@d="M209.352 68.2347C209.352 68.2347 202.151 62.6409 196.841 69.2886C191.027 76.5669 202.862 97.7891 215.076 88.34L209.352 68.2347Z"]');
            $path3[0]['fill'] = 'url(#gradient-fill-3)';
            $path4 = $svg->xpath('//svg:path[@d="M287.023 68.2347C287.023 68.2347 294.223 62.6409 299.533 69.2886C305.347 76.5669 293.512 97.7891 281.299 88.34L287.023 68.2347Z"]');
            $path4[0]['fill'] = 'url(#gradient-fill-3)';

            // Update the fourth path to use the second gradient
            $path5 = $svg->xpath('//svg:path[@d="M312.207 233.914C312.09 233.572 318.202 220.295 318.661 219.493C319.12 218.682 326.239 212.395 326.239 212.395L339.595 210.593C339.595 210.593 341.098 212.494 340.765 215.205C340.711 215.638 329.884 218.232 329.866 218.691C337.426 218.619 345.409 219.484 345.409 219.484C345.409 219.484 348.226 223.042 347.875 225.582C349 227.897 348.802 230.717 347.875 233.122L345.625 232.905C345.625 232.905 346.066 236.121 343.987 238.472C339.955 237.445 335.392 236.77 335.392 236.77C335.392 236.77 329.785 238.941 328.372 239.382C327.04 240.202 326.671 248.444 323.476 249.813C317.473 249.255 312.189 233.905 312.189 233.905L312.207 233.914Z"]');
            $path5[0]['fill'] = 'url(#gradient-fill-4)';

            // Update the fifth path to use the second gradient
            $path5 = $svg->xpath('//svg:path[@d="M223.581 216.304C223.581 216.304 219.45 215.854 217.695 215.764C215.94 215.673 206.049 220.258 206.049 220.258C206.049 220.258 206.49 244.174 219.783 246.903C220.98 245.552 222.465 243.273 223.437 241.589C225.381 241.418 226.119 240.958 226.119 240.958C226.119 240.958 231.654 224.492 223.563 216.304H223.581Z"]');
            $path5[0]['fill'] = 'url(#gradient-fill-5)';

            $newSvgContent = $svg->asXML();
            $modifiedSvgPath = public_path('images/avatar-general/' . $storedImage . '.svg');

            file_put_contents($modifiedSvgPath, $newSvgContent);
        }

        // Store the updated gender and image in the session
        // session(['gender' => $storedGender, 'image' => $storedImage]);

        // Get the existing array from the session
        $arrayData = session('passingArrays', []);

        // Add or update the value in the array
        $arrayData['gender'] = $storedGender;
        $arrayData['image'] = $storedImage;

        // Store the updated array back into the session
        session(['passingArrays' => $arrayData]);
     
        return response()->json([
            'image' => asset('images/avatar-general/' . $storedImage . '.svg'),
            'gender' => $storedGender,
            'storedImage' => $storedImage,
            'storedGender' => $storedGender
        ]);

        // $gender = $request->input('gender');
        // $color = $request->input('color');
        // // $secondaryColor = $request->input('secondaryColor');

        // // Retrieve the stored gender and image from the session
        // $storedGender = session('gender');
        // $storedImage = session('image');

        // // Update the stored gender if a new gender is selected
        // if ($gender !== null) {
        //     $storedGender = $gender;
        // }

        // // Update the stored image based on the selected gender
        // if ($storedGender === 'female') {
        //     $storedImage = 'gender-female';
        //     $svgMainImage = 'gender-female';
        // } elseif ($storedGender === 'male') {
        //     $storedImage = 'gender-male';
        //     $svgMainImage = 'gender-male';
        // } else {
        //     $storedImage;
        //     $svgMainImage = 'gender-male';
        // }

        // // Perform any necessary logic based on the selected gender and color

        // // if ($storedGender === 'female' && $color !== null) {
        // //     $storedImage .= '-color-' . $color;
        // // } elseif ($storedGender === 'female' && $color === null) {
        // //     $storedImage;
        // // } elseif ($storedGender === 'male' && $color !== null) {
        // //     $storedImage .= '-color-' . $color;
        // // } elseif ($storedGender === 'male' && $color === null) {
        // //     $storedImage;
        // // } else {
        // //     $storedImage;
        // // }

        // // SVG editing code
        // $svgPath = public_path('images/avatar/' . $svgMainImage . '.svg');
        // $svg = simplexml_load_file($svgPath);
        // $svg->registerXPathNamespace('svg', 'http://www.w3.org/2000/svg');
        // $path = $svg->xpath('//svg:path[@d="M209.28 45.6884C209.28 45.6884 202.062 119.057 246.757 119.102C295.907 119.156 287.762 45.6884 287.762 45.6884C287.762 45.6884 287.501 14.3145 248.17 14.3145C212.115 14.3145 209.28 45.6884 209.28 45.6884Z"]');
        
        // // Create the gradient fill element
        // $gradient = $svg->addChild('linearGradient');
        // $gradient['id'] = 'gradient-fill';
        // $gradient['gradientTransform'] = 'rotate(90)';
        // $gradientStop1 = $gradient->addChild('stop');
        // $gradientStop1['offset'] = '0%';
        // $gradientStop1['stop-color'] = '#'.$color;
        // $gradientStop2 = $gradient->addChild('stop');
        // $gradientStop2['offset'] = '100%';
        // $gradientStop2['stop-color'] = '#FFFFFF';

        // // Update the fill attribute of the path element to use the gradient
        // $path[0]['fill'] = 'url(#gradient-fill)';

        // $newSvgContent = $svg->asXML();
        // $modifiedSvgPath = public_path('images/avatar/modified.svg');
        // if ($color !== null) {
        //     $imageupdated = asset('images/avatar/modified.svg?cache=' . time());
        // }
        // else {
        //     $imageupdated = asset('images/avatar/' . $svgMainImage . '.svg');
        // }
        // file_put_contents($modifiedSvgPath, $newSvgContent);

        // // Store the updated gender and image in the session
        // session(['gender' => $storedGender, 'image' => $imageupdated]);

        // return response()->json([
        //     'image' => $imageupdated,
        //     'gender' => $storedGender,
        //     'storedImage' => $imageupdated,
        //     'storedGender' => $storedGender
        // ]);
    } 
}