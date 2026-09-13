<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index(Request $request)
    {
        return view('student.certificates.index', [
            'certificates' => Certificate::where('user_id', $request->user()->id)->with('course')->latest()->paginate(12),
        ]);
    }

    public function show(Certificate $certificate)
    {
        return view('student.certificates.show', compact('certificate'));
    }

    public function print(Certificate $certificate)
    {
        return $this->show($certificate);
    }

    public function download(Certificate $certificate)
    {
        return $this->show($certificate);
    }

    public function verify(string $code)
    {
        $certificate = Certificate::where('certificate_number', $code)->firstOrFail();

        return view('student.certificates.show', compact('certificate'));
    }
}
