<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Occupation;
use League\Csv\Reader;

class OccupationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $occupations = $this->getOccupationsFromFile();

        foreach ($occupations as $occupation) {
            Occupation::create($occupation);
        }
    }

    private function getOccupationsFromFile()
    {
        $reader = Reader::createFromPath(database_path('occupations.csv'), 'r');
        $reader->setHeaderOffset(0);

        $occupations = [];

        foreach ($reader as $row) {
            $occupations[] = [
                'name' => $row['name'],
            ];
        }

        return $occupations;
    }
}
