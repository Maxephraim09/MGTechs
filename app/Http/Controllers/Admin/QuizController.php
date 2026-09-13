<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        return view('admin.quizzes.index', ['quizzes' => Quiz::latest()->paginate(15)]);
    }

    public function create()
    {
        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz creation flow is ready for implementation.');
    }

    public function store(Request $request)
    {
        return back()->with('success', 'Quiz creation flow is ready for implementation.');
    }

    public function show(Quiz $quiz)
    {
        return redirect()->route('admin.quizzes.index');
    }

    public function edit(Quiz $quiz)
    {
        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz editing flow is ready for implementation.');
    }

    public function update(Request $request, Quiz $quiz)
    {
        return back()->with('success', 'Quiz update flow is ready for implementation.');
    }

    public function destroy(Quiz $quiz)
    {
        return back()->with('success', 'Quiz delete flow is ready for implementation.');
    }

    public function questions(Quiz $quiz)
    {
        return redirect()->route('admin.quizzes.index')->with('success', 'Question management flow is ready for implementation.');
    }

    public function storeQuestion(Request $request, Quiz $quiz)
    {
        return back()->with('success', 'Question creation flow is ready for implementation.');
    }
}
