<?php

namespace Database\Seeders;

use App\Models\product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        product::create([
            'name' => 'product 1',
            'price' => '2000',
            'details' => 'No details',
            'store_id' => '1',
            'img'=>'meat'
        ]);

        product::create([
            'name' => 'product 2',
            'price' => '3000',
            'details' => 'No details',
            'store_id' => '2',
            'img'=>'krispy'
        ]);

        product::create([
            'name' => 'product 3',
            'price' => '5000',
            'details' => 'no potato',
            'store_id' => '3',
            'img'=>'food1'
        ]);

        product::create([
            'name' => 'product 4',
            'price' => '5000',
            'details' => 'no potato',
            'store_id' => '4',
            'img'=>'food2'
        ]);

        product::create([
            'name' => 'product 5',
            'price' => '5000',
            'details' => 'clothes',
            'store_id' => '5',
            'img'=>'food3'
        ]);

        product::create([
            'name' => 'product 6',
            'price' => '5000',
            'details' => 'clothes',
            'store_id' => '6',
            'img'=>'meat'
        ]);

        product::create([
            'name' => 'product 7',
            'price' => '7500',
            'details' => 'No details',
            'store_id' => '1',
            'img'=>'krispy'
        ]);
    }
}
