<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * @ProductCategorySeeder
 * @package Database\Seeders
 */
class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; ++$i) {
            DB::table('product_category')->insert([
                'product_id'  => random_int(1, 100),
                'category_id' => random_int(1, 20),
            ]);
        }
    }
}
