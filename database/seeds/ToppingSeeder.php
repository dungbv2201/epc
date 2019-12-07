<?php

use Illuminate\Database\Seeder;

class ToppingSeeder extends Seeder
{

    public function run()
    {
        $toppings = ["white pearl", "Milk foam", "Pearl", "Aloe"];
        foreach ($toppings as $topping) {
            \App\Models\Topping::create([
               'name' =>$topping
           ]);
       }
    }
}
