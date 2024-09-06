<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 100; $i++)
        {
            $product = new Product;
            $product->name = $faker->name;
            $product->price=  $faker->numberBetween($min = 10, $max = 50);
            $product->description = $faker->paragraph($nb =2);
            $product->save();
        }    
    }
}
