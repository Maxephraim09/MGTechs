<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        return view('reviews.index', [
            'reviews' => Testimonial::approved()->latest()->paginate(12),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'role' => 'nullable|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'text' => 'required|string|max:2000',
        ]);

        Testimonial::create($validated + [
            'status' => 'pending',
            'is_active' => false,
        ]);

        return back()->with('success', 'Thank you. Your review has been submitted for approval.');
    }
}
