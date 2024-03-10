<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Title;

class TitlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $titles = [
            ['titles'=>'Mr.'],
            ['titles'=>'Ms.'],
            ['titles'=>'Mrs.'],
            ['titles'=>'Madam'],
            ['titles'=>'Datuk'],
            ['titles'=>'Datin'],
            ['titles'=>'Dato Seri'],
            ['titles'=>'Datin Seri'],
            ['titles'=>'Tan Sri'],
            ['titles'=>'Puan Sri'],
            ['titles'=>'Dr.'],
            ['titles'=>'Tun'],
            ['titles'=>'Sir'],
            ['titles'=>'Justice'],
            ['titles'=>'Others'],

        ];

        foreach ($titles as $title) {
           Title::create($title);
        }
    }
}
