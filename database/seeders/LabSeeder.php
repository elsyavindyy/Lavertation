<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lab;

class LabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $labs = [
            ['name' => 'Lab lt.1', 'floor' => 1, 'capacity' => 40],
            ['name' => 'Lab lt.2', 'floor' => 2, 'capacity' => 30],
            ['name' => 'Lab lt.3', 'floor' => 3, 'capacity' => 35],
        ];

        foreach ($labs as $lab) {
            Lab::create($lab);
        }
    }
}
