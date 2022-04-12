<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

/**
 * @CategorySeeder
 * @package Database\Seeders
 */
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Создает 20 категорий для возможности проверить функционал приложения.
     *
     * @return void
     */
    public function run(): void
    {
        Category::factory(20)->create();
    }
}
