<?php

namespace Database\Seeders;

use App\Models\Order_Details;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Order_DetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order_Details::create([
            'product_price' => '2000',
            'product_note' => 'More Katchap',
            'quantity'=>'2',
            'productTotalAmount'=> '6300',
            // 'delivery_amount'=>'3000',
            // 'discount_amount'=>'700',
            // 'delivered_by'=>'1',
            'product_id'=>'1',
            // 'discount_code_id'=>'1',
            'order_id'=>'1',
        ]);

        Order_Details::create([
            'product_price' => '3000',
            'product_note' => 'No details',
            'quantity'=>'2',
            'productTotalAmount'=> '8300',
            // 'delivery_amount'=>'3000',
            // 'discount_amount'=>'700',
            // 'delivered_by'=>'1',
            'product_id'=>'2',
            // 'discount_code_id'=>'1',
            'order_id'=>'1',
        ]);

        Order_Details::create([
            'product_price' => '3000',
            'product_note' => 'No details',
            'quantity'=>'2',
            'productTotalAmount'=> '8300',
            // 'delivery_amount'=>'3000',
            // 'discount_amount'=>'700',
            // 'delivered_by'=>'1',
            'product_id'=>'1',
            // 'discount_code_id'=>'1',
            'order_id'=>'2',
        ]);
    }
}
