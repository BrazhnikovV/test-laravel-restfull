<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Product
 *
 * @property mixed $published
 * @Product
 * @package App\Models
 */
class Product extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string[]
     * @access protected
     */
    protected $fillable = ['productname','price','published'];

    /**
     * The categories that belong to the product.
     *
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_category');
    }
}
