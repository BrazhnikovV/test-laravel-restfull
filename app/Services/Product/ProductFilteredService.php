<?php

namespace App\Services\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * @ProductFilteredService
 * @package App\Services\Product
 */
class ProductFilteredService implements FilteredServiceInterface
{
    /**
     * @var Product
     */
    private Product $model;

    /**
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    /**
     * @param Request $request
     * @return LengthAwarePaginator|Collection|null
     */
    public function filtered(Request $request): LengthAwarePaginator|Collection|null
    {
        $filters = $request->get('filters');
        if ($filters !== NULL) {
            return $this->getFilteredData($filters);
        }

        return $this->model::query()->paginate(5);
    }

    /**
     * @param $filters
     * @return null|Collection|LengthAwarePaginator
     */
    private function getFilteredData($filters): null|Collection|LengthAwarePaginator
    {
        if (array_key_exists('name', $filters) === true) {
            return $this->getDataByName($filters['name']);
        }

        if (array_key_exists('categoryId', $filters) === true) {
            return $this->getDataByCategoryId($filters['categoryId']);
        }

        if ((array_key_exists('price', $filters) === true)
            && array_key_exists('min', $filters['price']) === true
            && array_key_exists('max', $filters['price'])) {
            return $this->getDataByPriceRange($filters['price']['min'], $filters['price']['max']);
        }

        if (array_key_exists('not-deleted', $filters) === true) {
            return $this->getByNotDeletedSign();
        }

        if (array_key_exists('published', $filters) === true) {
            return $this->getByPublishedSign($filters['published']);
        }

        if (array_key_exists('categoryName', $filters) === true) {
            return $this->getByCategoryName($filters['categoryName']);
        }

        return null;
    }

    /**
     * @param string $name
     * @return LengthAwarePaginator
     */
    private function getDataByName(string $name): LengthAwarePaginator
    {
        return $this->model::query()->where('productname', '=', $name)
            ->paginate(5)->appends('filters[name]',$name);
    }

    /**
     * @param int $categoryId
     * @return LengthAwarePaginator
     */
    private function getDataByCategoryId(int $categoryId): LengthAwarePaginator
    {
        return $this->model::whereHas('categories', static function ($query) use($categoryId) {
            $query->where('category_id', '=', $categoryId);
        })->paginate(5)->appends('filters[categoryId]',$categoryId);
    }

    /**
     * @param $start
     * @param $end
     * @return LengthAwarePaginator
     */
    private function getDataByPriceRange($start, $end): LengthAwarePaginator
    {
        return $this->model::query()
            ->where('price', '>', $start)
            ->where('price', '<', $end)
            ->paginate(5)
            ->appends('filters[price][min]',$start)
            ->appends('filters[price][max]',$end);
    }

    /**
     * @return LengthAwarePaginator
     */
    private function getByNotDeletedSign(): LengthAwarePaginator
    {
        return $this->model::query()
            ->where('deleted_at', '=', NULL)
            ->paginate(5)->appends('filters[not-deleted]', 1);
    }

    /**
     * @param $status
     * @return LengthAwarePaginator
     */
    private function getByPublishedSign($status): LengthAwarePaginator
    {
        return $this->model::query()
            ->where('published', '=', $status)
            ->paginate(5)->appends('filters[published]', $status);
    }

    /**
     * @param $categoryName
     * @return LengthAwarePaginator
     */
    private function getByCategoryName($categoryName): LengthAwarePaginator
    {
        return $this->model::whereHas('categories', static function ($query) use($categoryName) {
            $query->where('categoryname', '=', $categoryName);
        })->paginate(5)->appends('filters[categoryName]', $categoryName);
    }
}
