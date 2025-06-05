<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // Get seller's products to filter orders
        $sellerProductIds = Product::where('seller_id', Auth::id())->pluck('id');

        $query = Order::with(['orderItems.product', 'user'])
            ->whereHas('orderItems', function ($q) use ($sellerProductIds) {
                $q->whereIn('product_id', $sellerProductIds);
            });

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Search by order number or customer name
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', '%' . $search . '%')
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('name', 'like', '%' . $search . '%')
                               ->orWhere('email', 'like', '%' . $search . '%');
                  });
            });
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(15);

        // Get status counts for filter tabs
        $statusCounts = [
            'all' => Order::whereHas('orderItems', function ($q) use ($sellerProductIds) {
                $q->whereIn('product_id', $sellerProductIds);
            })->count(),
            'pending' => Order::whereHas('orderItems', function ($q) use ($sellerProductIds) {
                $q->whereIn('product_id', $sellerProductIds);
            })->where('status', 'pending')->count(),
            'processing' => Order::whereHas('orderItems', function ($q) use ($sellerProductIds) {
                $q->whereIn('product_id', $sellerProductIds);
            })->where('status', 'processing')->count(),
            'shipped' => Order::whereHas('orderItems', function ($q) use ($sellerProductIds) {
                $q->whereIn('product_id', $sellerProductIds);
            })->where('status', 'shipped')->count(),
            'delivered' => Order::whereHas('orderItems', function ($q) use ($sellerProductIds) {
                $q->whereIn('product_id', $sellerProductIds);
            })->where('status', 'delivered')->count(),
        ];

        // Calculate revenue statistics
        $totalRevenue = Order::whereHas('orderItems', function ($q) use ($sellerProductIds) {
            $q->whereIn('product_id', $sellerProductIds);
        })->where('status', '!=', 'cancelled')->sum('total_amount');

        $monthlyRevenue = Order::whereHas('orderItems', function ($q) use ($sellerProductIds) {
            $q->whereIn('product_id', $sellerProductIds);
        })->where('status', '!=', 'cancelled')
          ->whereMonth('created_at', now()->month)
          ->sum('total_amount');

        return view('seller.orders.index', compact('orders', 'statusCounts', 'totalRevenue', 'monthlyRevenue'));
    }

    public function show($id)
    {
        // Get seller's products to ensure they can only view their orders
        $sellerProductIds = Product::where('seller_id', Auth::id())->pluck('id');

        $order = Order::with(['orderItems.product', 'user'])
            ->whereHas('orderItems', function ($q) use ($sellerProductIds) {
                $q->whereIn('product_id', $sellerProductIds);
            })
            ->findOrFail($id);

        // Filter order items to only show seller's products
        $sellerOrderItems = $order->orderItems->filter(function ($item) use ($sellerProductIds) {
            return $sellerProductIds->contains($item->product_id);
        });

        return view('seller.orders.show', compact('order', 'sellerOrderItems'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,out_for_delivery,delivered',
            'tracking_number' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:500',
        ]);

        // Get seller's products to ensure they can only update their orders
        $sellerProductIds = Product::where('seller_id', Auth::id())->pluck('id');

        $order = Order::whereHas('orderItems', function ($q) use ($sellerProductIds) {
            $q->whereIn('product_id', $sellerProductIds);
        })->findOrFail($id);

        // Validate status transition (can only move forward)
        $statusOrder = ['pending', 'processing', 'shipped', 'out_for_delivery', 'delivered'];
        $currentStatusIndex = array_search($order->status, $statusOrder);
        $newStatusIndex = array_search($request->status, $statusOrder);

        if ($newStatusIndex < $currentStatusIndex) {
            return redirect()->back()->with('error', 'Cannot move order status backward.');
        }

        // Update order status
        $updateData = ['status' => $request->status];

        // Add timestamps for specific statuses
        if ($request->status === 'shipped' && !$order->shipped_at) {
            $updateData['shipped_at'] = now();
        }
        if ($request->status === 'delivered' && !$order->delivered_at) {
            $updateData['delivered_at'] = now();
        }

        $order->update($updateData);

        // Log the status change (you can implement a proper audit log later)
        \Log::info('Order status updated', [
            'order_id' => $order->id,
            'order_number' => $order->order_number,
            'old_status' => $order->getOriginal('status'),
            'new_status' => $request->status,
            'seller_id' => Auth::id(),
            'tracking_number' => $request->tracking_number,
            'notes' => $request->notes,
        ]);

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    public function bulkUpdateStatus(Request $request)
    {
        $request->validate([
            'order_ids' => 'required|array',
            'order_ids.*' => 'exists:orders,id',
            'status' => 'required|in:processing,shipped,out_for_delivery,delivered',
        ]);

        // Get seller's products
        $sellerProductIds = Product::where('seller_id', Auth::id())->pluck('id');

        $orders = Order::whereHas('orderItems', function ($q) use ($sellerProductIds) {
            $q->whereIn('product_id', $sellerProductIds);
        })->whereIn('id', $request->order_ids)->get();

        $updatedCount = 0;
        foreach ($orders as $order) {
            // Validate status transition
            $statusOrder = ['pending', 'processing', 'shipped', 'out_for_delivery', 'delivered'];
            $currentStatusIndex = array_search($order->status, $statusOrder);
            $newStatusIndex = array_search($request->status, $statusOrder);

            if ($newStatusIndex >= $currentStatusIndex) {
                $updateData = ['status' => $request->status];

                if ($request->status === 'shipped' && !$order->shipped_at) {
                    $updateData['shipped_at'] = now();
                }
                if ($request->status === 'delivered' && !$order->delivered_at) {
                    $updateData['delivered_at'] = now();
                }

                $order->update($updateData);
                $updatedCount++;
            }
        }

        return redirect()->back()->with('success', "Successfully updated {$updatedCount} orders.");
    }

    public function analytics()
    {
        // Get seller's products
        $sellerProductIds = Product::where('seller_id', Auth::id())->pluck('id');

        // Revenue analytics
        $totalRevenue = Order::whereHas('orderItems', function ($q) use ($sellerProductIds) {
            $q->whereIn('product_id', $sellerProductIds);
        })->where('status', '!=', 'cancelled')->sum('total_amount');

        $monthlyRevenue = Order::whereHas('orderItems', function ($q) use ($sellerProductIds) {
            $q->whereIn('product_id', $sellerProductIds);
        })->where('status', '!=', 'cancelled')
          ->whereMonth('created_at', now()->month)
          ->sum('total_amount');

        // Order analytics
        $totalOrders = Order::whereHas('orderItems', function ($q) use ($sellerProductIds) {
            $q->whereIn('product_id', $sellerProductIds);
        })->count();

        $pendingOrders = Order::whereHas('orderItems', function ($q) use ($sellerProductIds) {
            $q->whereIn('product_id', $sellerProductIds);
        })->where('status', 'pending')->count();

        // Top selling products
        $topProducts = OrderItem::whereIn('product_id', $sellerProductIds)
            ->select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('product_id')
            ->orderBy('total_sold', 'desc')
            ->limit(5)
            ->with('product')
            ->get();

        return view('seller.orders.analytics', compact(
            'totalRevenue', 'monthlyRevenue', 'totalOrders', 'pendingOrders', 'topProducts'
        ));
    }
}
