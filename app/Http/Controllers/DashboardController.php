<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\ActivityLog;
use App\Models\Certificate;
use App\Models\Payment;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            return $this->admin();
        } elseif ($user->role === 'client') {
            return $this->client();
        } elseif ($user->role === 'student') {
            return $this->student();
        }
        
        return redirect()->route('home');
    }

    public function admin()
    {
        $data = [
            'totalUsers' => User::count(),
            'newUsers' => User::whereDate('created_at', '>=', now()->subDays(7))->count(),
            'totalRevenue' => Payment::where('status', 'successful')->orWhere('status', 'paid')->sum('amount'),
            'activeProjects' => Project::active()->count(),
            'pendingProjects' => Project::whereIn('status', ['planning', 'pending'])->count(),
            'totalStudents' => User::where('role', 'student')->count(),
            'newStudents' => User::where('role', 'student')->whereDate('created_at', '>=', now()->subDays(30))->count(),
            'recentActivities' => ActivityLog::latest()->limit(5)->get(),
            'recentUsers' => User::latest()->limit(5)->get(),
            'recentProjects' => Project::with('client')->latest()->limit(5)->get(),
        ];
        
        return view('dashboard.admin', $data);
    }

    public function client()
    {
        $user = Auth::user();
        
        $data = [
            'activeProjects' => Project::forClient($user)->active()->count(),
            'completedProjects' => Project::forClient($user)->completed()->count(),
            'totalFiles' => ProjectFile::whereHas('project', fn ($query) => $query->forClient($user))->count(),
            'projects' => Project::forClient($user)->latest()->limit(5)->get(),
            'stats' => [
                'total' => Project::forClient($user)->count(),
                'active' => Project::forClient($user)->active()->count(),
                'completed' => Project::forClient($user)->completed()->count(),
                'pending' => Project::forClient($user)->whereIn('status', ['planning', 'pending'])->count(),
                'files' => ProjectFile::whereHas('project', fn ($query) => $query->forClient($user))->count(),
            ],
        ];
        
        return view('dashboard.client', $data);
    }

    public function student()
    {
        $userId = Auth::id();
        
        $enrollments = Enrollment::where('user_id', $userId)->with('course.instructor')->get();
        $completedLessons = $enrollments->sum('progress');
        
        $data = [
            'enrolledCourses' => $enrollments->count(),
            'completedLessons' => $completedLessons,
            'quizzesTaken' => Schema::hasColumn('quiz_attempts', 'user_id') ? QuizAttempt::where('user_id', $userId)->count() : 0,
            'certificates' => Certificate::where('user_id', $userId)->count(),
            'courses' => $enrollments->map(function($enrollment) {
                $course = $enrollment->course;
                if ($course) {
                    $total = method_exists($course, 'lessons') ? $course->lessons()->count() : 0;
                    $progress = $total > 0 ? round(($enrollment->progress ?? 0) / $total * 100) : min((int) ($enrollment->progress ?? 0), 100);
                    return (object) [
                        'id' => $course->id,
                        'title' => $course->title,
                        'instructor' => $course->instructor->name ?? 'Instructor',
                        'progress' => $progress,
                        'lessons_completed' => $enrollment->progress ?? 0,
                        'total_lessons' => $total,
                    ];
                }
                return null;
            })->filter()->values(),
        ];
        
        return view('dashboard.student', $data);
    }

    public function guest()
    {
        return view('dashboard.guest');
    }
}
