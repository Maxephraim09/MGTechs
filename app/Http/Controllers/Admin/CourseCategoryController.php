<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseCategoryController extends Controller
{
    public function index()
    {
        return view('admin.course-categories.index', [
            'categories' => CourseCategory::withCount('courses')->latest()->paginate(20),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:course_categories,slug',
            'is_active' => 'nullable|boolean',
        ]);

        CourseCategory::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'] ?: Str::slug($validated['name']),
            'is_active' => $request->boolean('is_active'),
        ]);

        return back()->with('success', 'Course category created.');
    }

    public function update(Request $request, CourseCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:course_categories,slug,'.$category->id,
            'is_active' => 'nullable|boolean',
        ]);

        $category->update([
            'name' => $validated['name'],
            'slug' => $validated['slug'] ?: Str::slug($validated['name']),
            'is_active' => $request->boolean('is_active'),
        ]);

        return back()->with('success', 'Course category updated.');
    }

    public function destroy(CourseCategory $category)
    {
        $category->delete();

        return back()->with('success', 'Course category deleted.');
    }
}
