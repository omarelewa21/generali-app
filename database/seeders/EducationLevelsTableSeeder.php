<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\educationLevel;

class EducationLevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $educations = [
            ['level' => 'Primary School'],
            ['level' => 'High School'],
            ['level' => 'Diploma'],
            ['level' => 'Degree'],
            ['level' => 'Post Graduate'],
            
        ];
    
        foreach ($educations as $education) {
            educationLevel::create($education);
        }
    }
}
