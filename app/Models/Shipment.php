<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'tracking_number',
        'courier_name',
        'courier_code',
        'service_type',
        'shipping_cost',
        'weight',
        'origin_city',
        'destination_city',
        'estimated_days',
        'estimated_delivery_date',
        'status',
        'tracking_history',
        'shipped_at',
        'delivered_at',
        'delivery_notes',
        'recipient_name',
        'recipient_address',
        'recipient_phone',
    ];

    protected function casts(): array
    {
        return [
            'shipping_cost' => 'decimal:2',
            'weight' => 'decimal:2',
            'estimated_delivery_date' => 'date',
            'tracking_history' => 'array',
            'shipped_at' => 'datetime',
            'delivered_at' => 'datetime',
        ];
    }

    // Relationships
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Helper methods
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'pending' => 'Pending Pickup',
            'picked_up' => 'Picked Up',
            'in_transit' => 'In Transit',
            'out_for_delivery' => 'Out for Delivery',
            'delivered' => 'Delivered',
            'failed' => 'Delivery Failed',
            'returned' => 'Returned to Sender',
            default => 'Unknown'
        };
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'picked_up' => 'bg-blue-100 text-blue-800',
            'in_transit' => 'bg-purple-100 text-purple-800',
            'out_for_delivery' => 'bg-orange-100 text-orange-800',
            'delivered' => 'bg-green-100 text-green-800',
            'failed' => 'bg-red-100 text-red-800',
            'returned' => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    public function getStatusProgressAttribute()
    {
        return match($this->status) {
            'pending' => 10,
            'picked_up' => 25,
            'in_transit' => 50,
            'out_for_delivery' => 80,
            'delivered' => 100,
            'failed' => 0,
            'returned' => 0,
            default => 0
        };
    }

    public function getFormattedShippingCostAttribute()
    {
        return 'Rp ' . number_format($this->shipping_cost, 0, ',', '.');
    }

    public function getCourierLogoAttribute()
    {
        return match($this->courier_code) {
            'jne' => '🚚',
            'jnt' => '📦',
            'sicepat' => '⚡',
            'pos' => '📮',
            default => '🚛'
        };
    }

    public function addTrackingUpdate($status, $description, $location = null)
    {
        $history = $this->tracking_history ?? [];
        
        $update = [
            'status' => $status,
            'description' => $description,
            'location' => $location,
            'timestamp' => now()->toISOString(),
            'formatted_time' => now()->format('Y-m-d H:i:s')
        ];

        array_unshift($history, $update);
        
        $this->update([
            'tracking_history' => $history,
            'status' => $status
        ]);

        // Update timestamps for specific statuses
        if ($status === 'picked_up' && !$this->shipped_at) {
            $this->update(['shipped_at' => now()]);
        }
        
        if ($status === 'delivered' && !$this->delivered_at) {
            $this->update(['delivered_at' => now()]);
        }
    }

    public static function generateTrackingNumber($courierCode)
    {
        $prefix = match($courierCode) {
            'jne' => 'JNE',
            'jnt' => 'JT',
            'sicepat' => 'SP',
            'pos' => 'POS',
            default => 'TRK'
        };

        return $prefix . date('Ymd') . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT);
    }

    public static function getCourierOptions()
    {
        return [
            'jne' => [
                'name' => 'JNE Express',
                'services' => [
                    'REG' => ['name' => 'Regular', 'days' => '2-3', 'cost_per_kg' => 9000],
                    'YES' => ['name' => 'Yakin Esok Sampai', 'days' => '1', 'cost_per_kg' => 15000],
                    'OKE' => ['name' => 'Ongkos Kirim Ekonomis', 'days' => '3-4', 'cost_per_kg' => 7000],
                ]
            ],
            'jnt' => [
                'name' => 'J&T Express',
                'services' => [
                    'REG' => ['name' => 'Regular', 'days' => '2-3', 'cost_per_kg' => 8500],
                    'EZ' => ['name' => 'Easy', 'days' => '3-5', 'cost_per_kg' => 6500],
                ]
            ],
            'sicepat' => [
                'name' => 'SiCepat Express',
                'services' => [
                    'REG' => ['name' => 'Regular', 'days' => '2-3', 'cost_per_kg' => 8000],
                    'BEST' => ['name' => 'Best', 'days' => '1-2', 'cost_per_kg' => 12000],
                    'GOKIL' => ['name' => 'Gokil', 'days' => '3-4', 'cost_per_kg' => 6000],
                ]
            ],
            'pos' => [
                'name' => 'Pos Indonesia',
                'services' => [
                    'REG' => ['name' => 'Pos Reguler', 'days' => '3-5', 'cost_per_kg' => 7500],
                    'NEXT' => ['name' => 'Pos Nextday', 'days' => '1', 'cost_per_kg' => 14000],
                ]
            ]
        ];
    }

    public static function calculateShippingCost($courierCode, $serviceType, $weight, $originCity, $destinationCity)
    {
        $couriers = self::getCourierOptions();
        
        if (!isset($couriers[$courierCode]['services'][$serviceType])) {
            return 0;
        }

        $baseCost = $couriers[$courierCode]['services'][$serviceType]['cost_per_kg'];
        
        // Calculate distance multiplier (mock calculation)
        $distanceMultiplier = self::getDistanceMultiplier($originCity, $destinationCity);
        
        // Minimum 1kg for calculation
        $calculatedWeight = max($weight, 1);
        
        return $baseCost * $calculatedWeight * $distanceMultiplier;
    }

    private static function getDistanceMultiplier($originCity, $destinationCity)
    {
        // Mock distance calculation for demonstration
        $distances = [
            'Jakarta' => ['Jakarta' => 1.0, 'Bandung' => 1.2, 'Surabaya' => 1.5, 'Yogyakarta' => 1.3, 'Medan' => 2.0],
            'Bandung' => ['Jakarta' => 1.2, 'Bandung' => 1.0, 'Surabaya' => 1.4, 'Yogyakarta' => 1.2, 'Medan' => 1.8],
            'Surabaya' => ['Jakarta' => 1.5, 'Bandung' => 1.4, 'Surabaya' => 1.0, 'Yogyakarta' => 1.1, 'Medan' => 1.7],
            'Yogyakarta' => ['Jakarta' => 1.3, 'Bandung' => 1.2, 'Surabaya' => 1.1, 'Yogyakarta' => 1.0, 'Medan' => 1.6],
            'Medan' => ['Jakarta' => 2.0, 'Bandung' => 1.8, 'Surabaya' => 1.7, 'Yogyakarta' => 1.6, 'Medan' => 1.0],
        ];

        return $distances[$originCity][$destinationCity] ?? 1.5;
    }

    public function simulateProgress()
    {
        // Simulate realistic shipping progress for demonstration
        $statuses = ['pending', 'picked_up', 'in_transit', 'out_for_delivery', 'delivered'];
        $currentIndex = array_search($this->status, $statuses);
        
        if ($currentIndex !== false && $currentIndex < count($statuses) - 1) {
            $nextStatus = $statuses[$currentIndex + 1];
            
            $descriptions = [
                'picked_up' => 'Package picked up from seller',
                'in_transit' => 'Package in transit to destination city',
                'out_for_delivery' => 'Package out for delivery',
                'delivered' => 'Package delivered successfully'
            ];

            $locations = [
                'picked_up' => $this->origin_city,
                'in_transit' => 'Sorting Center',
                'out_for_delivery' => $this->destination_city,
                'delivered' => $this->destination_city
            ];

            $this->addTrackingUpdate(
                $nextStatus,
                $descriptions[$nextStatus] ?? 'Status updated',
                $locations[$nextStatus] ?? null
            );
        }
    }
}
