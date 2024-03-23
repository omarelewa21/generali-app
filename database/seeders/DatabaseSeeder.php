<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
       
        $this->call(CompaniesTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(EducationLevelsTableSeeder::class);
        $this->call(IdTypesTableSeeder::class);
        $this->call(MaritalStatusesTableSeeder::class);
        $this->call(OccupationsTableSeeder::class);
        $this->call(PolicyPlansTableSeeder::class);
        $this->call(PremiumModesTableSeeder::class);
        $this->call(TitlesTableSeeder::class);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
