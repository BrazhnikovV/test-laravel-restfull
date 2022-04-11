<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use App\Http\Requests\Product\ProductRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;

/**
 * @ProductController
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return Product::all();
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
