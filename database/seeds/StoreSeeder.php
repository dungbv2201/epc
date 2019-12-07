<?php

use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stores = ["Store 1", "Store 2", "Store 3", "Store 4"];
        foreach ($stores as $store) {
            \App\Models\Store::create([
                'name' =>$store
            ]);
        }
    }
}
