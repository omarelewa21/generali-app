<?php 

namespace App\Http\Controllers;

use App\Models\Occupation;
use App\Models\Country;
use App\Models\Title;
use App\Models\idtype;
use App\Models\educationLevel;
use App\Models\maritalStatus;
use App\Models\Company;
use App\Models\Customer;
use App\Models\PolicyPlan;
use App\Models\PremiumMode;
use App\Models\SessionStorage;
use App\Models\Transaction;
use Illuminate\Http\Request;
class DropdownController extends Controller
{
    public function titles(Request $request)
    {
        $countries = Country::all();
        $titles = Title::all();

        $basicDetails = optional(Transaction::with('customer')->where('id',$request->input('transaction_id'))->first())->customer;

        if($basicDetails)
        {
            return view('pages/main/basic-details', compact('titles','countries','basicDetails'));
        }
        else
        {
            // if transaction not found, back to agent page
            return view('pages/main/basic-details', compact('titles','countries'));
        }
    }

    public function identityDetails(Request $request)
    {
        $countries = Country::all();
        $idtypes = idtype::all();
        $occupations = Occupation::all();
        $educationLevels = educationLevel::all();

        $basicDetails = optional(SessionStorage::where('transaction_id',$request->input('transaction_id')))->value('data');

        if($basicDetails){
            $basicDetails = $basicDetails['identity_details'] ?? '';
        }

        return view('pages/avatar/identity-details', compact('countries', 'idtypes', 'occupations', 'educationLevels','basicDetails'));
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
