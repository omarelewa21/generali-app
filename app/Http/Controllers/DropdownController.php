<?php 

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Title;
use App\Models\Avatar;
use App\Models\Idtype;
use App\Models\Company;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Occupation;
use App\Models\PolicyPlan;
use App\Models\PremiumMode;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\maritalStatus;
use App\Models\EducationLevel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DropdownController extends Controller
{
    public function titles(Request $request)
    {
        $countries = Country::all();
        $titles = Title::all();
        $transactionId = $request->input('transaction_id');

        // Check if 'transaction_id' is not empty in the current request
        if (!empty($transactionId)) {
            // Set session variable 'transaction_id' to the value of 'transaction_id' from the current request
            session(['transaction_id' => $transactionId]);
        }  else {
            // If 'transaction_id' is not present in both the current request and session, set it to null
            if (session()->has('transaction_id')) {
                $transactionId = session('transaction_id');
            }
            else
            {
                $transactionId = null;
            }
        }

        $basicDetails = optional(Transaction::with('customer')->where('id',$transactionId)->first())->customer;

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
        $idtypes = Idtype::all();
        $occupations = Occupation::all();
        $educationLevels = EducationLevel::all();
        $transactionId = $request->input('transaction_id') ?? session('transaction_id');

        // Check if 'transaction_id' is not empty in the current request
        if (!empty($transactionId)) {
            // Set session variable 'transaction_id' to the value of 'transaction_id' from the current request
            session(['transaction_id' => $transactionId]);
        }  else {
            // If 'transaction_id' is not present in both the current request and session, set it to null
            if (session()->has('transaction_id')) {
                $transactionId = session('transaction_id');
            }
            else
            {
                $transactionId = null;
            }
        }

        $basicDetails = optional(Transaction::with('customer')->where('id',$transactionId)->first())->customer;

        if($basicDetails){

            session(['customer_details.identity_details' => $basicDetails]);
            return view('pages/avatar/identity-details', compact('countries', 'idtypes', 'occupations', 'educationLevels','basicDetails'));
        }
        else{
            session(['customer_details.identity_details' => []]);
            return view('pages/avatar/identity-details', compact('countries', 'idtypes', 'occupations', 'educationLevels'));
        }
    }

    public function maritalStatus(Request $request)
    {
        $transactionId = $request->input('transaction_id') ?? session('transaction_id');
        
        if(!empty($transactionId)){
            session(['transaction_id' => $transactionId]);

            $customerId = optional(Transaction::with('customer')->where('id',$transactionId)->first())->customer->id;
            session(['customer_id' => $customerId]);
           
        } else {
            $transactionId = null;
        }

        if (!is_null($transactionId)) {
            $avatar = optional(Customer::with('avatar')->where('id',$customerId)->first())->avatar;
            $avatarImage = $avatar->image;
            session(['customer_details.avatar.image' => $avatarImage]);

            $maritalStatus = optional(Transaction::with('customer')->where('id',$transactionId)->first())->customer->marital_status;
            session(['customer_details.identity_details.marital_status' => $maritalStatus]);
        }
         
        return view('pages/avatar/marital-status');
    }

    public function familyDependent(Request $request)
    {
        $familyDependent = [];
        $transactionId = $request->input('transaction_id') ?? session('transaction_id');

        if(!empty($transactionId)){

            session(['transaction_id' => $transactionId]);

            $customerId = optional(Transaction::with('customer')->where('id',$transactionId)->first())->customer->id;

            session(['customer_id' => $customerId]);
           
        } else {
            $transactionId = null;
        }

        if (!is_null($transactionId)) {
            $avatar = optional(Customer::with('avatar')->where('id',$customerId)->first())->avatar;
            $avatarImage = $avatar->image;
            session(['customer_details.avatar.image' => $avatarImage]);

            $maritalStatus = optional(Transaction::with('customer')->where('id',$transactionId)->first())->customer->marital_status;
            session(['customer_details.identity_details.marital_status' => $maritalStatus]);

            $customerSpouse = optional(Customer::with('spouse')->where('id',$customerId)->first())
                                ->spouse->toArray();

            $customerDependent = optional(Customer::with('dependents')->where('id',$customerId)->first())
                                ->dependents->toArray();
            
            
            if ($customerSpouse) {
                session(['customer_details.family_details.spouse' => true ]); 
                session(['customer_details.family_details.spouse_data' => $customerSpouse ]);   
            }
 
            if ($customerDependent) {

                foreach ($customerDependent as $dependent) {
    
                    if($dependent['relation'] == 'Father' || $dependent['relation'] == 'Mother')
                    {
                        $parentData[lcfirst($dependent['relation'])] = $dependent;
                    }
                    elseif ($dependent['relation'] == 'Sibling') 
                    {
                        $siblingData = $dependent;
                    }
                    else // child 
                    {
                        $childData[strtolower(str_replace(' ', '_', $dependent['relation']))] = $dependent;
                    }
                }
        
                $familyDependent['children_data'] = $childData;
                $familyDependent['parents_data'] = $parentData;
                $familyDependent['siblings_data'] = $siblingData;
            
                foreach ($familyDependent as $key => $value) {
                    if (isset($value)) {
                
                        $substring = strstr($key, '_data',true);
                        session(['customer_details.family_details.' . $substring => true]);
                        session(['customer_details.family_details.' . $key => $value]);
                    }
                }
            }
        }

        return view('pages/avatar/family-dependent');
    }

    public function familyDependentDetails(Request $request)
    {
        $maritalstatuses = maritalStatus::all();
        $titles = Title::all();
        $countries = Country::all();
        $idtypes = Idtype::all();
        $occupations = Occupation::all();
        $transactionId = $request->input('transaction_id');

        $childData = [];
        $siblingData = [];
        $parentData = [];
        $familyDetail = [];
        
        if (!empty($transactionId)) {
            // Set session variable 'transaction_id' to the value of 'transaction_id' from the current request
            session(['transaction_id' => $transactionId]);
        }  else {
            // If 'transaction_id' is not present in both the current request and session, set it to null
            if (session()->has('transaction_id')) {
                $transactionId = session('transaction_id');
            }
            else
            {
                $transactionId = null;
            }
        }

        $basicDetails = optional(Transaction::with('customer')->where('id',$transactionId)->first())->customer;
       
        if ($basicDetails) {

            $customerId = $basicDetails->id ?? "";
            $avatar = optional(Customer::with('avatar')->where('id',$customerId)->first())->avatar;
            $avatarImage = $avatar->image;
            session(['customer_details.avatar.image' => $avatarImage]);

            $customerDependent = optional(Customer::with('dependents')->where('id',$customerId)->first())
                                ->dependents->toArray();
            
            $customerSpouse = optional(Customer::with('spouse')->where('id',$customerId)->first())
                                ->spouse->toArray(); 


            // $maritalstatuses = $basicDetails->marital_status;
            session(['customer_details.identity_details.marital_status' => $basicDetails->marital_status]);

            // $titles = $basicDetails->title;
            session(['customer_details.basic_details.title' => $basicDetails->title]);
            session(['customer_details.basic_details.full_name' => $basicDetails->full_name]);
            session(['customer_details.basic_details.country_code' => $basicDetails->country_code]);
            session(['customer_details.basic_details.mobile_number' => $basicDetails->mobile_number]);
            session(['customer_details.basic_details.house_phone_number_country_code' => $basicDetails->house_phone_number_country_code]);
            session(['customer_details.basic_details.house_phone_number' => $basicDetails->house_phone_number]);
            session(['customer_details.basic_details.email' => $basicDetails->email]);

            // $countries = $basicDetails->country;
            session(['customer_details.identity_details.country' => $basicDetails->country]);

            // $idtypes = $basicDetails->id_type;
            session(['customer_details.identity_details.id_type' => $basicDetails->id_type]);

            // $occupations = $basicDetails->occupation;
            session(['customer_details.identity_details.occupation' => $basicDetails->occupation]);
        }

        if ($customerSpouse) {
            session(['customer_details.family_details.spouse_data' => $customerSpouse ]); 
        }

        if ($customerDependent) {

            foreach ($customerDependent as $dependent) {

                if($dependent['relation'] == 'Father' || $dependent['relation'] == 'Mother')
                {
                    $parentData[lcfirst($dependent['relation'])] = $dependent;
                }
                elseif ($dependent['relation'] == 'Sibling') 
                {
                    $siblingData = $dependent;
                }
                else // child 
                {
                    $childData[strtolower(str_replace(' ', '_', $dependent['relation']))] = $dependent;
                }
            }
    
            $familyDetail['children_data'] = $childData;
            $familyDetail['parents_data'] = $parentData;
            $familyDetail['siblings_data'] = $siblingData;

            session(['customer_details.family_details.children' => true]);
            session(['customer_details.family_details.spouse' => true]);

            session(['customer_details.family_details.children_data'=>  $familyDetail['children_data']]);
            session(['customer_details.family_details.parents_data'=>  $familyDetail['parents_data']]);
            session(['customer_details.family_details.siblings_data'=>  $familyDetail['siblings_data']]);
        }

        return view('pages/avatar/family-dependent-details', compact('maritalstatuses', 'titles', 'countries', 'idtypes', 'occupations'));
    }

    public function assets(Request $request)
    {
        $transactionId = $request->input('transaction_id') ?? session('transaction_id');
        $assetImage = [];

        if(!empty($transactionId)){
            session(['transaction_id' => $transactionId]);

            $customerId = optional(Transaction::with('customer')->where('id',$transactionId)->first())->customer->id;
            session(['customer_id' => $customerId]);
            // $assetDetails = Customer::with('asset')->find($customerId);
            // $assetImage = $assetDetails->asset;
            
        } else {  
            $transactionId = null;
        }

        if(!is_null($transactionId))
        {
            $avatar = optional(Customer::with('avatar')->where('id',$customerId)->first())->avatar;
            $avatarImage = $avatar->image;
            $avatarGender = $avatar->gender;
             $assetDetails = Customer::with('asset')->find($customerId);
            $assetImage = $assetDetails->asset;

            //if data found, set the corresponding session data to frontend
            session(['customer_details.avatar.image' => $avatarImage]);
            session(['customer_details.avatar.gender' => $avatarGender]);
            session(['customer_details.assets.car'=> $assetImage->car]);
            session(['customer_details.assets.scooter'=> $assetImage->scooter]);
            session(['customer_details.assets.house'=> $assetImage->house]);
            session(['customer_details.assets.bungalow'=> $assetImage->bungalow]);
        }
        
        return view('pages/avatar/assets', compact('assetImage'));
        
    }

    public function financialPriorities(Request $request)
    {
        $transactionId = $request->input('transaction_id') ?? session('transaction_id');
        $priorityData = [];

        if(!empty($transactionId)){
            session(['transaction_id' => $transactionId]);

            $customerId = optional(Transaction::with('customer')->where('id',$transactionId)->first())->customer->id;
            session(['customer_id' => $customerId]);
           
        } else {
            $transactionId = null;   
        }

        if (!is_null($transactionId)) {
            $priorityDetails = Customer::with('priorities')->find($customerId);
            $customerPriority = $priorityDetails->priorities;

            foreach ($customerPriority as $cpValue) {
                $priorityData[$cpValue['sequence']-1] = $cpValue['priority'];
            }
            ksort($priorityData);
            session(['customer_details.priorities_level' => $priorityData]);

            $avatar = optional(Customer::with('avatar')->where('id',$customerId)->first())->avatar;
            $avatarImage = $avatar->image;
            session(['customer_details.avatar.image' => $avatarImage]);
        }
        return view('pages/priorities/top-priorities',compact('priorityData'));
    
    }
    public function financialPrioritiesDiscuss(Request $request)
    {
        $transactionId = $request->input('transaction_id') ?? session('transaction_id');
        $prioritiesDiscuss = [];

        if(!empty($transactionId)){
            session(['transaction_id' => $transactionId]);

            $customerId = optional(Transaction::with('customer')->where('id',$transactionId)->first())->customer->id;
            session(['customer_id' => $customerId]);
           
        } else {
            $transactionId = null;   
        }

        if (!is_null($transactionId)) {
            $priorityDetails = Customer::with('priorities')->find($customerId);
            $customerPriority = $priorityDetails->priorities;

            foreach ($customerPriority as $cpValue) {
                $prioritiesDiscuss[$cpValue['sequence']-1] = $cpValue['priority'];
            }
            ksort($prioritiesDiscuss);
            session(['customer_details.priorities_level' => $prioritiesDiscuss]);
            session(['customer_details.priorities' => $prioritiesDiscuss]);

            $avatar = optional(Customer::with('avatar')->where('id',$customerId)->first())->avatar;
            $avatarImage = $avatar->image;
            session(['customer_details.avatar.image' => $avatarImage]);
            
        }
        
        return view('pages/priorities/priorities-discuss',compact('prioritiesDiscuss'));
    
    }

    public function protectionCoverage(Request $request)
    {
        $transactionId = $request->input('transaction_id') ?? session('transaction_id');
        $protectionCoverageData = [];

        if (!empty($transactionId)) {
            session(['transaction_id' => $transactionId]);
            $customerId = optional(Transaction::with('customer')->where('id',$transactionId)->first())->customer->id;
            session(['customer_id' => $customerId]);
        }
        else{
            $transactionId = null;
        }

        if (!is_null($transactionId)) {

            $basicDetails = optional(Transaction::with('customer')->where('id',$transactionId)->first())->customer;

            if(isset($basicDetails)){
                session(['customer_details.basic_details' => $basicDetails->toArray()]);
                session(['customer_details.identity_details' => $basicDetails->toArray()]);
            }

            $prioritySequence = Customer::whereHas('priorities', function ($query) use ($customerId) {
                $query->where('priority', 'protection');
            })->find($customerId)->priorities()->where('priority', 'protection')->get()->toArray();

            if(isset ($prioritySequence['priority']))
            {
                session(['customer_details.priorities.protection_discuss' => true]);
            }

            $customerSpouse = optional(Customer::with('spouse')->where('id',$customerId)->first())
                                ->spouse->toArray();

            $customerDependent = optional(Customer::with('dependents')->where('id',$customerId)->first())
                                ->dependents->toArray();
            
            if ($customerSpouse) {
                session(['customer_details.family_details.spouse' => true ]); 
                session(['customer_details.family_details.spouse_data' => $customerSpouse ]);   
                session(['customer_details.family_details.dependent.spouse_data' => $customerSpouse]);
            }

            if ($customerDependent) {

                foreach ($customerDependent as $dependent) {
    
                    if($dependent['relation'] == 'Father' || $dependent['relation'] == 'Mother')
                    {
                        $parentData[lcfirst($dependent['relation'])] = $dependent;
                    }
                    elseif ($dependent['relation'] == 'Sibling') 
                    {
                        $siblingData = $dependent;
                    }
                    else // child 
                    {
                        $childData[strtolower(str_replace(' ', '_', $dependent['relation']))] = $dependent;
                    }
                }
        
                $familyDependent['children_data'] = $childData;
                $familyDependent['parents_data'] = $parentData;
                $familyDependent['siblings_data'] = $siblingData;
            
                foreach ($familyDependent as $key => $value) {
                    if (isset($value)) {
                
                        $substring = strstr($key, '_data',true);
                        session(['customer_details.family_details.' . $substring => true]);
                        session(['customer_details.family_details.' . $key => $value]);
                    }
                }
              
                $existingData = session('customer_details.family_details.dependent', []);

                session(['customer_details.family_details.dependent.children_data' => $childData]);
                $childArray = session('customer_details.family_details.dependent.children_data');

                array_merge_recursive($existingData, $childArray);
            }
        }

        return view('pages/priorities/protection/coverage');
    }


    public function existingPolicy()
    {
        $companies = Company::all();
        $policyPlans = PolicyPlan::all();
        $premiumModes = PremiumMode::all();
        return view('pages/summary/existing-policy', compact('companies', 'policyPlans','premiumModes'));
    }
}
