<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Purchase;
use App\Models\Item;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ItemSeeder::class,
        ]);
        
        \App\Models\Customer::factory(1000)->create();

        $items = Item::all();
        Purchase::factory(1000)->create()
        ->each(function(Purchase $purchase) use ($items){
            $purchase->items()->attach(
                $items->random(rand(1,3))->pluck('id')->toArray(),
                ['quantity' => rand(1,5)]);
        });
    }
}
