<?php 

namespace App\Http\Controllers;

use App\Models\Occupation;
use App\Models\Country;
use App\Models\Title;
use App\Models\idtype;
use App\Models\educationLevel;
use App\Models\maritalStatus;
use App\Models\Company;
use App\Models\PolicyPlan;
use App\Models\PremiumMode;

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
        $idtypes = idtype::all();
        $occupations = Occupation::all();
        $educationLevels = educationLevel::all();
        return view('pages/avatar/identity-details', compact('countries', 'idtypes', 'occupations', 'educationLevels'));
    }

    public function familyDependentDetails()
    {
        $maritalstatuses = maritalStatus::all();
        $titles = Title::all();
        $countries = Country::all();
        $idtypes = idtype::all();
        $occupations = Occupation::all();
        return view('pages/avatar/family-dependent-details', compact('maritalstatuses', 'titles', 'countries', 'idtypes', 'occupations'));
    }

    public function existingPolicy()
    {
        $companies = Company::all();
        $policyPlans = PolicyPlan::all();
        $premiumModes = PremiumMode::all();
        return view('pages/summary/existing-policy', compact('companies', 'policyPlans','premiumModes'));
    }
}
