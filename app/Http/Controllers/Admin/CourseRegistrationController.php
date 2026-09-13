<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\User;

class CourseRegistrationController extends Controller
{
    public function index()
    {
        return view('admin.course-registrations.index', [
            'enrollments' => Enrollment::with(['user', 'course'])->latest()->paginate(20),
            'payments' => Payment::with('user')->latest()->limit(20)->get(),
            'studentCount' => User::students()->count(),
            'enrollmentCount' => Enrollment::count(),
            'paidTotal' => Payment::whereIn('status', ['successful', 'paid'])->sum('amount'),
            'pendingPayments' => Payment::where('status', 'pending')->count(),
        ]);
    }
}
