<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        return view('student.courses.index', [
            'enrollments' => Enrollment::where('user_id', $request->user()->id)->with('course.instructor')->latest()->paginate(12),
        ]);
    }

    public function show(Request $request, Course $course)
    {
        $enrollment = Enrollment::where('user_id', $request->user()->id)->where('course_id', $course->id)->first();

        return view('student.courses.show', compact('course', 'enrollment'));
    }

    public function lesson()
    {
        return back()->with('success', 'Lesson view is ready for implementation.');
    }

    public function enroll(Request $request, Course $course)
    {
        Enrollment::firstOrCreate(
            ['user_id' => $request->user()->id, 'course_id' => $course->id],
            ['status' => 'active', 'progress' => 0]
        );

        return redirect()->route('student.courses.show', $course)->with('success', 'Enrollment created.');
    }

    public function complete()
    {
        return back()->with('success', 'Lesson progress flow is ready for implementation.');
    }

    public function progress(Request $request, Course $course)
    {
        return redirect()->route('student.courses.show', $course);
    }
}
