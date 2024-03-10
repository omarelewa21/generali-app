<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
use League\Csv\Reader;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            $countries = $this->getCountriesFromFile();

            // $chunkSize = 100; // You can adjust this based on your needs
            // $chunks = array_chunk($countries, $chunkSize);
            // dd($chunks);
        
            foreach ($countries as $country) {
                Country::create($country);
            }
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    private function getCountriesFromFile()
    {
        $reader = Reader::createFromPath(database_path('countries.csv'), 'r');
        $reader->setHeaderOffset(0);

        $countries = [];

        foreach ($reader as $row) {
            $countries[] = [
                'countries' => $row['countries'],
                'phone_code' => $row['phone_code']
            ];
        }

        return $countries;
    }
}
