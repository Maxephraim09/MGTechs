<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MarketingController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.dashboard')->with('success', 'Marketing dashboard is ready for implementation.');
    }

    public function sendEmail(Request $request)
    {
        return back()->with('success', 'Email campaign flow is ready for implementation.');
    }

    public function sendSms(Request $request)
    {
        return back()->with('success', 'SMS campaign flow is ready for implementation.');
    }

    public function bulkEmail(Request $request)
    {
        return back()->with('success', 'Bulk email flow is ready for implementation.');
    }

    public function bulkSms(Request $request)
    {
        return back()->with('success', 'Bulk SMS flow is ready for implementation.');
    }
}
