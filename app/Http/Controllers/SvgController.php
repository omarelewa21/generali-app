<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;


class SvgController extends Controller
{
    public function editSvg()
    {
        // // SVG file path
        // $svgPath = public_path('images/avatar/gender-male.svg');

        // // Load the SVG file using SimpleXML
        // $svg = simplexml_load_file($svgPath);

        // // Register the SVG namespace prefix
        // $svg->registerXPathNamespace('svg', 'http://www.w3.org/2000/svg');

        // // Find the desired path element using XPath with the registered namespace prefix
        // $path = $svg->xpath('//svg:path[@d="M209.28 45.6884C209.28 45.6884 202.062 119.057 246.757 119.102C295.907 119.156 287.762 45.6884 287.762 45.6884C287.762 45.6884 287.501 14.3145 248.17 14.3145C212.115 14.3145 209.28 45.6884 209.28 45.6884Z"]');

        // // Modify the fill attribute of the path element
        // $path[0]['fill'] = '#F5DEB3';

        // // Save the modified SVG content
        // $newSvgContent = $svg->asXML();
        // $modifiedSvgPath = public_path('images/avatar/gender-male.svg');
        // file_put_contents($modifiedSvgPath, $newSvgContent);

        // return response()->json(['message' => 'SVG file has been edited successfully']);
    }
}