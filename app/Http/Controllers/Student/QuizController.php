<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

class QuizController extends Controller
{
    public function take()
    {
        return back()->with('success', 'Quiz taking flow is ready for implementation.');
    }

    public function submit()
    {
        return back()->with('success', 'Quiz submission flow is ready for implementation.');
    }

    public function result()
    {
        return back();
    }
}
