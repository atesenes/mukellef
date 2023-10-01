<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subscription::create(['name'=>'Haber Mail','price'=>10]);
        Subscription::create(['name'=>'Magazin Mail','price'=>25]);
        Subscription::create(['name'=>'Spor Mail','price'=>15]);
        Subscription::create(['name'=>'Aktüel Mail','price'=>12]);
        Subscription::create(['name'=>'Siyaset Mail','price'=>11]);
    }
}
