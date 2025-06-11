<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'order_id',
        'order_item_id',
        'rating',
        'title',
        'comment',
        'images',
        'is_verified_purchase',
        'is_featured',
        'is_helpful',
        'helpful_count',
        'not_helpful_count',
        'status',
        'seller_response',
        'seller_response_at',
        'seller_response_by',
        'quality_metrics',
        'would_recommend',
        'customer_name',
        'is_anonymous',
    ];

    protected function casts(): array
    {
        return [
            'images' => 'array',
            'quality_metrics' => 'array',
            'is_verified_purchase' => 'boolean',
            'is_featured' => 'boolean',
            'is_helpful' => 'boolean',
            'would_recommend' => 'boolean',
            'is_anonymous' => 'boolean',
            'seller_response_at' => 'datetime',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function sellerResponseBy()
    {
        return $this->belongsTo(User::class, 'seller_response_by');
    }

    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}
