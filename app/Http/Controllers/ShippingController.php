<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Shipment;
use Illuminate\Support\Facades\Auth;

class ShippingController extends Controller
{
    public function calculateShipping(Request $request)
    {
        $request->validate([
            'destination_city' => 'required|string',
            'weight' => 'required|numeric|min:0.1',
        ]);

        $originCity = 'Jakarta'; // Default seller location for demo
        $destinationCity = $request->destination_city;
        $weight = $request->weight;

        $couriers = Shipment::getCourierOptions();
        $shippingOptions = [];

        foreach ($couriers as $courierCode => $courierData) {
            foreach ($courierData['services'] as $serviceCode => $serviceData) {
                $cost = Shipment::calculateShippingCost(
                    $courierCode, 
                    $serviceCode, 
                    $weight, 
                    $originCity, 
                    $destinationCity
                );

                $shippingOptions[] = [
                    'courier_code' => $courierCode,
                    'courier_name' => $courierData['name'],
                    'service_code' => $serviceCode,
                    'service_name' => $serviceData['name'],
                    'estimated_days' => $serviceData['days'],
                    'cost' => $cost,
                    'formatted_cost' => 'Rp ' . number_format($cost, 0, ',', '.'),
                    'logo' => match($courierCode) {
                        'jne' => '🚚',
                        'jnt' => '📦',
                        'sicepat' => '⚡',
                        'pos' => '📮',
                        default => '🚛'
                    }
                ];
            }
        }

        // Sort by cost
        usort($shippingOptions, function($a, $b) {
            return $a['cost'] <=> $b['cost'];
        });

        return response()->json([
            'success' => true,
            'shipping_options' => $shippingOptions
        ]);
    }

    public function createShipment(Request $request, $orderId)
    {
        $request->validate([
            'courier_code' => 'required|string',
            'service_code' => 'required|string',
            'shipping_cost' => 'required|numeric',
            'weight' => 'required|numeric|min:0.1',
        ]);

        $order = Order::findOrFail($orderId);

        // Check if user can create shipment for this order
        if (Auth::user()->role === 'seller') {
            // Seller can only create shipments for orders containing their products
            $sellerProductIds = Auth::user()->products->pluck('id');
            $hasSellerProducts = $order->orderItems()->whereIn('product_id', $sellerProductIds)->exists();
            
            if (!$hasSellerProducts) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
        } elseif (Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Check if shipment already exists
        if ($order->shipment) {
            return response()->json(['error' => 'Shipment already exists for this order'], 400);
        }

        $couriers = Shipment::getCourierOptions();
        $courierData = $couriers[$request->courier_code] ?? null;
        $serviceData = $courierData['services'][$request->service_code] ?? null;

        if (!$courierData || !$serviceData) {
            return response()->json(['error' => 'Invalid courier or service'], 400);
        }

        // Get shipping address
        $shippingAddress = json_decode($order->shipping_address, true);

        // Calculate estimated delivery date
        $estimatedDays = (int) explode('-', $serviceData['days'])[0]; // Take minimum days
        $estimatedDeliveryDate = now()->addDays($estimatedDays);

        // Create shipment
        $shipment = Shipment::create([
            'order_id' => $order->id,
            'tracking_number' => Shipment::generateTrackingNumber($request->courier_code),
            'courier_name' => $courierData['name'],
            'courier_code' => $request->courier_code,
            'service_type' => $request->service_code,
            'shipping_cost' => $request->shipping_cost,
            'weight' => $request->weight,
            'origin_city' => 'Jakarta', // Default for demo
            'destination_city' => $shippingAddress['city'] ?? 'Unknown',
            'estimated_days' => $estimatedDays,
            'estimated_delivery_date' => $estimatedDeliveryDate,
            'recipient_name' => $shippingAddress['full_name'],
            'recipient_address' => $shippingAddress['address'],
            'recipient_phone' => $shippingAddress['phone'],
        ]);

        // Add initial tracking update
        $shipment->addTrackingUpdate(
            'pending',
            'Shipment created and waiting for pickup',
            'Jakarta'
        );

        // Update order status to shipped if not already
        if ($order->status === 'processing') {
            $order->update(['status' => 'shipped', 'shipped_at' => now()]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Shipment created successfully',
            'shipment' => $shipment,
            'tracking_number' => $shipment->tracking_number
        ]);
    }

    public function trackShipment($trackingNumber)
    {
        $shipment = Shipment::where('tracking_number', $trackingNumber)
                           ->with('order.user')
                           ->first();

        if (!$shipment) {
            return response()->json(['error' => 'Tracking number not found'], 404);
        }

        return response()->json([
            'success' => true,
            'shipment' => $shipment,
            'tracking_history' => $shipment->tracking_history ?? []
        ]);
    }

    public function updateShipmentStatus(Request $request, $shipmentId)
    {
        $request->validate([
            'status' => 'required|in:pending,picked_up,in_transit,out_for_delivery,delivered,failed,returned',
            'description' => 'required|string|max:255',
            'location' => 'nullable|string|max:100',
        ]);

        $shipment = Shipment::findOrFail($shipmentId);

        // Check authorization
        if (Auth::user()->role === 'seller') {
            $sellerProductIds = Auth::user()->products->pluck('id');
            $hasSellerProducts = $shipment->order->orderItems()->whereIn('product_id', $sellerProductIds)->exists();
            
            if (!$hasSellerProducts) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
        } elseif (Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Add tracking update
        $shipment->addTrackingUpdate(
            $request->status,
            $request->description,
            $request->location
        );

        // Update order status based on shipment status
        if ($request->status === 'delivered' && $shipment->order->status !== 'delivered') {
            $shipment->order->update([
                'status' => 'delivered',
                'delivered_at' => now()
            ]);
        } elseif ($request->status === 'out_for_delivery' && $shipment->order->status === 'shipped') {
            $shipment->order->update(['status' => 'out_for_delivery']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Shipment status updated successfully',
            'shipment' => $shipment->fresh()
        ]);
    }

    public function simulateProgress($shipmentId)
    {
        $shipment = Shipment::findOrFail($shipmentId);

        // Check authorization
        if (Auth::user()->role === 'seller') {
            $sellerProductIds = Auth::user()->products->pluck('id');
            $hasSellerProducts = $shipment->order->orderItems()->whereIn('product_id', $sellerProductIds)->exists();
            
            if (!$hasSellerProducts) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
        } elseif (Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $shipment->simulateProgress();

        return response()->json([
            'success' => true,
            'message' => 'Shipment progress simulated',
            'shipment' => $shipment->fresh()
        ]);
    }

    public function getShippingLabel($shipmentId)
    {
        $shipment = Shipment::with('order.orderItems.product')->findOrFail($shipmentId);

        // Check authorization
        if (Auth::user()->role === 'seller') {
            $sellerProductIds = Auth::user()->products->pluck('id');
            $hasSellerProducts = $shipment->order->orderItems()->whereIn('product_id', $sellerProductIds)->exists();
            
            if (!$hasSellerProducts) {
                abort(403, 'Unauthorized');
            }
        } elseif (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        return view('shipping.label', compact('shipment'));
    }
}
