<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PremiumMode;

class PremiumModesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $premiumModes = [
            ['Modes'=>'Annually'],
            ['Modes'=>'Semi-Annually'],
            ['Modes'=>'Quarterly'],
            ['Modes'=>'Monthly'],

        ];

        foreach ($premiumModes as  $premiumMode) {
            PremiumMode::create($premiumMode);
        }
    }
}
