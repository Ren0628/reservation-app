<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Accommondation;

class AccommondationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accommondations = [
            ['name' => 'ホテルA'],
            ['name' => '旅館A'],
        ];

        foreach($accommondations as $accommondation) {
            Accommondation::create($accommondation);
        }

    }
}
