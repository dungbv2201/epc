<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return array
     */

    public function initProduct()
    {
        return [
            [
                "name" => "Royal Milk Tea",
                "price" => 4.8,
            ],
            [
                "name" => "Green Milk Tea",
                "price" => 4.6,
            ],
            [
                "name" => "Oolong Milk Tea",
                "price" => 5.1,
            ],
            [
                "name" => "Blueberry Milk Tea",
                "price" => 5.1,
            ],
            [
                "name" => "Mango Milk Tea",
                "price" => 5.1,
            ]
        ];
    }

    public function run()
    {
        foreach ($this->initProduct() as $product) {
            $pro = \App\Models\Product::create([
                "name" => $product["name"],
                "price" => $product["price"],
                "is_hot" => rand(0,1)
            ]);
            $toppingId = rand(1, 3);
            $pro->toppings()->attach($toppingId);
            $pro->toppings()->attach($toppingId + 1);
            $storeId = rand(1, 3);
            $pro->stores()->attach($storeId);
            $pro->stores()->attach($storeId + 1);
        }
    }
}
