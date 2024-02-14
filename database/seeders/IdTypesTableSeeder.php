<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\idtype;

class IdTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $idTypes = [
            ['idtypes' => 'New IC'],
            ['idtypes' => 'Passport'],
            ['idtypes' => 'Birth Certificate'],
            ['idtypes' => 'Police / Army'],
            ['idtypes' => 'Registration'],     
        ];

        foreach ($idTypes as $idType) {
            idtype::create($idType);
        }
    }
}
