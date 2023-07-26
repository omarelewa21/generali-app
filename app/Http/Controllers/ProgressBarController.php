<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgressBarController extends Controller
{
    public function progressBarLoading()
    {
        // Your logic to determine the folder name and number of pages goes here
        $folderName = 'retirement'; // Replace with the actual folder name
        $dynamicNumber = 3; // Replace with the actual dynamic number based on the folder pages count
        // $pagesInRetirement
        return view('pages.priorities.retirement.retirement-home', compact('folderName', 'dynamicNumber'));
    }
}
