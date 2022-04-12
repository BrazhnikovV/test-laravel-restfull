<?php

namespace App\Http\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * @CategoryController
 * @package App\Http\Api\V1
 */
class CategoryController extends Controller
{
    /**
     * Handle an incoming category create request.
     *
     * @param CategoryRequest $request
     * @return JsonResponse|Response
     */
    public function store(CategoryRequest $request): JsonResponse | Response
    {
        Category::create($request->validated());
        return response(null, 201);
    }

    /**
     * Display a single resource.
     *
     * @param int $id
     * @return CategoryResource
     */
    public function show(int $id): CategoryResource
    {
        return new CategoryResource(Category::findOrFail($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        try {
            $category = Category::findOrFail($id);
            if($category->delete()) {
                return response(null, 204);
            }
            return response(null, 503);
        } catch (QueryException) {
            return response(null, 409);
        }
    }
}
