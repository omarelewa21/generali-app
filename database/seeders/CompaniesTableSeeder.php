<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            ['companies' => 'AIA Berhad'],
            ['companies' => 'Generali Life (previously AXA AFFIN Life)'],
            ['companies' => 'Allianz Life'],
            ['companies' => 'AmMetLife'],
            ['companies' => 'Etiqa Life'],
            ['companies' => 'Gibraltar BSN'],
            ['companies' => 'Great Eastern Life'],
            ['companies' => 'Hong Leong Assurance'],
            ['companies' => 'MCIS Insurance'],
            ['companies' => 'Manulife'],
            ['companies' => 'Prudential Assurance'],
            ['companies' => 'Sun Life Malaysia'],
            ['companies' => 'Tokio Marine'],
            ['companies' => 'Zurich Life'],
            ['companies' => 'Others'],
            // Add more users as needed
        ];
    
        foreach ($companies as $company) {
            Company::create($company);
        }
    }
}
