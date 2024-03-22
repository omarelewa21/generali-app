<?php 

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Title;
use App\Models\idtype;
use App\Models\Company;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Occupation;
use App\Models\PolicyPlan;
use App\Models\PremiumMode;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\maritalStatus;
use App\Models\educationLevel;

class DropdownController extends Controller
{
    public function titles(Request $request)
    {
        $countries = Country::all();
        $titles = Title::all();
        $transactionId = $request->input('transaction_id') ?? session()->get('transaction_id') ?? session('customer_details.transaction_id');
        // Check if 'transaction_id' is not empty in the current request
        if (!empty($transactionId)) {

            $transactionId = intval($transactionId) ?? NULL;
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
        $transactionId = $request->input('transaction_id') ?? session()->get('transaction_id') ?? session('customer_details.transaction_id');

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
        $transactionId = $request->input('transaction_id') ??session()->get('transaction_id') ?? session('customer_details.transaction_id');
        
        if(!empty($transactionId)){
            session(['transaction_id' => $transactionId]);

            $transaction = Transaction::with('customer')->where('id', $transactionId)->first();

            if ($transaction) {
                $customerId = optional($transaction->customer)->id;
            } else {
                $customerId = NULL;
                $transactionId = NULL;
            }
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
                $foundDependent = false; 
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

                    $foundDependent = true; 
                }

                $familyDependent = [];


                if ($foundDependent) {
                    if (!empty($childData) && !empty($childData)) {
                        $familyDependent['children_data'] = $childData;
                    }
                    if (!empty($parentData ) && !empty($parentData)) {
                        $familyDependent['parents_data'] = $parentData;
                    }
                    if (isset($siblingData) && !empty($siblingData)) {
                        $familyDependent['siblings_data'] = $siblingData;
                    }

                    //clear the session first , then reassign the value
                    session()->forget('customer_details.family_details.children_data');
                    session()->forget('customer_details.family_details.children');
                    session()->forget('customer_details.family_details.parents_data');
                    session()->forget('customer_details.family_details.parents');
                    session()->forget('customer_details.family_details.siblings');
                    session()->forget('customer_details.family_details.siblings_data');
                        
                    foreach ($familyDependent as $key => $value) {
                        if (!empty($value)) {
                                     
                            $substring = strstr($key, '_data', true);
                            session(['customer_details.family_details.' . $substring => true]);
                            session(['customer_details.family_details.' . $key => $value]);
                        }
                    }
                } else {
                    // Unset $familyDependent if no dependent is found
                    unset($familyDependent);
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
        $transactionId = $request->input('transaction_id') ?? session()->get('transaction_id') ?? session('customer_details.transaction_id');

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
                $customerSpouse = []; 
            }

            if ($customer && $customer->dependents) {
                $customerDependent = $customer->dependents->toArray();
            } else {
                $customerDependent = []; 
            }
            
            if ($customerSpouse) {
                session(['customer_details.family_details.spouse' => true ]); 
                session(['customer_details.family_details.spouse_data' => $customerSpouse ]);   
            }

            $familyDependent = [];
            if ($customerDependent) {
                $foundDependent = false;
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
                    $foundDependent = true;
                }
        
                if ($foundDependent) {
                    if (!empty($childData) && !empty($childData)) {
                        
                        $familyDependent['children_data'] = $childData;
                    }
                    if (!empty($parentData ) && !empty($parentData)) {
                        $familyDependent['parents_data'] = $parentData;
                    }
                    if (isset($siblingData) && !empty($siblingData)) {
                        $familyDependent['siblings_data'] = $siblingData;
                    }

                    //clear the session first , then reassign the value
                    session()->forget('customer_details.family_details.children_data');
                    session()->forget('customer_details.family_details.children');
                    session()->forget('customer_details.family_details.parents_data');
                    session()->forget('customer_details.family_details.parents');
                    session()->forget('customer_details.family_details.siblings');
                    session()->forget('customer_details.family_details.siblings_data');
                    //$familDependent  //children_data, //parents_data
                    foreach ($familyDependent as $key => $value) {
                        if (!empty($value)) {
                            $substring = strstr($key, '_data', true);
                            session(['customer_details.family_details.' . $substring => true]);
                            session(['customer_details.family_details.' . $key => $value]);
                        }
                    }
                } else {
                    // Unset $familyDependent if no dependent is found
                    unset($familyDependent);
                }
            }

            if($maritalStatus == 'Single')
            {
                $request->session()->forget(['customer_details.family_details.children', 'customer_details.family_details.children_data',
                                            'customer_details.family_details.spouse', 'customer_details.family_details.spouse_data'
            
                ]);
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
        $transactionId = $request->input('transaction_id') ?? session()->get('transaction_id') ?? session('customer_details.transaction_id');


        $childData = [];
        $siblingData = [];
        $parentData = [];
        $familyDetail = [];
        
        if (!empty($transactionId)) {
            // Set session variable 'transaction_id' to the value of 'transaction_id' from the current request
            session(['transaction_id' => $transactionId]);

            $transaction = Transaction::with('customer')->where('id', $transactionId)->first();

            if ($transaction) {
                $customerId = optional($transaction->customer)->id;
            } else {
                $customerId = NULL;
                $transactionId = NULL;
            }
            session(['customer_id' => $customerId]);   
        }  else {
            // If 'transaction_id' is not present in both the current request and session, set it to null
            $transactionId = NULL;
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
                
                $foundDependent = false; 
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

                    $foundDependent = true; 
                }

                $familyDependent = [];
        
                if ($foundDependent) {
                    if (!empty($childData) && !empty($childData)) {
                        $familyDependent['children_data'] = $childData;
                    }
                    if (!empty($parentData ) && !empty($parentData)) {
                        $familyDependent['parents_data'] = $parentData;
                    }
                    if (isset($siblingData) && !empty($siblingData)) {
                        $familyDependent['siblings_data'] = $siblingData;
                    }

                    //clear the session first , then reassign the value
                    session()->forget('customer_details.family_details.children_data');
                    session()->forget('customer_details.family_details.children');
                    session()->forget('customer_details.family_details.parents_data');
                    session()->forget('customer_details.family_details.parents');
                    session()->forget('customer_details.family_details.siblings');
                    session()->forget('customer_details.family_details.siblings_data');
                        
                    foreach ($familyDependent as $key => $value) {
                        if (!empty($value)) {                       
                            $substring = strstr($key, '_data', true);                          
                            session(['customer_details.family_details.' . $substring => true]);
                            session(['customer_details.family_details.' . $key => $value]);
                        }
                    }
                } else {
                    // Unset $familyDependent if no dependent is found
                    unset($familyDependent);
                }
            }

            session(['customer_details.basic_details' => $basicDetails->toArray()]);
            session(['customer_details.identity_details' => $basicDetails->toArray()]);
        }

        return view('pages/avatar/family-dependent-details', compact('maritalstatuses', 'titles', 'countries', 'idtypes', 'occupations'));
    }
    public function assets(Request $request)
    {
        $transactionId = $request->input('transaction_id') ?? session()->get('transaction_id') ?? session('customer_details.transaction_id');
        $assetImage = [];

        if(!empty($transactionId)){
            session(['transaction_id' => $transactionId]);

            $customerId = optional(Transaction::with('customer')->where('id',$transactionId)->first())->customer->id;
            session(['customer_id' => $customerId]);
            
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
        $transactionId = $request->input('transaction_id') ?? session()->get('transaction_id') ?? session('customer_details.transaction_id');
        $prioritiesDiscuss = [];
        $prioritiesLevel = [];

        if(!empty($transactionId)){
            session(['transaction_id' => $transactionId]);

            $transaction = Transaction::with('customer')->where('id', $transactionId)->first();

            if ($transaction) {
                $customerId = optional($transaction->customer)->id;
            } else {
                $customerId = NULL;
                $transactionId = NULL;
            }
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

            // dd($prioritiesLevel);
            $avatar = optional(Customer::with('avatar')->where('id',$customerId)->first())->avatar;
            $avatarImage = $avatar->image ?? 'images/avatar-general/gender-male.svg';
            session(['customer_details.avatar.image' => $avatarImage]);
        }
        return view('pages/priorities/top-priorities');
    
    }
    public function financialPrioritiesDiscuss(Request $request)
    {
        $transactionId = $request->input('transaction_id') ?? session()->get('transaction_id') ?? session('customer_details.transaction_id');
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

    public function overView(Request $request)
    {
        $transactionId = $request->input('transaction_id') ?? session()->get('transaction_id') ?? session('customer_details.transaction_id');

        if ($transactionId) {
            $customer = Transaction::with('customer')->find($transactionId)->customer ?? null;

            if ($customer) {
                session(['transaction_id' => $transactionId, 'customer_id' => $customer->id]);
            } else {
                session()->forget(['transaction_id', 'customer_id']);
            }
        } else {
            session()->forget(['transaction_id', 'customer_id']);
        }

        if ($transactionId) {
        
            $customerId = optional(Transaction::with('customer')->where('id',$transactionId)->first())->customer;
          
            if($customerId){
                $customerId['habits']= $customerId['habit'];
                $customerId['dob'] = Carbon::parse($customerId['dob'])->format('Y-m-d');
                unset($customerId['habit']);
    
                session(['customer_details.identity_details' => $customerId->toArray(),
                        'customer_details.basic_details' => $customerId->toArray()]
                    );
            }

            $avatar = optional(Customer::with('avatar')->where('id',$customerId)->first())->avatar;
            $avatarImage = $avatar->image ?? 'images/avatar-general/gender-male.svg';
            session(['customer_details.avatar.image' => $avatarImage]);

            $customerFamily = Customer::with(['spouse', 'dependents','financialStatement'])->find($customer->id);

            $financialData =  $customerFamily->replicate()->financialStatement;

            if($financialData){
                session(['customer_details.financialStatement.amountAvailable'  => $financialData->amount_available]);
                session(['customer_details.financialStatement.isChangeinAmount'  => $financialData->change_in_amount]);
                session(['customer_details.financialStatement.approximateIncrementAmount'  => $financialData->increment_amount]);
            }

            if ($customerFamily && $customerFamily->spouse) {
                $customerSpouse = $customerFamily->spouse->toArray();

                session(['customer_details.family_details.spouse' => true]);
            } else {
                $customerSpouse = []; // Or any other default value you want to assign
            }

            session(['customer_details.family_details.spouse_data' => $customerSpouse]);

            if ($customerFamily && $customerFamily->dependents) {
                $customerDependent = $customerFamily->dependents->toArray();
            } else {
                $customerDependent = []; // Or any other default value you want to assign
            }

            if ($customerDependent) {
                $foundDependent = false; 
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

                    $foundDependent = true; 
                }

                $familyDependent = [];

                if ($foundDependent) {
                    if (!empty($childData) && !empty($childData)) {
                        $familyDependent['children_data'] = $childData;
                    }
                    if (!empty($parentData ) && !empty($parentData)) {
                        $familyDependent['parents_data'] = $parentData;
                    }
                    if (isset($siblingData) && !empty($siblingData)) {
                        $familyDependent['siblings_data'] = $siblingData;
                    }

                    //clear the session first , then reassign the value
                    session()->forget('customer_details.family_details.children_data');
                    session()->forget('customer_details.family_details.children');
                    session()->forget('customer_details.family_details.parents_data');
                    session()->forget('customer_details.family_details.parents');
                    session()->forget('customer_details.family_details.siblings');
                    session()->forget('customer_details.family_details.siblings_data');
                        
                    foreach ($familyDependent as $key => $value) {
                        if (isset($value)) {
                            $substring = strstr($key, '_data', true);
                            session(['customer_details.family_details.' . $substring => true]);
                            session(['customer_details.family_details.' . $key => $value]);
                        }
                    }
                } else {
                    // Unset $familyDependent if no dependent is found
                    unset($familyDependent);
                }
            }

            $customerRelationship = Customer::with(['customerNeeds','priorities'])->find($customer->id);
            $customerNeed =  $customerRelationship->customerNeeds->toArray();
            $customerPriority = $customerRelationship->priorities->toArray();

            $mapping = [
                'protection' => 'N1',
                'retirement' => 'N2',
                'education' => 'N3',
                'savings' => 'N4',
                'investments' => 'N5',
                'health-medical' => 'N6',
                'debt-cancellation' => 'N7',
                'others' => 'N8',
            ];

            $selectedNeedsByType = [];

            foreach ($customerNeed as $need) {
                $selectedNeeds = [];
                foreach ($customerPriority as $priority) {
                    // Check if the priority value is in the mapping array and matches the type value
                    if (array_key_exists($priority['priority'], $mapping) && $mapping[$priority['priority']] == $need['type']) {
                        $selectedNeeds = [
                            'value' => $need['type'],
                            'priority' => $priority['sequence'],
                            'cover' => $priority['covered'],
                            'discuss' => $priority['discuss'],
                            'advanceDetails' => $need
                        ];
                    }
                }
                $selectedNeedsByType[] = $selectedNeeds; 
            }


            session(['customer_details.selected_needs' => $selectedNeedsByType]);    

        }
        return view('pages/summary/overview');
    }

    public function summary(Request $request)
    {
        $transactionId = $request->input('transaction_id') ?? session()->get('transaction_id') ?? session('customer_details.transaction_id');

        if ($transactionId) {
            $customer = Transaction::with('customer')->find($transactionId)->customer ?? null;

            if ($customer) {
                session(['transaction_id' => $transactionId, 'customer_id' => $customer->id]);
            } else {
                session()->forget(['transaction_id', 'customer_id']);
            }
        } else {
            session()->forget(['transaction_id', 'customer_id']);
        }

        if ($transactionId) {
        
            $customerId = optional(Transaction::with('customer')->where('id',$transactionId)->first())->customer;
          
            if($customerId){
                $customerId['habits']= $customerId['habit'];
                $customerId['dob'] = Carbon::parse($customerId['dob'])->format('Y-m-d');
                unset($customerId['habit']);
    
                session(['customer_details.identity_details' => $customerId->toArray(),
                        'customer_details.basic_details' => $customerId->toArray()]
                    );
            }

            $customerModel = Customer::with(['avatar','financialStatement','priorities'])->where('id', $customer->id)->first();
            $avatarImage = $customerModel->replicate()->avatar->image ?? NULL;
            $financialData =  $customerModel->replicate()->financialStatement;

            $priorityDbData =  $customerModel->replicate()->priorities->toArray();

            session(['customer_details.avatar.image' => $avatarImage]);
            
            if($financialData){
                session(['customer_details.financialStatement.amountAvailable'  => $financialData->amount_available]);
                session(['customer_details.financialStatement.isChangeinAmount'  => $financialData->change_in_amount]);
                session(['customer_details.financialStatement.approximateIncrementAmount'  => $financialData->increment_amount]);
            }

            $priorityData = [];

            foreach ($priorityDbData as $cpValue) {
                $priorityData[$cpValue['sequence']-1] = $cpValue['priority'];
            }

            if ($priorityData) {
                ksort($priorityData);

                session(['customer_details.priorities_level' => $priorityData]);
            }        
        }

        return view('pages/summary/summary');
    }

    public function existingPolicy(Request $request)
    {
        $companies = Company::all();
        $policyPlans = PolicyPlan::all();
        $premiumModes = PremiumMode::all();

        // $existingPolicy = json_decode(session('customer_details.existing_policy'), true);
        $transactionId = $request->input('transaction_id') ?? session()->get('transaction_id') ?? session('customer_details.transaction_id');

        if ($transactionId) {
            $customer = Transaction::with('customer')->find($transactionId)->customer ?? null;

            if ($customer) {
                session(['transaction_id' => $transactionId, 'customer_id' => $customer->id]);
            } else {
                session()->forget(['transaction_id', 'customer_id']);
            }

            $customerId = optional(Transaction::with('customer')->where('id',$transactionId)->first())->customer;
          
            if($customerId){
                $customerId['habits']= $customerId['habit'];
                $customerId['dob'] = Carbon::parse($customerId['dob'])->format('Y-m-d');
                unset($customerId['habit']);
    
                session(['customer_details.basic_details' => $customerId->toArray()]);
            }

            $retirementPriorities = ['protection', 'retirement','education','savings','investments','health-medical','debt-cancellation'];

            $prioritySequence = Customer::whereHas('priorities', function ($query) use ($retirementPriorities) {
                $query->whereIn('priority', $retirementPriorities);
            })->find(session('customer_id'))->priorities()->whereIn('priority', $retirementPriorities)->get()->toArray();

            foreach ($prioritySequence as $value) {
                session(['customer_details.priorities.' . $value['priority'] . '_discuss' => $value['discuss']]);
            }

            $customerRelationship = Customer::with(['customerNeeds','existingPolicies'])->find($customer->id);

            $customerNeed = $customerRelationship->replicate()->customerNeeds;

            foreach ($customerNeed as $value) {
                
                if ($value['type'] == "N6") {
                    $decodeHealthCare = json_decode($value['health_care'], true);
                    session(['customer_details.selected_needs.need_6.advance_details.health_care.medical_care_plan' => $decodeHealthCare['medical_care_plan']]);
                }
            }

        } else {
            session()->forget(['transaction_id', 'customer_id']);
        }

        return view('pages/summary/existing-policy', compact('companies', 'policyPlans','premiumModes'));
    }
}
