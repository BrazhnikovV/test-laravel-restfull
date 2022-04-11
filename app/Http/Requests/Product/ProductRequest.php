<?php

namespace App\Http\Requests\Product;

use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @ProductRequest
 * @package App\Http\Requests\Product
 */
class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(['productname' => "string", 'price' => "decimal", 'published' => "int",'categories' => "array"])]
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
