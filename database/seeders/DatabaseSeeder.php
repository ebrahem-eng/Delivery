<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DeliveryAgentLocation;
use App\Models\DiscountCode;
use App\Models\Order_Details;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(AdminSeeder::class);
        $this->call(CatigorySeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(StoreSeeder::class);
        $this->call(DeliveryAgentLocationSeeder::class);
        $this->call(DeliveryAgentSedeer::class);
        $this->call(DiscountCodeSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(UserDSeeder::class);
        $this->call(User_LocationSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(Order_DetailsSeeder::class);
        $this->call(StoreCatigorySeeder::class);
        $this->call(ProductCatigorySeeder::class);
        $this->call(SettingSeeder::class);
    }
}
