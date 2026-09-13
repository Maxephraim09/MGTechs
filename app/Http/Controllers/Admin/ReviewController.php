<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        return view('admin.reviews.index', [
            'reviews' => Testimonial::latest()->paginate(20),
        ]);
    }

    public function update(Request $request, Testimonial $review)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $review->update([
            'status' => $validated['status'],
            'is_active' => $validated['status'] === 'approved',
        ]);

        return back()->with('success', 'Review updated.');
    }

    public function destroy(Testimonial $review)
    {
        $review->delete();

        return back()->with('success', 'Review deleted.');
    }
}
