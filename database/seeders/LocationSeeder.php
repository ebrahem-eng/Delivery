<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Location::create([
            'name' => 'first location',
            'area' => 'region 1',
            'street'=>' street 1',
            'floor'=> '1',
            'near'=>'loc 2',
            'another_details'=>'no details',
            'longitude' => '36.303768811730095',
            'latitude' => '33.4943803229405',
        ]);

        Location::create([
            'name' => 'secound location',
            'area' => 'region 2',
            'street'=>' street 2',
            'floor'=> '2',
            'near'=>'loc 3',
            'another_details'=>'no details',
            'longitude' => '33.513',
            'latitude' => '36.296',
        ]);
    }
}
