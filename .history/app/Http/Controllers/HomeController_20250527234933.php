<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'seller'])
            ->where('is_active', true)
            ->where('stock', '>', 0);

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Category filter
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Price filter
        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->paginate(12);
        $categories = Category::where('is_active', true)->get();

        return view('home', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        $product->load(['category', 'seller', 'reviews.user']);

        return view('products.show', compact('product'));
    }
}
