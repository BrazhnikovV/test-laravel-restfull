<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\QueryException;
use App\Http\Requests\Category\CategoryRequest;

/**
 * @CategoryController
 * @package App\Http\Controllers
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
            return response(null, 404);
        }
    }
}
