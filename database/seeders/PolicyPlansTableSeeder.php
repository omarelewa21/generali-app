<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PolicyPlan;

class PolicyPlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $policyPlans = [
            ['policy_plans' => 'Whole Life'],
            ['policy_plans' => 'Endowment'],
            ['policy_plans' => 'Investment Linked'],
            ['policy_plans' => 'Term Life Insurance'],
            ['policy_plans' => 'Child Life Insurance'],
        ];


        foreach ($policyPlans as $policyPlan) {
            PolicyPlan::create($policyPlan);
        }
    }
}
