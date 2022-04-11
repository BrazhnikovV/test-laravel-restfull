<?php

namespace App\Services\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
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
     * @return LengthAwarePaginator|null
     */
    public function filtered(Request $request): LengthAwarePaginator|null
    {
        $filters = $request->get('filters');
        if (($filters !== NULL)) {
            if ($this->getFilteredData($filters) !== NULL) {
                return $this->getFilteredData($filters)->paginate(5)->appends($request->input());
            }

            return NULL;
        }

        return $this->model::query()->paginate(5);
    }

    /**
     * @param $filters
     * @return Builder|null
     */
    private function getFilteredData($filters): Builder|null
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
     * @return Builder
     */
    private function getDataByName(string $name): Builder
    {
        return $this->model::query()->where('productname', '=', $name);
    }

    /**
     * @param int $categoryId
     * @return Builder
     */
    private function getDataByCategoryId(int $categoryId): Builder
    {
        return $this->model::whereHas('categories', static function ($query) use($categoryId) {
            $query->where('category_id', '=', $categoryId);
        });
    }

    /**
     * @param $start
     * @param $end
     * @return Builder
     */
    private function getDataByPriceRange($start, $end): Builder
    {
        return $this->model::query()
            ->where('price', '>', $start)
            ->where('price', '<', $end);
    }

    /**
     * @return Builder
     */
    private function getByNotDeletedSign(): Builder
    {
        return $this->model::query()
            ->where('deleted_at', '=', NULL);
    }

    /**
     * @param $status
     * @return Builder
     */
    private function getByPublishedSign($status): Builder
    {
        return $this->model::query()
            ->where('published', '=', $status);
    }

    /**
     * @param $categoryName
     * @return Builder
     */
    private function getByCategoryName($categoryName): Builder
    {
        return $this->model::whereHas('categories', static function ($query) use($categoryName) {
            $query->where('categoryname', '=', $categoryName);
        });
    }
}
