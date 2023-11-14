<?php

namespace Database\Seeders;

use App\Models\DiscountCode_Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountCode_OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DiscountCode_Order::create([
            'order_id' => '1',
            'discountCode_id' => '1',
            'discountValue' => '10'
        ]);

        DiscountCode_Order::create([
            'order_id' => '1',
            'discountCode_id' => '2',
            'discountValue' => '20'
        ]);
    }
}
