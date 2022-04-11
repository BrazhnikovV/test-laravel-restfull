<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\ProductResource;
use App\Http\Requests\Product\ProductRequest;
use App\Services\Product\ProductFilteredService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * @ProductController
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    /**
     * @var ProductFilteredService $filteredService
     */
    private ProductFilteredService $filteredService;

    /**
     * @param ProductFilteredService $filteredService
     */
    public function __construct(ProductFilteredService $filteredService)
    {
        $this->filteredService = $filteredService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response|LengthAwarePaginator
     */
    public function index(Request $request): Response|LengthAwarePaginator
    {
        return $this->filteredService->filtered($request) ?? response(null, 400);
    }

    /**
     * Display a single resource.
     *
     * @param int $id
     * @return ProductResource
     */
    public function show(int $id): ProductResource
    {
        return new ProductResource(Product::findOrFail($id));
    }

    /**
     * Handle an incoming product create request.
     *
     * @param ProductRequest $request
     * @return JsonResponse|Response
     */
    public function store(ProductRequest $request): JsonResponse | Response
    {
        $product = Product::create($request->validated());
        $product->categories()->attach($request->get('categories'));
        return response(null, 201);
    }

    /**
     * Handle an incoming product update request.
     *
     * @param int $id
     * @param ProductRequest $request
     * @return JsonResponse|Response
     */
    public function update(ProductRequest $request, int $id): JsonResponse | Response
    {
        Product::findOrFail($id)->update($request->validated());
        return response(null, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|ResponseFactory|Response|void
     */
    public function destroy(int $id)
    {
        $product = Product::findOrFail($id);
        if($product->delete()) {
            return response(null, 204);
        }
    }
}
