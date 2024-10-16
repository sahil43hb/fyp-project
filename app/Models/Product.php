<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function sub_category(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'sub_categories_id', 'id');
    }
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brands_id', 'id');
    }

    public function carts(): HasMany
    {
        return $this->HasMany(Cart::class);
    }

    public function orderItems(): HasMany
    {
        return $this->HasMany(OrderItem::class);
    }
}
