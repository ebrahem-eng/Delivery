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
            'reason_of_refuse' => '-',
            'store_accept_status'=>'0',
            'delivery_accept_status'=> '0',
            'delivered_code'=>'0',
            'receipt_code'=>'0',
            'order_note'=>'fasting',
            'deliveryFee' => '30000',
            'typePayment' => '1',
            'deliveryTips' => '3000',
            'voucher' => '300',
            'tax' => '5000',
            'totalAmmount' => '2000',
            'deliveredBy' => 'ebra',
            'deliveredPhone' => '0998765434',
            'user_location_id'=>'1',
            'store_id'=>'1',
            'user_id'=>'1',
            // 'delivered_code'=>'3221',
        ]);

        Order::create([
            'order_status' => 'pending store accept',
            'type' => 'Internal',
            'reason_of_refuse' => '-',
            'store_accept_status'=>'0',
            'delivery_accept_status'=> '0',
            'delivered_code'=>'0',
            'receipt_code'=>'0',
            'order_note'=>'fasting',
            'deliveryFee' => '30000',
            'typePayment' => '1',
            'deliveryTips' => '3000',
            'voucher' => '300',
            'tax' => '5000',
            'totalAmmount' => '2000',
            'deliveredBy' => 'ebra',
            'deliveredPhone' => '0998765434',
            'user_location_id'=>'2',
            'store_id'=>'1',
            'user_id'=>'1',
            // 'delivered_code'=>'3221',
        ]);
    }
}
