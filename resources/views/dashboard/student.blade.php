<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('My Learning Dashboard') }}
            </h2>
            <span class="px-3 py-1 text-sm bg-green-500/10 text-green-400 rounded-full border border-green-500/20">
                <i class="fas fa-user-graduate mr-1"></i> Student
            </span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-green-600 to-emerald-600 rounded-xl p-8 mb-6 text-white">
                <h1 class="text-2xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}! 📚</h1>
                <p class="text-green-100">Continue your learning journey. Track your courses and progress.</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Enrolled Courses</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $enrolledCourses ?? 0 }}</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-500/10 rounded-xl flex items-center justify-center text-blue-500">
                                <i class="fas fa-book text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Completed Lessons</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $completedLessons ?? 0 }}</p>
                            </div>
                            <div class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center text-green-500">
                                <i class="fas fa-check-double text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Quizzes Taken</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $quizzesTaken ?? 0 }}</p>
                            </div>
                            <div class="w-12 h-12 bg-purple-500/10 rounded-xl flex items-center justify-center text-purple-500">
                                <i class="fas fa-puzzle-piece text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Certificates</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $certificates ?? 0 }}</p>
                            </div>
                            <div class="w-12 h-12 bg-yellow-500/10 rounded-xl flex items-center justify-center text-yellow-500">
                                <i class="fas fa-certificate text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- My Courses -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-semibold text-gray-900 dark:text-white">My Courses</h3>
                    <a href="{{ route('courses.index') }}" class="text-sm text-blue-400 hover:text-blue-300">Browse All Courses</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($courses ?? [] as $course)
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:shadow-lg transition">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center text-white">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900 dark:text-white text-sm">{{ $course->title ?? 'Course' }}</h4>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $course->instructor ?? 'Instructor' }}</p>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="flex justify-between text-xs text-gray-500">
                                    <span>Progress</span>
                                    <span>{{ $course->progress ?? 0 }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-2 rounded-full" style="width: {{ $course->progress ?? 0 }}%"></div>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-500">{{ $course->lessons_completed ?? 0 }}/{{ $course->total_lessons ?? 0 }} lessons</span>
                                <a href="{{ route('student.courses.show', $course->id) }}" class="text-sm text-blue-400 hover:text-blue-300">Continue →</a>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 dark:text-gray-400 col-span-3 py-8">You haven't enrolled in any courses yet.</p>
                    @endforelse
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
                <a href="{{ route('student.courses.index') }}" class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-200 dark:border-gray-700 text-center hover:border-green-500 transition">
                    <i class="fas fa-play-circle text-green-400 text-xl mb-2 block"></i>
                    <span class="text-sm text-gray-700 dark:text-gray-300">Continue Learning</span>
                </a>
                <a href="{{ route('student.courses.index') }}" class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-200 dark:border-gray-700 text-center hover:border-green-500 transition">
                    <i class="fas fa-pencil-alt text-yellow-400 text-xl mb-2 block"></i>
                    <span class="text-sm text-gray-700 dark:text-gray-300">Take a Quiz</span>
                </a>
                <a href="{{ route('student.certificates.index') }}" class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-200 dark:border-gray-700 text-center hover:border-green-500 transition">
                    <i class="fas fa-certificate text-purple-400 text-xl mb-2 block"></i>
                    <span class="text-sm text-gray-700 dark:text-gray-300">My Certificates</span>
                </a>
                <a href="{{ route('courses.index') }}" class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-200 dark:border-gray-700 text-center hover:border-green-500 transition">
                    <i class="fas fa-search text-blue-400 text-xl mb-2 block"></i>
                    <span class="text-sm text-gray-700 dark:text-gray-300">Browse Courses</span>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
