<?php

namespace Database\Seeders;

use App\Models\DeliveryAgentLocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryAgentLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DeliveryAgentLocation::create([
            'name' => 'Loc1',
            'longitudeStart' => '30.0',
            'longitudeEnd' => '36.0',
            'latitudeStart' => '20.0',
            'latitudeEnd' => '25.0',
        ]);
    }
}
