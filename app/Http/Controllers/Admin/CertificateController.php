<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CertificateController extends Controller
{
    public function index()
    {
        return view('admin.certificates.index', [
            'certificates' => Certificate::with(['user', 'course'])->latest()->paginate(20),
            'students' => User::students()->orderBy('name')->get(['id', 'name']),
            'courses' => Course::orderBy('title')->get(['id', 'title']),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'certificate_number' => 'nullable|string|max:255|unique:certificates,certificate_number',
        ]);

        Certificate::create($validated + [
            'certificate_number' => $validated['certificate_number'] ?? 'CERT-'.now()->format('Ymd').'-'.Str::upper(Str::random(6)),
            'issued_at' => now(),
        ]);

        return back()->with('success', 'Certificate issued.');
    }

    public function destroy(Certificate $certificate)
    {
        $certificate->delete();

        return back()->with('success', 'Certificate deleted.');
    }
}
