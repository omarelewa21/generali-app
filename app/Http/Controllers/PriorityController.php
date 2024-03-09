<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PriorityController extends Controller
{
    //protection priority
    public function protectionHome(Request $request)
    {
        $transactionId = $request->input('transaction_id') ?? session('transaction_id');
        $priorityData = [];

        if (!empty($transactionId)) {

            session(['transaction_id' => $transactionId]);
            $customerId = optional(Transaction::with('customer')->where('id',$transactionId)->first())->customer->id;
            session(['customer_id' => $customerId]);
        }
        else{
            $transactionId = null;
        }

        if (!is_null($transactionId))
        {
            $prioritySequence = Customer::whereHas('priorities', function ($query) use ($customerId) {
                $query->where('priority', 'protection');
            })->find($customerId)->priorities()->where('priority', 'protection')->get()->toArray();


            if(isset ($prioritySequence[0]['priority']))
            {
                session(['customer_details.priorities.protection_discuss' => 'true']);
            }

            $priorityDetails = Customer::with('priorities')->find($customerId);
            $customerPriority = $priorityDetails->priorities;

            foreach ($customerPriority as $cpValue) {
                $priorityData[$cpValue['sequence']-1] = $cpValue['priority'];
            }
            ksort($priorityData);
            session(['customer_details.priorities_level' => $priorityData]);
        }

        return view('pages/priorities/protection/home');
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
                session(['customer_details.priorities.protection_discuss' => 'true']);
            }

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

            $customerNeed = Customer::with('customerNeeds')->find($customerId)->customerNeeds->toArray();

            foreach ($customerNeed as $value) {
            
                if ($value['type'] == "N1") {
                    session(['customer_details.selected_needs.need_1.advance_details.relationship' => $value['relationship']]);
                    session(['customer_details.selected_needs.need_1.advance_details.child_name' => $value['child_name']]);
                    session(['customer_details.selected_needs.need_1.advance_details.spouse_name' => $value['spouse_name']]);
                    session(['customer_details.selected_needs.need_1.advance_details.child_dob' => $value['child_dob']]);
                    session(['customer_details.selected_needs.need_1.advance_details.spouse_dob' => $value['spouse_dob']]);
                }
            }
        }

        return view('pages/priorities/protection/coverage');
    }

    public function protectionAmountNeeded(Request $request)
    {
        $transactionId = $request->input('transaction_id') ?? session('transaction_id');

        if (!empty($transactionId)) {
            session(['transaction_id' => $transactionId]);
            $customerId = optional(Transaction::with('customer')->where('id',$transactionId)->first())->customer->id;
            session(['customer_id' => $customerId]);
        }
        else{
            $transactionId = null;
        }

        if (!is_null($transactionId)) {

            $prioritySequence = Customer::whereHas('priorities', function ($query) use ($customerId) {
                $query->where('priority', 'protection');
            })->find($customerId)->priorities()->where('priority', 'protection')->get()->toArray();

            if(isset ($prioritySequence['priority']))
            {
                session(['customer_details.priorities.protection_discuss' => 'true']);
            }

            $customerNeed = Customer::with('customerNeeds')->find($customerId)->customerNeeds->toArray();

            foreach ($customerNeed as $value) {
                
                // N1 is protection need
                if ($value['type'] == "N1") {
                    session(['customer_details.selected_needs.need_1.advance_details.covered_amount_monthly' => $value['covered_amount_monthly']]);
                    session(['customer_details.selected_needs.need_1.advance_details.covered_amount' => $value['covered_amount']]);
                    session(['customer_details.selected_needs.need_1.advance_details.existing_amount' => $value['existing_amount']]);
                    session(['customer_details.selected_needs.need_1.advance_details.supporting_years' => $value['supporting_year']]);
                    session(['customer_details.selected_needs.need_1.advance_details.goals_amount' => $value['goals_amount']]);
                    session(['customer_details.selected_needs.need_1.advance_details.fund_percentage' => $value['fund_percentage']]);
                    session(['customer_details.selected_needs.need_1.advance_details.relationship' => $value['relationship']]);
                }
            }

        }

        return view('pages/priorities/protection/amount-needed');

    }

    public function protectionExistingPolicy(Request $request)
    {
        $transactionId = $request->input('transaction_id') ?? session('transaction_id');

        if (!empty($transactionId)) {
            session(['transaction_id' => $transactionId]);
            $customerId = optional(Transaction::with('customer')->where('id',$transactionId)->first())->customer->id;
            session(['customer_id' => $customerId]);
        }
        else{
            $transactionId = null;
        }

        if (!is_null($transactionId)) {

            $prioritySequence = Customer::whereHas('priorities', function ($query) use ($customerId) {
                $query->where('priority', 'protection');
            })->find($customerId)->priorities()->where('priority', 'protection')->get()->toArray();

            if(isset ($prioritySequence['priority']))
            {
                session(['customer_details.priorities.protection_discuss' => 'true']);
            }
        }

        $customerNeed = Customer::with('customerNeeds')->find($customerId)->customerNeeds->toArray();

            foreach ($customerNeed as $value) {
                // N1 is protection need
                if ($value['type'] == "N1") {
                    session(['customer_details.selected_needs.need_1.advance_details.covered_amount_monthly' => $value['covered_amount_monthly']]);
                    session(['customer_details.selected_needs.need_1.advance_details.existing_policy' => $value['existing_policy']]);
                    session(['customer_details.selected_needs.need_1.advance_details.existing_amount' => $value['existing_amount']]);
                    session(['customer_details.selected_needs.need_1.advance_details.goals_amount' => $value['goals_amount']]);
                    session(['customer_details.selected_needs.need_1.advance_details.supporting_years' => $value['supporting_year']]);
                    session(['customer_details.selected_needs.need_1.advance_details.fund_percentage' => $value['fund_percentage']]);
                    session(['customer_details.selected_needs.need_1.advance_details.insurance_amount' => $value['insurance_amount']]);
                }
            }

        return view('pages/priorities/protection/existing-policy');
    }

    public function protectionGap(Request $request)
    {
        $transactionId = $request->input('transaction_id') ?? session('transaction_id');
        $prioritiesDiscuss = [];
    
        if (!empty($transactionId)) {

            session(['transaction_id' => $transactionId]);
            $customerId = optional(Transaction::with('customer')->where('id',$transactionId)->first())->customer->id;
            session(['customer_id' => $customerId]);
        }
        else{
            $transactionId = null;
        }

        if (!is_null($transactionId))
        {
            $basicDetails = optional(Transaction::with('customer')->where('id',$transactionId)->first())->customer;
            $priorityDetails = Customer::with('priorities')->find($customerId);
            $customerPriority = $priorityDetails->priorities;

            foreach ($customerPriority as $cpValue) {
                $prioritiesDiscuss[$cpValue['sequence']-1] = $cpValue['priority'];

                if ($cpValue['priority'] == "protection")
                {
                    // $protectionDiscuss = true;
                    session(['customer_details.priorities.protection_discuss' => 'true']);
                }

            }

            ksort($prioritiesDiscuss);

            $customerNeed = Customer::with('customerNeeds')->find($customerId)->customerNeeds->toArray();

            foreach ($customerNeed as $value) {
                
                // N1 is protection need
                if ($value['type'] == "N1") {
                    session(['customer_details.selected_needs.need_1.advance_details.supporting_years' => $value['supporting_year']]);
                    session(['customer_details.selected_needs.need_1.advance_details.goals_amount' => $value['goal']]);
                    session(['customer_details.selected_needs.need_1.advance_details.existing_amount' => $value['existing_amount']]);
                    session(['customer_details.selected_needs.need_1.advance_details.fund_percentage' => $value['fund_percentage']]);
                    session(['customer_details.selected_needs.need_1.advance_details.insurance_amount' => $value['insurance_amount']]);
                }
            }
        }

        return view('pages/priorities/protection/gap');
    }

    //retirement priority
    public function retirementHome(Request $request)
    {
        // $transactionId = $request->input('transaction_id') ?? session('transaction_id');
        $transactionId = intval($request->input('transaction_id') ?? session('transaction_id'));

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
            $retirementPriorities = ['protection', 'retirement'];

            $prioritySequence = Customer::whereHas('priorities', function ($query) use ($retirementPriorities) {
                $query->whereIn('priority', $retirementPriorities);
            })->find(session('customer_id'))->priorities()->whereIn('priority', $retirementPriorities)->get()->toArray();

            foreach ($prioritySequence as $value) {
                session(['customer_details.priorities.' . $value['priority'] . '_discuss' => $value['discuss']]);
            }
        }
        return view('pages/priorities/retirement/home');
    }

    public function retirementCoverage(Request $request)
    {
        $transactionId = intval($request->input('transaction_id') ?? session('transaction_id'));

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

        if ($transactionId && $customer) {
            
            // $familyDependent = session('customer_details.family_details');
            $retirementPriorities = ['protection', 'retirement'];

            $prioritySequence = Customer::whereHas('priorities', function ($query) use ($retirementPriorities) {
                $query->whereIn('priority', $retirementPriorities);
            })->find(session('customer_id'))->priorities()->whereIn('priority', $retirementPriorities)->get()->toArray();

            foreach ($prioritySequence as $value) {
                session(['customer_details.priorities.' . $value['priority'] . '_discuss' => $value['discuss']]);
            }

            $customerDependent = Customer::with(['spouse', 'dependents'])->find($customer->id);

            if ($customerDependent && $customerDependent->dependents) {
                $dependent = $customerDependent->dependents->toArray();
            } else {
                $dependent = []; // Or any other default value you want to assign
            }

            if ($dependent) {

                $familyDependent = [];

                foreach ($dependent as $family) {
    
                    if($family['relation'] == 'Father' || $family['relation'] == 'Mother')
                    {
                        $parentData[lcfirst($family['relation'])] = $family;
                    }
                    elseif ($family['relation'] == 'Sibling') 
                    {
                        $siblingData = $family;
                    }
                    else // child 
                    {
                        $childData[strtolower(str_replace(' ', '_', $family['relation']))] = $family;
                    }
                }
        
                $familyDependent['children_data'] = $childData;
                $familyDependent['parents_data'] = $parentData;
                $familyDependent['siblings_data'] = $siblingData;

                session(['customer_details.family_details' => $familyDependent]);
            
                // foreach ($familyDependent as $key => $value) {
                //     if (isset($value)) {
                //         $substring = strstr($key, '_data',true);
                //         session(['customer_details.family_details.' . $substring => true]);
                //         session(['customer_details.family_details.' . $key => $value]);
                //     }
                // }
              
                // $existingData = session('customer_details.family_details.dependent', []);

                // session(['customer_details.family_details.dependent.children_data' => $childData]);
                // $childArray = session('customer_details.family_details.dependent.children_data');
                // array_merge_recursive($existingData, $childArray);
            }
           
            if ($customerDependent && $customerDependent->spouse) {
                $spouse = $customerDependent->spouse->toArray();
            } else {
                $spouse = []; // Or any other default value you want to assign
            }

            if ($spouse) {
                session(['customer_details.family_details.spouse_data' => $spouse ]);   
                // session(['customer_details.family_details.spouse_data.full_name' => $spouse['full_name']]);
            }

            $customerNeed = Customer::with('customerNeeds')->find($customer->id)->customerNeeds->toArray();

            foreach ($customerNeed as $value) {
            
                if ($value['type'] == "N2") {
                    session(['customer_details.selected_needs.need_2.advance_details.relationship' => $value['relationship']]);
                    session(['customer_details.selected_needs.need_2.advance_details.child_name' => $value['child_name']]);
                    session(['customer_details.selected_needs.need_2.advance_details.spouse_name' => $value['spouse_name']]);
                    session(['customer_details.selected_needs.need_2.advance_details.child_dob' => $value['child_dob']]);
                    session(['customer_details.selected_needs.need_2.advance_details.spouse_dob' => $value['spouse_dob']]);
                }
            }

            session(['customer_details.basic_details' => $customer->toArray(), 'customer_details.identity_details' => $customer->toArray()]);
        }

        return view('pages/priorities/retirement/coverage');
    }

    public function retirementIdeal(Request $request)
    {
        $transactionId = intval($request->input('transaction_id') ?? session('transaction_id'));

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

            $retirementPriorities = ['protection', 'retirement'];

            $prioritySequence = Customer::whereHas('priorities', function ($query) use ($retirementPriorities) {
                $query->whereIn('priority', $retirementPriorities);
            })->find(session('customer_id'))->priorities()->whereIn('priority', $retirementPriorities)->get()->toArray();

            foreach ($prioritySequence as $value) {
                session(['customer_details.priorities.' . $value['priority'] . '_discuss' => $value['discuss']]);
            }

            $customerNeed = Customer::with('customerNeeds')->find($customer->id)->customerNeeds->toArray();

            foreach ($customerNeed as $value) {
                
                // N2 is retirement need
                if ($value['type'] == "N2") {
                    session(['customer_details.selected_needs.need_2.advance_details.ideal_retirement' => $value['ideal_retirement']]);
                    session(['customer_details.selected_needs.need_2.advance_details.relationship' => $value['relationship']]); 
                }
            }
        }

        return view('pages/priorities/retirement/ideal');
    }

    public function retirementMonthlySupport(Request $request)
    {
        $transactionId = intval($request->input('transaction_id') ?? session('transaction_id'));

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

            $retirementPriorities = ['protection', 'retirement'];

            $prioritySequence = Customer::whereHas('priorities', function ($query) use ($retirementPriorities) {
                $query->whereIn('priority', $retirementPriorities);
            })->find(session('customer_id'))->priorities()->whereIn('priority', $retirementPriorities)->get()->toArray();

            foreach ($prioritySequence as $value) {
                session(['customer_details.priorities.' . $value['priority'] . '_discuss' => $value['discuss']]);
            }

            $customerNeed = Customer::with('customerNeeds')->find($customer->id)->customerNeeds->toArray();

            foreach ($customerNeed as $value) {
                
                // N2 is retirement need
                if ($value['type'] == "N2") {
                    session(['customer_details.selected_needs.need_2.advance_details.ideal_retirement' => $value['ideal_retirement']]);
                    // session(['customer_details.selected_needs.need_2.advance_details.relationship' => $value['relationship']]); 

                    session(['customer_details.selected_needs.need_2.advance_details.monthly_covered_amount' => $value['covered_amount_monthly']]); 
                    session(['customer_details.selected_needs.need_2.advance_details.covered_amount' => $value['covered_amount']]); 
                    session(['customer_details.selected_needs.need_2.advance_details.existing_amount' => $value['existing_amount']]); 
                    session(['customer_details.selected_needs.need_2.advance_details.supporting_years' => $value['supporting_year']]); 
                    session(['customer_details.selected_needs.need_2.advance_details.goals_amount' => $value['goals_amount']]); 
                    session(['customer_details.selected_needs.need_2.advance_details.fund_percentage' => $value['fund_percentage']]); 
                }
            }
        }

        // dd(session()->all());

        return view('pages/priorities/retirement/monthly-support');
    }

    public function retirementAllocatedFunds(Request $request)
    {
        $transactionId = intval($request->input('transaction_id') ?? session('transaction_id'));

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

            $retirementPriorities = ['protection', 'retirement'];

            $prioritySequence = Customer::whereHas('priorities', function ($query) use ($retirementPriorities) {
                $query->whereIn('priority', $retirementPriorities);
            })->find(session('customer_id'))->priorities()->whereIn('priority', $retirementPriorities)->get()->toArray();

            foreach ($prioritySequence as $value) {
                session(['customer_details.priorities.' . $value['priority'] . '_discuss' => $value['discuss']]);
            }

            $customerNeed = Customer::with('customerNeeds')->find($customer->id)->customerNeeds->toArray();

            // $customOtherIncomeSources = session('customer_details.selected_needs.need_2.advance_details.other_sources_custom');
            // $otherIncomeSources = session('customer_details.selected_needs.need_2.advance_details.other_sources');
            // this 2 sessions need to create column in database

            foreach ($customerNeed as $value) {
                
                // N2 is retirement need
                if ($value['type'] == "N2") {
                    session(['customer_details.selected_needs.need_2.advance_details.ideal_retirement' => $value['ideal_retirement']]);
                    // session(['customer_details.selected_needs.need_2.advance_details.relationship' => $value['relationship']]); 

                    session(['customer_details.selected_needs.need_2.advance_details.existing_amount' => $value['existing_amount']]); 
                    session(['customer_details.selected_needs.need_2.advance_details.supporting_years' => $value['supporting_year']]);
                    session(['customer_details.selected_needs.need_2.advance_details.goals_amount' => $value['goals_amount']]);
                    session(['customer_details.selected_needs.need_2.advance_details.fund_percentage' => $value['fund_percentage']]); 
                    session(['customer_details.selected_needs.need_2.advance_details.remaining_years' => $value['remaining_year']]); 
                    session(['customer_details.selected_needs.need_2.advance_details.insurance_amount' => $value['insurance_amount']]); 
                    session(['customer_details.selected_needs.need_2.advance_details.other_sources_custom' => $value['other_sources_custom']]); 
                    session(['customer_details.selected_needs.need_2.advance_details.other_sources' => $value['other_sources']]); 
                }
            }
        }
        return view('pages/priorities/retirement/allocated-funds');
    }

    public function retirementGap(Request $request)
    {
        $transactionId = intval($request->input('transaction_id') ?? session('transaction_id'));

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

            $retirementPriorities = ['protection', 'retirement'];

            $prioritySequence = Customer::whereHas('priorities', function ($query) use ($retirementPriorities) {
                $query->whereIn('priority', $retirementPriorities);
            })->find(session('customer_id'))->priorities()->whereIn('priority', $retirementPriorities)->get()->toArray();

            foreach ($prioritySequence as $value) {
                session(['customer_details.priorities.' . $value['priority'] . '_discuss' => $value['discuss']]);
            }

            $customerNeed = Customer::with('customerNeeds')->find($customer->id)->customerNeeds->toArray();

            foreach ($customerNeed as $value) {
                
                // N2 is retirement need
                if ($value['type'] == "N2") {
                    session(['customer_details.selected_needs.need_2.advance_details.ideal_retirement' => $value['ideal_retirement']]);
                    // session(['customer_details.selected_needs.need_2.advance_details.relationship' => $value['relationship']]); 

                    session(['customer_details.selected_needs.need_2.advance_details.existing_amount' => $value['existing_amount']]); 
                    session(['customer_details.selected_needs.need_2.advance_details.supporting_years' => $value['supporting_year']]);
                    session(['customer_details.selected_needs.need_2.advance_details.goals_amount' => $value['goals_amount']]);
                    session(['customer_details.selected_needs.need_2.advance_details.fund_percentage' => $value['fund_percentage']]); 
                    session(['customer_details.selected_needs.need_2.advance_details.remaining_years' => $value['remaining_year']]); 
                    session(['customer_details.selected_needs.need_2.advance_details.insurance_amount' => $value['insurance_amount']]);   
                }
            }
        }

        return view('pages/priorities/retirement/gap');
    }


    //on hold 
    public function retirementSupportingYears(Request $request)
    {
        return view('pages/priorities/retirement/retirement-supporting-years');
    }


    //on hold
    public function retirementAge(Request $request)
    {
        return view('pages/priorities/retirement/retirement-retire-age');
    }
    
    //education priority
    public function educationHome(Request $request)
    {
        $transactionId = intval($request->input('transaction_id') ?? session('transaction_id'));

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
            $retirementPriorities = ['protection', 'retirement','education'];

            $prioritySequence = Customer::whereHas('priorities', function ($query) use ($retirementPriorities) {
                $query->whereIn('priority', $retirementPriorities);
            })->find(session('customer_id'))->priorities()->whereIn('priority', $retirementPriorities)->get()->toArray();

            foreach ($prioritySequence as $value) {
                session(['customer_details.priorities.' . $value['priority'] . '_discuss' => $value['discuss']]);
            }
        }
        return view('pages/priorities/education/home');
    }

    public function educationCoverage(Request $request)
    {
        return view('pages/priorities/education/coverage');
    }
    
    public function educationAmountNeeded(Request $request)
    {
        return view('pages/priorities/education/amount-needed');
    }

    public function educationExistingFund(Request $request)
    {
        return view('pages/priorities/education/existing-fund');
    }

    public function educationGap(Request $request)
    {
        return view('pages/priorities/education/gap');
    }

    public function educationAmount(Request $request)
    {
        return view('pages/priorities/education/education-amount');
    }

    public function educationSupportingYears(Request $request)
    {
        return view('pages/priorities/education/education-supporting-years');
    }

    //savings priority
    public function savingsHome(Request $request)
    {
        $transactionId = intval($request->input('transaction_id') ?? session('transaction_id'));

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
            $retirementPriorities = ['protection', 'retirement','education','savings'];

            $prioritySequence = Customer::whereHas('priorities', function ($query) use ($retirementPriorities) {
                $query->whereIn('priority', $retirementPriorities);
            })->find(session('customer_id'))->priorities()->whereIn('priority', $retirementPriorities)->get()->toArray();

            foreach ($prioritySequence as $value) {
                session(['customer_details.priorities.' . $value['priority'] . '_discuss' => $value['discuss']]);
            }
        }
        return view('pages/priorities/savings/home');
    }

    public function savingsCoverage(Request $request)
    {
        return view('pages/priorities/savings/coverage');
    }

    public function savingsGoals(Request $request)
    {
        return view('pages/priorities/savings/goals');
    }

    public function savingsAmountNeeded(Request $request)
    {
        return view('pages/priorities/savings/amount-needed');
    }

    public function savingsAnnualReturn(Request $request)
    {
        return view('pages/priorities/savings/annual-return');
    }

    public function savingsRiskProfile(Request $request)
    {
        return view('pages/priorities/savings/risk-profile');
    }

    public function savingsGap(Request $request)
    {
        return view('pages/priorities/savings/gap');
    }

    public function savingsMonthlyPayment(Request $request)
    {
        return view('pages/priorities/savings/monthly-payment');
    }

    public function savingsGoalDuration(Request $request)
    {
        return view('pages/priorities/savings/goal-duration');
    }

    //investment priority
    public function investmentHome(Request $request)
    {
        $transactionId = intval($request->input('transaction_id') ?? session('transaction_id'));

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
            $retirementPriorities = ['protection', 'retirement','education','savings','investments'];

            $prioritySequence = Customer::whereHas('priorities', function ($query) use ($retirementPriorities) {
                $query->whereIn('priority', $retirementPriorities);
            })->find(session('customer_id'))->priorities()->whereIn('priority', $retirementPriorities)->get()->toArray();

            foreach ($prioritySequence as $value) {
                session(['customer_details.priorities.' . $value['priority'] . '_discuss' => $value['discuss']]);
            }
        }
        return view('pages/priorities/investment/home');
    }

    public function investmentCoverage(Request $request)
    {
        return view('pages/priorities/investment/coverage');
    }

    public function investmentAmountNeeded(Request $request)
    {
        return view('pages/priorities/investment/amount-needed');
    }

    public function investmentAnnualReturn(Request $request)
    {
        return view('pages/priorities/investment/annual-return');
    }

    public function investmentRiskProfile(Request $request)
    {
        return view('pages/priorities/investment/risk-profile');
    }

    public function investmentGap(Request $request)
    {
        return view('pages/priorities/investment/gap');
    }

    public function investmentMonthlyPayment(Request $request)
    {
        return view('pages/priorities/investment/monthly-payment');
    }

    public function investmentSupporting(Request $request)
    {
        return view('pages/priorities/investment/supporting');
    }

    //risk profile priority
    public function riskProfile(Request $request)
    {
        return view('pages/priorities/risk-profile/risk-profile');
    }

    //health and medical priority
    public function healthMedicalHome(Request $request)
    {
        $transactionId = intval($request->input('transaction_id') ?? session('transaction_id'));

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
            $retirementPriorities = ['protection', 'retirement','education','savings','investments','health-medical'];

            $prioritySequence = Customer::whereHas('priorities', function ($query) use ($retirementPriorities) {
                $query->whereIn('priority', $retirementPriorities);
            })->find(session('customer_id'))->priorities()->whereIn('priority', $retirementPriorities)->get()->toArray();

            foreach ($prioritySequence as $value) {
                session(['customer_details.priorities.' . $value['priority'] . '_discuss' => $value['discuss']]);
            }
        }
        return view('pages/priorities/health-medical/home');
    }

    public function healthMedicalSelection(Request $request)
    {
        return view('pages/priorities/health-medical/medical-selection');
    }

    public function healthMedicalCriticalIllnessCoverage(Request $request)
    {
        return view('pages/priorities/health-medical/critical-illness/coverage');
    }

    public function healthMedicalCriticalAmountNeeded(Request $request)
    {
        return view('pages/priorities/health-medical/critical-illness/amount-needed');
    }

    public function healthMedicalCriticalExistingProtection(Request $request)
    {
        return view('pages/priorities/health-medical/critical-illness/existing-care');
    }

    public function healthMedicalCriticalGap(Request $request)
    {
        return view('pages/priorities/health-medical/critical-illness/gap');
    }

    public function healthMedicalPlanningCoverage(Request $request)
    {
        return view('pages/priorities/health-medical/medical-planning/coverage');
    }

    public function healthMedicalHospitalSelection(Request $request)
    {
        return view('pages/priorities/health-medical/medical-planning/hospital-selection');
    }

    public function healthMedicalRoomSelection(Request $request)
    {
        return view('pages/priorities/health-medical/medical-planning/room-selection');
    }

    public function healthMedicalPlanningAmountNeeded(Request $request)
    {
        return view('pages/priorities/health-medical/medical-planning/amount-needed');
    }

    public function healthMedicalPanningExistingProtection(Request $request)
    {
        return view('pages/priorities/health-medical/medical-planning/existing-care');
    }

    public function healthMedicalPlanningGap(Request $request)
    {
        return view('pages/priorities/health-medical/medical-planning/gap');
    }

    //debt cancellation priority
    public function debtCancellationHome(Request $request)
    {
        $selectedMedical = session('customer_details.selected_needs.need_6.advance_details.health_care.medical_care_plan');

        $transactionId = intval($request->input('transaction_id') ?? session('transaction_id'));

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
            $retirementPriorities = ['protection', 'retirement','education','savings','investments','health-medical','debt-cancellation'];

            $prioritySequence = Customer::whereHas('priorities', function ($query) use ($retirementPriorities) {
                $query->whereIn('priority', $retirementPriorities);
            })->find(session('customer_id'))->priorities()->whereIn('priority', $retirementPriorities)->get()->toArray();

            foreach ($prioritySequence as $value) {
                session(['customer_details.priorities.' . $value['priority'] . '_discuss' => $value['discuss']]);
            }

            $customerNeed = Customer::with('customerNeeds')->find($customer->id)->customerNeeds->toArray();

            foreach ($customerNeed as $value) {
                
                // N2 is retirement need
                if ($value['type'] == "N6") {
                    session(['customer_details.selected_needs.need_6.advance_details.health_care.medical_care_plan' => $value['medical_care_plan']]);
                }
            }
        }
        return view('pages/priorities/debt-cancellation/home');
    }

    public function debtCancellationCoverage(Request $request)
    {
        return view('pages/priorities/debt-cancellation/coverage');
    }

    public function debtCancellationAmountNeeded(Request $request)
    {
        return view('pages/priorities/debt-cancellation/amount-needed');
    }

    public function debtCancellationExistingDebt(Request $request)
    {
        return view('pages/priorities/debt-cancellation/existing-debt');
    }

    public function debtCancellationCriticalIllness(Request $request)
    {
        return view('pages/priorities/debt-cancellation/critical-illness');
    }

    public function debtCancellationGap(Request $request)
    {
        return view('pages/priorities/debt-cancellation/gap');
    }

    public function debtCancellationOutStandingLoan(Request $request)
    {
        return view('pages/priorities/debt-cancellation/outstanding-loan');
    }

    public function debtCancellationSettlementYears(Request $request)
    {
        return view('pages/priorities/debt-cancellation/settlement-years');
    }
}
