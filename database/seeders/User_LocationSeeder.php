<?php

namespace Database\Seeders;

use App\Models\UserD_Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class User_LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserD_Location::create([
            'user_id' => '1',
            'location_id' => '1',
        ]);

        UserD_Location::create([
            'user_id' => '1',
            'location_id' => '2',
        ]);

    }
}
