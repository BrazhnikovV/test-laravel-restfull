<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Product\ProductFilteredService;
use App\Services\Product\FilteredServiceInterface;

/**
 * @FilteredServiceProvider
 * @package App\Providers
 */
class FilteredServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(
            FilteredServiceInterface::class,
            ProductFilteredService::class
        );
    }
}
