<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'sizes',
        'colors',
        'images',
        'category_id',
        'seller_id',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'sizes' => 'array',
            'colors' => 'array',
            'images' => 'array',
            'is_active' => 'boolean',
        ];
    }

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Helper methods for images
    public function getImageUrl($index = 0)
    {
        if ($this->images && isset($this->images[$index])) {
            return asset('storage/products/' . $this->images[$index]);
        }
        return asset('images/placeholder-product.jpg'); // fallback image
    }

    public function getFirstImageUrl()
    {
        return $this->getImageUrl(0);
    }

    public function getAllImageUrls()
    {
        if (!$this->images) {
            return [];
        }

        return array_map(function ($image) {
            return asset('storage/products/' . $image);
        }, $this->images);
    }

    // Helper methods
    public function getAverageRatingAttribute()
    {
        return $this->reviews()->where('status', 'approved')->avg('rating') ?? 0;
    }

    public function getReviewsCountAttribute()
    {
        return $this->reviews()->where('status', 'approved')->count();
    }
}
