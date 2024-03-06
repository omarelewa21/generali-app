<?php

namespace App\Services;

use App\Models\Agent;
use App\Models\Transaction;
use App\Models\Avatar;
use App\Models\Asset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AssetService
{
    public $assetId;

    public  function handleAsset($customerDetails,$customerId)
    {
        DB::transaction(function () use ($customerDetails,$customerId) {
            // temporarily use this agent 
            $agentId = Agent::find(1)->id;

            $car = $customerDetails['assets']['car'] ?? 0;
            $scooter = $customerDetails['assets']['scooter'] ?? 0;
            $house = $customerDetails['assets']['house'] ?? 0;
            $bungalow = $customerDetails['assets']['bungalow'] ?? 0;

            $asset = Asset::updateOrCreate(
                ['customer_id' => $customerId],
                ['car' => $car,'scooter' => $scooter,'house' => $house,'bungalow' => $bungalow]
            );
           
            $this->assetId = $asset->id;
        });

        return $this->assetId;
    }

}
