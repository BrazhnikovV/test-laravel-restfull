<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

/**
 * @ProductSeeder
 * @package Database\Seeders
 */
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Создает 100 товаров для возможности проверить функционал приложения.
     *
     * @return void
     */
    public function run(): void
    {
        Product::factory(100)->create();
    }
}
