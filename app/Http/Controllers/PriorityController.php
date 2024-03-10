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

    public function retirementHome(Request $request)
    {
        $transactionId = $request->input('transaction_id') ?? session('transaction_id');
        // dd($transactionId);

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

            $retirementPriorities = ['protection','retirement'];

            $prioritySequence = Customer::whereHas('priorities', function ($query) use ($customerId,$retirementPriorities) {
                $query->whereIn('priority', $retirementPriorities);
            })->find($customerId)->priorities()->whereIn('priority',$retirementPriorities)->get()->toArray();

            foreach ($prioritySequence as $key => $value) {
                
                session(['customer_details.priorities.'."$value[priority]".'_discuss' => $value['discuss'] ]);
            }

            // $retirementPriority = session('customer_details.priorities.retirement_discuss');
            // $protectionPriority = session('customer_details.priorities.protection_discuss');
        }

        return view('pages/priorities/retirement/home');
    }
}
