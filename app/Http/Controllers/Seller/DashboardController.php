<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $sellerId = Auth::id();

        // Get seller's products
        $products = Product::where('seller_id', $sellerId)->get();
        $productIds = $products->pluck('id');

        // Basic Statistics
        $totalProducts = $products->count();
        $activeProducts = $products->where('is_active', true)->count();
        $lowStockProducts = $products->where('stock', '<=', 10)->count();

        // Sales Statistics
        $totalOrders = OrderItem::whereIn('product_id', $productIds)->count();
        $totalRevenue = OrderItem::whereIn('product_id', $productIds)->sum(DB::raw('price * quantity'));

        // Monthly Revenue (current month)
        $monthlyRevenue = OrderItem::whereIn('product_id', $productIds)
            ->whereHas('order', function ($query) {
                $query->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
            })
            ->sum(DB::raw('price * quantity'));

        // Pending Orders
        $pendingOrders = OrderItem::whereIn('product_id', $productIds)
            ->whereHas('order', function ($query) {
                $query->where('status', 'pending');
            })
            ->count();

        // Recent Orders (last 30 days)
        $recentOrders = OrderItem::with(['order.user', 'product'])
            ->whereIn('product_id', $productIds)
            ->whereHas('order', function ($query) {
                $query->where('created_at', '>=', Carbon::now()->subDays(30));
            })
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Monthly Sales Data (last 6 months)
        $monthlySales = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $sales = OrderItem::whereIn('product_id', $productIds)
                ->whereHas('order', function ($query) use ($month) {
                    $query->whereYear('created_at', $month->year)
                        ->whereMonth('created_at', $month->month);
                })
                ->sum(DB::raw('price * quantity'));

            $monthlySales[] = [
                'month' => $month->format('M Y'),
                'sales' => $sales
            ];
        }

        // Top Selling Products
        $topProducts = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_sold'), DB::raw('SUM(price * quantity) as total_revenue'))
            ->whereIn('product_id', $productIds)
            ->groupBy('product_id')
            ->orderBy('total_sold', 'desc')
            ->limit(5)
            ->with('product')
            ->get();

        // Low Stock Alert
        $lowStockAlert = $products->where('stock', '<=', 10)->where('is_active', true);

        // Recent Activity
        $recentActivity = collect([
            // Recent orders
            ...$recentOrders->take(5)->map(function ($orderItem) {
                return [
                    'type' => 'order',
                    'message' => "Pesanan baru untuk {$orderItem->product->name}",
                    'time' => $orderItem->created_at,
                    'icon' => 'shopping-cart',
                    'color' => 'green'
                ];
            }),
            // Low stock alerts
            ...$lowStockAlert->take(3)->map(function ($product) {
                return [
                    'type' => 'stock',
                    'message' => "Stok {$product->name} hampir habis ({$product->stock} tersisa)",
                    'time' => $product->updated_at,
                    'icon' => 'exclamation-triangle',
                    'color' => 'red'
                ];
            })
        ])->sortByDesc('time')->take(8);

        return view('seller.dashboard', compact(
            'totalProducts',
            'activeProducts',
            'lowStockProducts',
            'totalOrders',
            'totalRevenue',
            'monthlyRevenue',
            'pendingOrders',
            'recentOrders',
            'monthlySales',
            'topProducts',
            'lowStockAlert',
            'recentActivity'
        ));
    }
}
