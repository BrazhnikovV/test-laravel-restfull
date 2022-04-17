<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * @DatabaseSeeder
 * @package Database\Seeders
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
    }
}
