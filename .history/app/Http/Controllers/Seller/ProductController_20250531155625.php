<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')
            ->where('seller_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('seller.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('seller.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'sizes' => 'nullable|array',
            'colors' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;
        $product->seller_id = Auth::id();
        $product->sizes = $request->sizes;
        $product->colors = $request->colors;

        // Handle image uploads
        $images = [];
        if ($request->hasFile('images')) {
            // Ensure the products directory exists
            $productsPath = storage_path('app/public/products');
            if (!file_exists($productsPath)) {
                mkdir($productsPath, 0755, true);
            }

            foreach ($request->file('images') as $index => $image) {
                try {
                    // Generate unique filename with timestamp and random string
                    $filename = time() . '_' . uniqid() . '_' . $index . '.' . $image->getClientOriginalExtension();

                    // Store the image
                    $path = $image->storeAs('public/products', $filename);

                    if ($path) {
                        $images[] = $filename;
                    }
                } catch (\Exception $e) {
                    // Log error but continue with other images
                    \Log::error('Failed to upload image: ' . $e->getMessage());
                }
            }
        }

        $product->images = $images;
        $product->save();

        $message = count($images) > 0
            ? 'Produk berhasil ditambahkan dengan ' . count($images) . ' gambar!'
            : 'Produk berhasil ditambahkan!';

        return redirect()->route('seller.products.index')->with('success', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // Check if product belongs to current seller
        if ($product->seller_id !== Auth::id()) {
            abort(403);
        }

        return view('seller.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // Check if product belongs to current seller
        if ($product->seller_id !== Auth::id()) {
            abort(403);
        }

        $categories = Category::where('is_active', true)->get();
        return view('seller.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Check if product belongs to current seller
        if ($product->seller_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'sizes' => 'nullable|array',
            'colors' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;
        $product->sizes = $request->sizes;
        $product->colors = $request->colors;

        // Handle new image uploads
        if ($request->hasFile('images')) {
            // Delete old images
            if ($product->images) {
                foreach ($product->images as $oldImage) {
                    Storage::delete('public/products/' . $oldImage);
                }
            }

            $images = [];
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/products', $filename);
                $images[] = $filename;
            }
            $product->images = $images;
        }

        $product->save();

        return redirect()->route('seller.products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Check if product belongs to current seller
        if ($product->seller_id !== Auth::id()) {
            abort(403);
        }

        // Delete images
        if ($product->images) {
            foreach ($product->images as $image) {
                Storage::delete('public/products/' . $image);
            }
        }

        $product->delete();

        return redirect()->route('seller.products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
