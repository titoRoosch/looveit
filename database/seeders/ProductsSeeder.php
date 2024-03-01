<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $estados = [
            ['description' => 'Um celular Motorola', 'price' => '2500.00' , 'name' => 'Motorola Super 89'],
            ['description' => 'Um celular Samsung', 'price' => '3200.00', 'name' => 'Samsung Galaxy 74'],
            ['description' => 'Um celular Apple', 'price' => '12000.00', 'name' => 'iPhone 21'],
        ];

        DB::table('products')->insert($estados);
    }
}
