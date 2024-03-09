<?php 

namespace App\Http\Controllers;

use Carbon\Carbon;
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
use Illuminate\Support\Facades\Session;

class DropdownController extends Controller
{
    public function titles(Request $request)
    {
        $countries = Country::all();
        $titles = Title::all();
        $transactionId = $request->input('transaction_id') ?? session('transaction_id'); 
        // dd($transactionId);
        // Check if 'transaction_id' is not empty in the current request
        if (!empty($transactionId)) {

            $transactionId = intval($transactionId) ?? NULL;
            // dd($transactionId);
            if ( is_null($transactionId) || $transactionId == 0)
            {
                $transactionId = NULL;
                $customerId = NULL;

                Session::flush();
                return view('pages/main/basic-details', compact('titles','countries'));
            }   
            else
            {
                $customerId = optional(Transaction::with('customer')->where('id',$transactionId)->first())->customer;

                if(!is_null($customerId))
                {
                    session(['customer_id' => $customerId->id]);
                    session(['transaction_id' => $transactionId]);
                    session(['customer_details.basic_details' => $customerId]);

                    return view('pages/main/basic-details', compact('titles','countries','customerId'));
                }
                else
                {
                    Session::flush();
                    return view('pages/main/basic-details', compact('titles','countries'));
                }
            }

            // $basicDetails = optional(Transaction::with('customer')->where('id',$transactionId)->first())->customer;

            // if($basicDetails)
            // {
            //     return view('pages/main/basic-details', compact('titles','countries','basicDetails'));
            // }
            // else
            // {
            //     // if transaction not found, back to agent page
            //     return view('pages/main/basic-details', compact('titles','countries'));
            // }
        }  else {
            
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
            // cast dob format
            //1995-12-08 00:00:00
            //1995-12-08
            $basicDetails['habits']= $basicDetails['habit'];
            $basicDetails['dob'] = Carbon::parse($basicDetails['dob'])->format('Y-m-d');
            unset($basicDetails['habit']);

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
            $avatarImage = $avatar->image ?? 'images/avatar-general/gender-male.svg';
            session(['customer_details.avatar.image' => $avatarImage]);

            $customer = Customer::with(['spouse', 'dependents'])->find($customerId);

            if ($customer && $customer->spouse) {
                $customerSpouse = $customer->spouse->toArray();
            } else {
                $customerSpouse = []; // Or any other default value you want to assign
            }

            session(['customer_details.family_details.spouse_data' => $customerSpouse]);


            if ($customer && $customer->dependents) {
                $customerDependent = $customer->dependents->toArray();
            } else {
                $customerDependent = []; // Or any other default value you want to assign
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
            

            $maritalStatus = optional(Transaction::with('customer')->where('id',$transactionId)->first())->customer->marital_status;

            if ($maritalStatus === 'Single') {

                session()->forget('customer_details.family_details.children_data');
                session()->forget('customer_details.family_details.spouse_data');
                session()->forget('customer_details.family_details.children');
                session()->forget('customer_details.family_details.spouse');

            } else if ($maritalStatus === 'Married') {

                session()->forget('customer_details.family_details.spouse_data');

                if ( !(session()->has('customer_details.family_details.spouse_data'))) {
                    session(['customer_details.family_details.spouse_data.relation' => true]);
                }   

            } else if ($maritalStatus === 'Divorced' || $maritalStatus === 'Widowed') {

                session()->forget('customer_details.family_details.spouse_data');
                session(['customer_details.family_details.spouse' => false]);
            }

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
            $avatarImage = $avatar->image ?? 'images/avatar-general/gender-male.svg';
            session(['customer_details.avatar.image' => $avatarImage]);

            $maritalStatus = optional(Transaction::with('customer')->where('id',$transactionId)->first())->customer->marital_status;
            session(['customer_details.identity_details.marital_status' => $maritalStatus]);

            $customer = Customer::with(['spouse', 'dependents'])->find($customerId);
           
            if ($customer && $customer->spouse) {
                $customerSpouse = $customer->spouse->toArray();
            } else {
                $customerSpouse = []; // Or any other default value you want to assign
            }

            if ($customer && $customer->dependents) {
                $customerDependent = $customer->dependents->toArray();
            } else {
                $customerDependent = []; // Or any other default value you want to assign
            }
            
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
        $transactionId = $request->input('transaction_id') ?? session('transaction_id');

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
            $avatarImage = $avatar->image ?? 'images/avatar-general/gender-male.svg';
            session(['customer_details.avatar.image' => $avatarImage]);

            $customer = Customer::with(['spouse', 'dependents'])->find($customerId);
           
            if ($customer && $customer->spouse) {
                $customerSpouse = $customer->spouse->toArray();
            } else {
                $customerSpouse = []; // Or any other default value you want to assign
            }

            if ($customer && $customer->dependents) {
                $customerDependent = $customer->dependents->toArray();
            } else {
                $customerDependent = []; // Or any other default value you want to assign
            }
            
            if ($customerSpouse) {

                $customerSpouse['habits'] = $customerSpouse['habit'];
                unset($customerSpouse['habit']);
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

            // $titles = $basicDetails->title;
            session(['customer_details.basic_details.title' => $basicDetails->title]);
            session(['customer_details.basic_details.full_name' => $basicDetails->full_name]);
            session(['customer_details.basic_details.country_code' => $basicDetails->country_code]);
            session(['customer_details.basic_details.mobile_number' => $basicDetails->mobile_number]);
            session(['customer_details.basic_details.house_phone_number_country_code' => $basicDetails->house_phone_number_country_code]);
            session(['customer_details.basic_details.house_phone_number' => $basicDetails->house_phone_number]);
            session(['customer_details.basic_details.email' => $basicDetails->email]);

            session(['customer_details.identity_details.country' => $basicDetails->country]);
            session(['customer_details.identity_details.id_type' => $basicDetails->id_type]);
            session(['customer_details.identity_details.occupation' => $basicDetails->occupation]);
            session(['customer_details.identity_details.marital_status' => $basicDetails->marital_status]);

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
            $avatarImage = $avatar->image ?? 'images/avatar-general/gender-male.svg';
            $avatarGender = $avatar->gender ?? "Male";
             $assetDetails = Customer::with('asset')->find($customerId);
            $assetImage = $assetDetails->asset;

            //if data found, set the corresponding session data to frontend
            session(['customer_details.avatar.image' => $avatarImage]);
            session(['customer_details.avatar.gender' => $avatarGender]);
            session(['customer_details.assets.car'=> $assetImage->car ?? 0]);
            session(['customer_details.assets.scooter'=> $assetImage->scooter ?? 0]);
            session(['customer_details.assets.house'=> $assetImage->house ?? 0]);
            session(['customer_details.assets.bungalow'=> $assetImage->bungalow ?? 0]);
        }
        
        return view('pages/avatar/assets', compact('assetImage'));
    }

    public function financialPriorities(Request $request)
    {
        $transactionId = $request->input('transaction_id') ?? session('transaction_id');
        $prioritiesDiscuss = [];
        $prioritiesLevel = [];

        if(!empty($transactionId)){
            session(['transaction_id' => $transactionId]);

            $customerId = optional(Transaction::with('customer')->where('id',$transactionId)->first())->customer->id;
            session(['customer_id' => $customerId]);
           
        } else {
            $transactionId = null;   
        }

        if (!is_null($transactionId)) {
            $priorityDetails = Customer::with('priorities')->find($customerId);
            $customerPriority = $priorityDetails->priorities->whereNotNull('sequence');

            // dd($customerPriority);

            foreach ($customerPriority as $cpValue) {
                $prioritiesLevel[$cpValue['sequence']-1] = $cpValue['priority'];
                $prioritiesDiscuss[$cpValue['priority']]  = $cpValue['covered'];
                $prioritiesDiscuss[$cpValue['priority']."_discuss"]  = $cpValue['discuss'];
            }
            ksort($prioritiesLevel);
            session(['customer_details.priorities_level' => $prioritiesLevel]);
            session(['customer_details.priorities' => $prioritiesDiscuss]);

            // dd($prioritiesLevel);
            $avatar = optional(Customer::with('avatar')->where('id',$customerId)->first())->avatar;
            $avatarImage = $avatar->image ?? 'images/avatar-general/gender-male.svg';
            session(['customer_details.avatar.image' => $avatarImage]);
        }
        return view('pages/priorities/top-priorities');
    
    }
    public function financialPrioritiesDiscuss(Request $request)
    {
        $transactionId = $request->input('transaction_id') ?? session('transaction_id');
        $prioritiesDiscuss = [];
        $prioritiesLevel = [];

        if(!empty($transactionId)){
            session(['transaction_id' => $transactionId]);

            $customerId = optional(Transaction::with('customer')->where('id',$transactionId)->first())->customer->id;
            session(['customer_id' => $customerId]);
           
        } else {
            $transactionId = null;   
        }

        if (!is_null($transactionId)) {
            $priorityDetails = Customer::with('priorities')->find($customerId);
            $customerPriority = $priorityDetails->priorities->whereNotNull('sequence');                        

            foreach ($customerPriority as $cpValue) {
                $prioritiesLevel[$cpValue['sequence']-1] = $cpValue['priority'];

                $prioritiesDiscuss[$cpValue['priority']]  = $cpValue['covered'];
                $prioritiesDiscuss[$cpValue['priority']."_discuss"]  = $cpValue['discuss'];
            }
            ksort($prioritiesLevel);
            session(['customer_details.priorities_level' => $prioritiesLevel]);
            session(['customer_details.priorities' => $prioritiesDiscuss]);

            $avatar = optional(Customer::with('avatar')->where('id',$customerId)->first())->avatar;
            $avatarImage = $avatar->image ?? 'images/avatar-general/gender-male.svg';
            session(['customer_details.avatar.image' => $avatarImage]);   
        }
        
        return view('pages/priorities/priorities-discuss',compact('prioritiesDiscuss'));
    
    }

    public function existingPolicy()
    {
        $companies = Company::all();
        $policyPlans = PolicyPlan::all();
        $premiumModes = PremiumMode::all();
        return view('pages/summary/existing-policy', compact('companies', 'policyPlans','premiumModes'));
    }
}
