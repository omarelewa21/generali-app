<?php

namespace App\Services;

use App\Models\Agent;
use App\Models\Transaction;
use App\Models\Avatar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AvatarService
{
    public $avatarId;

    public  function handleAvatar($customerDetails,$customerId)
    {
        DB::transaction(function () use ($customerDetails,$customerId) {

            // temporarily use this agent 
            $agentId = Agent::find(1)->id;
            // $customerId = session('transaction_id') ? $customerDetails['customer_id'] : "";

            $gender = $customerDetails['avatar']['gender'];
            $image = $customerDetails['avatar']['image'];
            $skinTone = $customerDetails['avatar']['skin_tone'];

            $avatar = Avatar::updateOrCreate(
                ['customer_id' => $customerId],
                ['gender' => $gender,'image' => $image,'skin_tone' => $skinTone]
            );
           
          
            $this->avatarId = $avatar->id;
        });

        return $this->avatarId;
    }

}
