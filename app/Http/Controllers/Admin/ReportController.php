<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Project;
use App\Models\User;

class ReportController extends Controller
{
    public function index()
    {
        return view('dashboard.admin', [
            'totalUsers' => User::count(),
            'totalRevenue' => Payment::sum('amount'),
            'activeProjects' => Project::active()->count(),
            'pendingProjects' => Project::whereIn('status', ['planning', 'pending'])->count(),
            'totalStudents' => User::students()->count(),
            'recentUsers' => User::latest()->limit(5)->get(),
            'recentActivities' => collect(),
        ]);
    }

    public function revenue()
    {
        return $this->index();
    }

    public function users()
    {
        return $this->index();
    }
}
