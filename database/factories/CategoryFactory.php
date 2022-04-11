<?php

namespace Database\Factories;

use Exception;
use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @CategoryFactory
 * @package Database\Factories
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    #[ArrayShape(['categoryname' => "string"])]
    public function definition(): array
    {
        return [
            'categoryname' => $this->faker->name(),
        ];
    }
}
