<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'total_amount',
        'status',
        'shipping_address',
        'payment_method',
        'shipped_at',
        'delivered_at',
    ];

    protected function casts(): array
    {
        return [
            'total_amount' => 'decimal:2',
            'shipped_at' => 'datetime',
            'delivered_at' => 'datetime',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function shipment()
    {
        return $this->hasOne(Shipment::class);
    }

    // Helper methods
    public static function generateOrderNumber()
    {
        return 'ORD-' . date('Ymd') . '-' . str_pad(static::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);
    }

    // Status management methods
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'pending' => 'Order Confirmed',
            'processing' => 'Processing',
            'shipped' => 'Shipped',
            'out_for_delivery' => 'Out for Delivery',
            'delivered' => 'Delivered',
            'cancelled' => 'Cancelled',
            default => 'Unknown'
        };
    }

    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'pending' => 'bg-blue-100 text-blue-800',
            'processing' => 'bg-purple-100 text-purple-800',
            'shipped' => 'bg-indigo-100 text-indigo-800',
            'out_for_delivery' => 'bg-orange-100 text-orange-800',
            'delivered' => 'bg-emerald-100 text-emerald-800',
            'cancelled' => 'bg-red-100 text-red-800',
            default => 'bg-slate-100 text-slate-800'
        };
    }

    public function getStatusProgressAttribute()
    {
        return match ($this->status) {
            'pending' => 20,
            'processing' => 40,
            'shipped' => 60,
            'out_for_delivery' => 80,
            'delivered' => 100,
            'cancelled' => 0,
            default => 0
        };
    }

    public function canBeCancelled()
    {
        return in_array($this->status, ['pending', 'processing']);
    }

    public function canBeReordered()
    {
        return in_array($this->status, ['delivered', 'cancelled']);
    }

    public function getShippingAddressArrayAttribute()
    {
        return json_decode($this->shipping_address, true);
    }

    public function getFormattedTotalAttribute()
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }

    public function getEstimatedDeliveryAttribute()
    {
        if ($this->status === 'delivered') {
            return $this->delivered_at;
        }

        if ($this->status === 'shipped') {
            return $this->shipped_at?->addDays(3);
        }

        if ($this->status === 'processing') {
            return $this->created_at->addDays(5);
        }

        return $this->created_at->addDays(7);
    }
}
