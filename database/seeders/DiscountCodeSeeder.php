<?php

namespace Database\Seeders;

use App\Models\DiscountCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DiscountCode::create([
            'code_name' => 'discount1',
            'discount_value' => '10',
            'status'=>'1',
            'created_by'=>'1',
        ]);

        DiscountCode::create([
            'code_name' => 'discount2',
            'discount_value' => '20',
            'status'=>'0',
            'created_by'=>'1',
        ]);

        DiscountCode::create([
            'code_name' => 'discount3',
            'discount_value' => '30',
            'status'=>'1',
            'created_by'=>'1',
        ]);
    }
}
