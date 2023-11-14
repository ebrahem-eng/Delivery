<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::create([
            'order_status' => 'pending store accept',
            'type' => 'Internal',
            'store_accept_status'=>'0',
            'delivery_accept_status'=> '0',
            'delivered_code'=>'3221',
            'receipt_code'=>'5463',
            'order_note'=>'fasting',
            'user_location_id'=>'1',
            'store_id'=>'1',
            'user_id'=>'1',
            'delivered_code'=>'3221',
        ]);

        Order::create([
            'order_status' => 'pending store accept',
            'type' => 'Internal',
            'store_accept_status'=>'0',
            'delivery_accept_status'=> '0',
            'delivered_code'=>'3221',
            'receipt_code'=>'5463',
            'order_note'=>'fasting',
            'user_location_id'=>'2',
            'store_id'=>'1',
            'user_id'=>'1',
            'delivered_code'=>'3221',
        ]);
    }
}
