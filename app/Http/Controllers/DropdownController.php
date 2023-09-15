<?php 

namespace App\Http\Controllers;

use App\Models\Occupation;
use App\Models\Country;
use App\Models\Title;
use App\Models\IDType;
use App\Models\educationLevel;
use App\Models\maritalStatus;

class DropdownController extends Controller
{
    public function titles()
    {
        $countries = Country::all();
        $titles = Title::all();
        return view('pages/main/basic-details', compact('titles','countries'));
    }

    public function identityDetails()
    {
        $countries = Country::all();
        $idtypes = IDType::all();
        $occupations = Occupation::all();
        $educationLevels = educationLevel::all();
        return view('pages/avatar/identity-details', compact('countries', 'idtypes', 'occupations', 'educationLevels'));
    }

    public function familyDependantDetails()
    {
        $maritalstatuses = maritalStatus::all();
        return view('pages/avatar/avatar-family-dependant-details', compact('maritalstatuses'));
    }
}
