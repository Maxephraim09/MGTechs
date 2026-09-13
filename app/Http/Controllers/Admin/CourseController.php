<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return view('admin.courses.index', [
            'courses' => Course::with(['instructor', 'category'])->latest()->paginate(15),
        ]);
    }

    public function create()
    {
        return view('admin.courses.create', $this->formData());
    }

    public function show(Course $course)
    {
        $course->load(['instructor', 'category', 'lessons'])
            ->loadCount(['enrollments', 'lessons']);

        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', array_merge(['course' => $course->load(['instructor', 'category'])], $this->formData()));
    }

    public function store(Request $request)
    {
        return back()->with('success', 'Course creation form is ready for implementation.');
    }

    public function update(Request $request, Course $course)
    {
        return back()->with('success', 'Course update flow is ready for implementation.');
    }

    public function destroy(Course $course)
    {
        return back()->with('success', 'Course delete flow is ready for implementation.');
    }

    public function publish(Course $course)
    {
        $course->update(['is_published' => true]);

        return back()->with('success', 'Course published.');
    }

    public function unpublish(Course $course)
    {
        $course->update(['is_published' => false]);

        return back()->with('success', 'Course unpublished.');
    }

    private function formData(): array
    {
        return [
            'instructors' => User::where('role', 'admin')
                ->orderBy('name')
                ->get(['id', 'name']),
            'categories' => CourseCategory::orderBy('name')->get(),
        ];
    }
}
