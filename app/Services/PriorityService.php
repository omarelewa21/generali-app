<?php

namespace App\Services;

use App\Models\Agent;
use App\Models\Priority;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PriorityService
{
    public $priorityId;
    public $prioritySubjectId;

    public  function handlePriority($customerId,$topPrioritiesButtonInput)
    {
        DB::transaction(function () use ($customerId, $topPrioritiesButtonInput) {

            // temporarily use this agent 
            $agentId = Agent::find(1)->id;
         
            $id = session('transaction_id') ?? "";

            $priorityList = ["protection","retirement","savings","education","debt-cancellation",
                             "health-medical","others","investments"];

            $existingPriorities = Priority::where('customer_id', $customerId)->get();

            $existingButtonIds = $existingPriorities->pluck('priority')->toArray();

            $buttonsToAdd = array_diff($topPrioritiesButtonInput, $existingButtonIds); //[]
            $buttonsToRemove = array_diff($existingButtonIds, $topPrioritiesButtonInput);
          
            // new request is less than existing, remove others that doesn't match
            if (count($buttonsToAdd) == 0 && count($buttonsToRemove) > 0) {
                // Perform soft delete
                $priority = Priority::whereIn('priority', $buttonsToRemove)->where('customer_id', $customerId)->delete();

                $deletedPriority[] = $priority;

            } else {
                //add priority, but check with existing database, if got already then update sequence
                foreach ($buttonsToAdd as $addKey => $addValue) {

                    $sequence = $addKey + 1;
                
                    // Define the criteria for checking if the record exists
                    $criteria = ['customer_id' => $customerId,'priority' => $addValue];
                
                    // Define the data to be updated or created
                    $data = ['sequence' => $sequence];

                    // Update or create the record
                    $priority = Priority::updateOrCreate($criteria, $data);
                }
            }
        
            $this->priorityId = $deletedPriority ?? $priority->id ?? NULL;
        });

        return $this->priorityId;
    }

    public function handlePrioritySubject($customerId,$result)
    {
        DB::transaction(function () use ($customerId, $result) {

            foreach ($result as $decisionKey => $decisionValue) {

                $column = (str_ends_with($decisionKey, '_discuss')) ? 'discuss' : 'covered';

                $priorityColumn = $decisionKey;

                if (str_ends_with($decisionKey, '_discuss')) {
                    $priorityColumn = str_replace('_discuss', '', $decisionKey);
                }
            
                Priority::where('priority', $priorityColumn)
                        ->where('customer_id', $customerId)
                        ->update([$column => $decisionValue]);
                
            }
        });

    }
}
