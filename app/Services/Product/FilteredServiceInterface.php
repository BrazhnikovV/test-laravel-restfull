<?php

namespace App\Services\Product;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * @FilteredServiceInterface
 * @package App\Services\Product
 */
interface FilteredServiceInterface
{
    /**
     * @param Request $request
     * @return LengthAwarePaginator|Collection|null
     */
    public function filtered(Request $request): LengthAwarePaginator|Collection|null;
}
