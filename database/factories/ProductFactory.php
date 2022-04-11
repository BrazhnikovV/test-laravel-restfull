<?php

namespace Database\Factories;

use Exception;
use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @ProductFactory
 * @package Database\Factories
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    #[ArrayShape(['productname' => "string", 'price' => "decimal", 'published' => "enum"])]
    public function definition(): array
    {
        return [
            'productname' => $this->faker->name(),
            'price' => $this->faker->randomFloat(2, 1000, 10000),
            'published' => (string)random_int(0,1)
        ];
    }
}
