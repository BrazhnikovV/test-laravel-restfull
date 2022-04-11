<?php

namespace App\Http\Requests\Category;

use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @CategoryRequest
 * @package App\Http\Requests\Category
 */
class CategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(['categoryname' => "string"])]
    public function rules(): array
    {
        return [
            'categoryname' => 'required|string|max:128',
        ];
    }
}
