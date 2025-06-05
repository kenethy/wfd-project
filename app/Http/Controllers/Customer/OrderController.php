<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $query = Order::with(['orderItems.product.category', 'orderItems.product.seller'])
            ->where('user_id', Auth::id());

        // Filter by status if provided
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Search by order number
        if ($request->has('search') && $request->search) {
            $query->where('order_number', 'like', '%' . $request->search . '%');
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(10);

        // Get status counts for filter tabs
        $statusCounts = [
            'all' => Order::where('user_id', Auth::id())->count(),
            'pending' => Order::where('user_id', Auth::id())->where('status', 'pending')->count(),
            'processing' => Order::where('user_id', Auth::id())->where('status', 'processing')->count(),
            'shipped' => Order::where('user_id', Auth::id())->where('status', 'shipped')->count(),
            'out_for_delivery' => Order::where('user_id', Auth::id())->where('status', 'out_for_delivery')->count(),
            'delivered' => Order::where('user_id', Auth::id())->where('status', 'delivered')->count(),
            'cancelled' => Order::where('user_id', Auth::id())->where('status', 'cancelled')->count(),
        ];

        return view('customer.orders.index', compact('orders', 'statusCounts'));
    }

    public function show($id)
    {
        $order = Order::with(['orderItems.product.category', 'orderItems.product.seller'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('customer.orders.show', compact('order'));
    }

    public function cancel(Request $request, $id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);

        if (!$order->canBeCancelled()) {
            return redirect()->back()->with('error', 'This order cannot be cancelled.');
        }

        $order->update(['status' => 'cancelled']);

        // Restore product stock
        foreach ($order->orderItems as $item) {
            $item->product->increment('stock', $item->quantity);
        }

        return redirect()->back()->with('success', 'Order has been cancelled successfully.');
    }

    public function reorder($id)
    {
        $order = Order::with('orderItems.product')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        if (!$order->canBeReordered()) {
            return redirect()->back()->with('error', 'This order cannot be reordered.');
        }

        DB::transaction(function () use ($order) {
            foreach ($order->orderItems as $item) {
                // Check if product is still available
                if ($item->product && $item->product->is_active && $item->product->stock >= $item->quantity) {
                    // Check if item already exists in cart
                    $existingCartItem = Cart::where('user_id', Auth::id())
                        ->where('product_id', $item->product_id)
                        ->where('size', $item->size)
                        ->where('color', $item->color)
                        ->first();

                    if ($existingCartItem) {
                        $existingCartItem->increment('quantity', $item->quantity);
                    } else {
                        Cart::create([
                            'user_id' => Auth::id(),
                            'product_id' => $item->product_id,
                            'quantity' => $item->quantity,
                            'size' => $item->size,
                            'color' => $item->color,
                        ]);
                    }
                }
            }
        });

        return redirect()->route('cart.index')->with('success', 'Items have been added to your cart.');
    }

    public function track($id)
    {
        $order = Order::with(['orderItems.product'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('customer.orders.track', compact('order'));
    }
}
