<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
         $this->call(ToppingSeeder::class);
         $this->call(StoreSeeder::class);
         $this->call(ProductSeeder::class);
    }
}
