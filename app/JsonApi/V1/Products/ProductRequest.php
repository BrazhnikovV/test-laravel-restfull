<?php

namespace App\JsonApi\V1\Products;

use JetBrains\PhpStorm\ArrayShape;
use LaravelJsonApi\Laravel\Http\Requests\ResourceRequest;

/**
 * @ProductRequest
 * @package App\JsonApi\V1\Products
 */
class ProductRequest extends ResourceRequest
{
    /**
     * Get the validation rules for the resource.
     *
     * @return array
     */
    #[ArrayShape(['productname' => "string", 'price' => "float", 'published' => "string", 'categories' => "array"])]
    public function rules(): array
    {
        return [
            'productname' => 'required|string|max:128',
            'price'       => 'required|numeric|between:1.00,10000.00',
            'published'   => 'required|in:0,1',
            'categories'  => 'array|min:2|max:10'
        ];
    }

}
