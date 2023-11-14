<?php

namespace Database\Seeders;

use App\Models\Store_Catigory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreCatigorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Store_Catigory::create([
            'store_id' => '1',
            'catigory_id' => '1',
        ]);

        Store_Catigory::create([
            'store_id' => '2',
            'catigory_id' => '2',
        ]);

        Store_Catigory::create([
            'store_id' => '3',
            'catigory_id' => '3',
        ]);

        Store_Catigory::create([
            'store_id' => '4',
            'catigory_id' => '4',
        ]);

        Store_Catigory::create([
            'store_id' => '5',
            'catigory_id' => '5',
        ]);

        Store_Catigory::create([
            'store_id' => '6',
            'catigory_id' => '6',
        ]);

        Store_Catigory::create([
            'store_id' => '7',
            'catigory_id' => '7',
        ]);
    }
}
