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
        
            foreach ($topPrioritiesButtonInput as $key => $value) {
                // Increment the key by 1 to get the sequence
                $sequence = $key + 1;
            
                // Define the criteria for checking if the record exists
                $criteria = ['customer_id' => $customerId,'priority' => $value];
            
                // Define the data to be updated or created
                $data = [
                    'sequence' => $sequence
                ];
            
                // Update or create the record
                $priority = Priority::updateOrCreate($criteria, $data);
            }

            $this->priorityId = $priority->id;
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
