<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Store::create([
            'name' => 'AlZain',
            'email' => 'store@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone'=>'1234567',
            'status'=>'1',
            'type'=>'resturant',
            'img'=> 'store1', 
            'openTime' => '32:56:34',
            'closeTime' => '25:56:34',
            'location_id'=>'1',
            'created_by'=>'1',
        ]);

        Store::create([
            'name' => 'AlKamal',
            'email' => 'store2@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone'=>'1234567',
            'status'=>'1',
            'type'=>'resturant',
            'img'=> 'store2', 
            'openTime' => '32:56:34',
            'closeTime' => '25:56:34',
            'location_id'=>'2',
            'created_by'=>'1',
        ]);

        Store::create([
            'name' => 'Five Star',
            'email' => 'store3@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone'=>'1234567',
            'status'=>'1',
            'type'=>'resturant',
            'img'=> 'store3', 
            'openTime' => '32:56:34',
            'closeTime' => '25:56:34',
            'location_id'=>'1',
            'created_by'=>'1',
        ]);

        Store::create([
            'name' => 'AlAgha',
            'email' => 'store4@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone'=>'1234567',
            'status'=>'1',
            'type'=>'resturant',
            'img'=> 'store4', 
            'openTime' => '32:56:34',
            'closeTime' => '25:56:34',
            'location_id'=>'1',
            'created_by'=>'1',
        ]);

        Store::create([
            'name' => 'store5',
            'email' => 'store5@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone'=>'1234567',
            'status'=>'1',
            'type'=>'clothes',
            'img'=> 'store5', 
            'openTime' => '32:56:34',
            'closeTime' => '25:56:34',
            'location_id'=>'1',
            'created_by'=>'1',
        ]);

        Store::create([
            'name' => 'store6',
            'email' => 'store6@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone'=>'1234567',
            'status'=>'1',
            'type'=>'clothes',
            'img'=> 'store6', 
            'openTime' => '32:56:34',
            'closeTime' => '25:56:34',
            'location_id'=>'1',
            'created_by'=>'1',
        ]);

        Store::create([
            'name' => 'store7',
            'email' => 'store7@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone'=>'1234567',
            'status'=>'1',
            'type'=>'clothes',
            'img'=> 'store7', 
            'openTime' => '32:56:34',
            'closeTime' => '25:56:34',
            'location_id'=>'1',
            'created_by'=>'1',
        ]);

    }
}
