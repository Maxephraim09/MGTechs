<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">My Courses</h2>
            <a href="{{ route('courses.index') }}" class="text-sm text-blue-400 hover:text-blue-300">Browse Courses</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($enrollments as $enrollment)
                    @php($course = $enrollment->course)
                    @if($course)
                        <a href="{{ route('student.courses.show', $course) }}" class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-5 hover:border-blue-500 transition">
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $course->title }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $course->instructor->name ?? 'Instructor' }}</p>
                            <div class="mt-4">
                                <div class="flex justify-between text-xs text-gray-500">
                                    <span>Progress</span>
                                    <span>{{ $enrollment->progress ?? 0 }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mt-1">
                                    <div class="bg-blue-500 h-2 rounded-full" style="width: {{ min($enrollment->progress ?? 0, 100) }}%"></div>
                                </div>
                            </div>
                        </a>
                    @endif
                @empty
                    <div class="col-span-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-8 text-center">
                        <p class="text-gray-500 dark:text-gray-400">You have not enrolled in any courses yet.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-6">{{ $enrollments->links() }}</div>
        </div>
    </div>
</x-app-layout>
