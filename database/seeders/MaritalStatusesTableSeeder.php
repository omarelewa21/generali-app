<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\maritalStatus;

class MaritalStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $maritalStatuses = [
            ['maritalStatus' => 'Single'],
            ['maritalStatus' => 'Married'],
            ['maritalStatus' => 'Divorced'],
            ['maritalStatus' => 'Widowed'],
        ];

        foreach ($maritalStatuses as $maritalStatus) {
            maritalStatus::create($maritalStatus);
        }
    }
}
