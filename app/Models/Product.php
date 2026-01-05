<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'brand_id',
        'category_id',
        'name',
        'slug',
        'sku',
        'description',
        'short_description',
        'price',
        'discount_price',
        'stock_quantity',
        'images',
        'is_featured',
        'status',
    ];

    protected $casts = [
        'images' => 'array',
        'is_featured' => 'boolean',
        'status' => 'boolean',
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
