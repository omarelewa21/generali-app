<?php 

namespace App\Http\Controllers;

use App\Models\Occupation;
use App\Models\Country;
use App\Models\Title;
use App\Models\IDType;
use App\Models\educationLevel;

class DropdownController extends Controller
{
    public function titles()
    {
        $titles = Title::all();
        return view('pages/main/basic-details', compact('titles'));
    }

    public function identityDetails()
    {
        $countries = Country::all();
        $idtypes = IDType::all();
        $occupations = Occupation::all();
        $educationLevels = educationLevel::all();
        return view('pages/avatar/identity-details', compact('countries', 'idtypes', 'occupations', 'educationLevels'));
    }
}
