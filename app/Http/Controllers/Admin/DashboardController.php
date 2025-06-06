<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Dashboard statistics
        $stats = [
            'total_users' => User::count(),
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'total_revenue' => Order::where('status', '!=', 'cancelled')->sum('total_amount'),
            'active_users' => User::where('is_active', true)->count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'total_reviews' => Review::count(),
            'total_categories' => Category::count(),
        ];

        // Recent activities
        $recent_orders = Order::with(['user', 'orderItems.product'])
            ->latest()
            ->take(5)
            ->get();

        $recent_users = User::latest()
            ->take(5)
            ->get();

        // Monthly revenue chart data
        $monthly_revenue = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('SUM(total_amount) as revenue')
        )
        ->where('status', '!=', 'cancelled')
        ->where('created_at', '>=', Carbon::now()->subMonths(12))
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->get();

        return view('admin.dashboard', compact('stats', 'recent_orders', 'recent_users', 'monthly_revenue'));
    }
}
