<?php

namespace App\Services;

use App\Models\Agent;
use App\Models\Avatar;
use App\Models\Spouse;
use App\Models\Customer;
use App\Models\Dependent;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DependentService
{
    public $dependentId;
    public $spouseId;
    public $createdFamily;

    public  function handleDependent($customerDetails,$customerId)
    {
        DB::transaction(function () use ($customerDetails,$customerId) {
            // temporarily use this agent 
            $agentId = Agent::find(1)->id;
            $newchildrenData = [];
            $newParentData = [];
            $newSiblingData = [];
            $createdDependentId = [];
            $createdSpouseId = [];
            $newSpouseData = [];

            if (isset($customerDetails['family_details']['siblings_data']) && $customerDetails['family_details']['siblings'] == true) {
                $newSiblingData['sibling'] = $customerDetails['family_details']['siblings_data'];
                $newSiblingData['sibling']['customer_id'] = $customerId;
            }
            else
            {
                //perform softdelete, check dependent table
                $existingSiblings = Customer::with(['dependents'])->find($customerId)->dependents;

                if ($existingSiblings) {
                            
                    foreach ($existingSiblings as $sibling) {
                       
                        if ($sibling -> relation == 'Sibling') {              
                            $sibling->delete();
                        }
                    }
                }
            }

            if (isset($customerDetails['family_details']['spouse_data']) && $customerDetails['family_details']['spouse'] === true) {
                $newSpouseData['spouse'] = $customerDetails['family_details']['spouse_data'];
                $newSpouseData['spouse']['customer_id'] = $customerId;
            }
            else
            {
                $existingSpouse = Customer::with(['spouse'])->find($customerId)->spouse;

                if ($existingSpouse) {
                    $existingSpouse->delete();              
                }
            }

            if (isset($customerDetails['family_details']['children_data']) ) {

                $childrenData = $customerDetails['family_details']['children_data'];

                foreach ($childrenData as $childrenKey => $childrenValue) {
                    $newchildrenData[$childrenKey] = $childrenValue;
                    $newchildrenData[$childrenKey]['customer_id'] = $customerId;
                }
            }
            else
            {
                $existingChildren = Customer::with(['dependents'])->find($customerId)->dependents;

                if ($existingChildren) {
                            
                    foreach ($existingChildren as $children) {
                       
                        if (in_array($existingChildren->relation,['Child 1','Child 2','Child 3','Child 4'])) {              
                            $children->delete();
                        }
                    }
                }
            }

            if (isset($customerDetails['family_details']['parents_data']) ) {

                $parentData = $customerDetails['family_details']['parents_data'];

                foreach ($parentData as $parentKey => $parentValue) {
                    $newParentData[$parentKey] = $parentValue;
                    $newParentData[$parentKey]['customer_id'] = $customerId;
                }
            }
            else
            {
                $existingParents = Customer::with(['dependents'])->find($customerId)->dependents;

                if ($existingParents) {
                    
                    //convert to array, check if dependent's relation is sibling, then perform soft delete
                    foreach ($existingParents as $parent) {
                       
                        if ($parent->relation == 'Father' || $parent->relation == 'Mother') {           
                            $parent->delete();
                        }
                    }
                }
            }

            $newDependentDetail = array_merge($newchildrenData,$newParentData,$newSiblingData,$newSpouseData);
            
            //create sibling, parents,children and spouse 
            foreach ($newDependentDetail as  $dependentType => $dependentData) {
                if ($dependentType === 'spouse') {
                    // $spouse = Spouse::create($dependentData);
                    $spouse = Spouse::updateOrCreate(
                        ['customer_id' => $customerId, 'relation' => $dependentData['relation']
                        ], $dependentData);

                    $createdSpouseId[] = $spouse->id;
                }
                else
                {
                    // $dependent = Dependent::create($dependentData);
                    $dependent = Dependent::updateOrCreate(
                        ['customer_id' => $customerId, 'relation' => $dependentData['relation'] 
                        ], $dependentData);

                    $createdDependentId[] = $dependent->id;
                }
            }

            $this->dependentId = $createdDependentId;
            $this->spouseId = $createdSpouseId;
            $this->createdFamily = [$this->dependentId,$this->spouseId];

        });

        return $this->createdFamily;
    }

    // public function handleSpouse($customerDetails,$customerId)

}