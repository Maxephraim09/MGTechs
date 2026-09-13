<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\MediaItem;
use App\Models\Payment;
use App\Models\Testimonial;
use App\Models\User;

class PerformanceController extends Controller
{
    public function index()
    {
        return view('admin.performance.index', [
            'totalUsers' => User::count(),
            'students' => User::students()->count(),
            'enrollments' => Enrollment::count(),
            'revenue' => Payment::whereIn('status', ['successful', 'paid'])->sum('amount'),
            'contentViews' => MediaItem::sum('views_count'),
            'contentDownloads' => MediaItem::sum('downloads_count'),
            'publishedContent' => MediaItem::published()->count(),
            'approvedReviews' => Testimonial::approved()->count(),
            'topContent' => MediaItem::latest('views_count')->limit(8)->get(),
        ]);
    }
}
