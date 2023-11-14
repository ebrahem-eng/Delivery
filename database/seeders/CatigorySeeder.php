<?php

namespace Database\Seeders;

use App\Models\Catigory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatigorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Catigory::create([
            'name' => 'Shawrma',
            'type' => '1',
        ]);

        Catigory::create([
            'name' => 'Fast Food',
            'type' => '1',
        ]);

        Catigory::create([
            'name' => 'Desert',
            'type' => '1',
        ]);

        Catigory::create([
            'name' => 'Fish',
            'type' => '1',
        ]);

        Catigory::create([
            'name' => 'For Men',
            'type' => '1',
        ]);

        Catigory::create([
            'name' => 'For Women',
            'type' => '1',
        ]);

        Catigory::create([
            'name' => 'For Kids',
            'type' => '1',
        ]);

        Catigory::create([
            'name' => 'Sandwesh',
            'type' => '0',
        ]);

        Catigory::create([
            'name' => 'Meal',
            'type' => '0',
        ]);

        Catigory::create([
            'name' => 'Juices',
            'type' => '0',
        ]);

        Catigory::create([
            'name' => 'Other',
            'type' => '0',
        ]);

        Catigory::create([
            'name' => 'Uniform',
            'type' => '0',
        ]);

        Catigory::create([
            'name' => 'Pajamas',
            'type' => '0',
        ]);
    }
}
