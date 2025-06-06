<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::with(['user', 'product', 'order']);

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->whereHas('product', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })->orWhereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        // Status filter
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Rating filter
        if ($request->has('rating') && $request->rating) {
            $query->where('rating', $request->rating);
        }

        $reviews = $query->latest()->paginate(15);

        return view('admin.reviews.index', compact('reviews'));
    }

    public function show(Review $review)
    {
        $review->load(['user', 'product', 'order']);
        return view('admin.reviews.show', compact('review'));
    }

    public function updateStatus(Request $request, Review $review)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $review->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Review status updated successfully.');
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->back()->with('success', 'Review has been deleted successfully.');
    }
}
