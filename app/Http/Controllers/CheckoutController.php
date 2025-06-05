<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with(['product.category', 'product.seller'])
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Calculate additional costs
        $subtotal = $total;
        $shipping = 0; // Free shipping
        $tax = 0; // No tax for prototype
        $finalTotal = $subtotal + $shipping + $tax;

        return view('checkout.index', compact('cartItems', 'subtotal', 'shipping', 'tax', 'finalTotal'));
    }

    public function shipping(Request $request)
    {
        // Validate cart is not empty
        $cartItems = Cart::where('user_id', Auth::id())->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        return view('checkout.shipping');
    }

    public function payment(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'country' => 'required|string|max:100',
        ]);

        // Store shipping info in session
        session([
            'checkout_shipping' => $request->only([
                'full_name',
                'email',
                'phone',
                'address',
                'city',
                'postal_code',
                'country'
            ])
        ]);

        return view('checkout.payment');
    }

    public function review(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string|in:cod,bank_transfer,credit_card',
        ]);

        // Store payment method in session
        session(['checkout_payment_method' => $request->payment_method]);

        // Get cart items and shipping info for review
        $cartItems = Cart::with(['product.category', 'product.seller'])
            ->where('user_id', Auth::id())
            ->get();

        $shippingInfo = session('checkout_shipping');
        $paymentMethod = session('checkout_payment_method');

        if (!$shippingInfo || !$paymentMethod) {
            return redirect()->route('checkout.index')->with('error', 'Please complete all checkout steps');
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        $shipping = 0;
        $tax = 0;
        $total = $subtotal + $shipping + $tax;

        return view('checkout.review', compact('cartItems', 'shippingInfo', 'paymentMethod', 'subtotal', 'shipping', 'tax', 'total'));
    }

    public function store(Request $request)
    {
        // Get data from session
        $shippingInfo = session('checkout_shipping');
        $paymentMethod = session('checkout_payment_method');

        if (!$shippingInfo || !$paymentMethod) {
            return redirect()->route('checkout.index')->with('error', 'Please complete all checkout steps');
        }

        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $order = DB::transaction(function () use ($shippingInfo, $paymentMethod, $cartItems, $total) {
            // Create order
            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'user_id' => Auth::id(),
                'total_amount' => $total,
                'status' => 'pending',
                'shipping_address' => json_encode($shippingInfo),
                'payment_method' => $paymentMethod,
            ]);

            // Create order items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'size' => $cartItem->size,
                    'color' => $cartItem->color,
                    'price' => $cartItem->product->price,
                ]);

                // Update product stock
                $cartItem->product->decrement('stock', $cartItem->quantity);
            }

            // Clear cart
            Cart::where('user_id', Auth::id())->delete();

            return $order;
        });

        // Clear checkout session data
        session()->forget(['checkout_shipping', 'checkout_payment_method']);

        return redirect()->route('checkout.success', $order->id)->with('success', 'Order placed successfully!');
    }

    public function success($orderId)
    {
        $order = Order::with(['orderItems.product'])
            ->where('id', $orderId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('checkout.success', compact('order'));
    }
}
