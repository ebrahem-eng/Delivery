<?php

namespace Database\Seeders;

use App\Models\Product_Catigory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCatigorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product_Catigory::create([
            'product_id' => '1',
            'catigory_id' => '8',
        ]);

        Product_Catigory::create([
            'product_id' => '1',
            'catigory_id' => '9',
        ]);

        Product_Catigory::create([
            'product_id' => '2',
            'catigory_id' => '9',
        ]);

        Product_Catigory::create([
            'product_id' => '3',
            'catigory_id' => '10',
        ]);

        Product_Catigory::create([
            'product_id' => '4',
            'catigory_id' => '11',
        ]);

        Product_Catigory::create([
            'product_id' => '5',
            'catigory_id' => '12',
        ]);

        Product_Catigory::create([
            'product_id' => '6',
            'catigory_id' => '13',
        ]);

        Product_Catigory::create([
            'product_id' => '7',
            'catigory_id' => '8',
        ]);
    }
}
