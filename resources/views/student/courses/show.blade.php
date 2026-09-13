<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $course->title }}</h2>
            <a href="{{ route('student.courses.index') }}" class="text-sm text-blue-400 hover:text-blue-300">Back to Courses</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6">
                <p class="text-gray-700 dark:text-gray-300">{{ $course->description ?? 'No course description available.' }}</p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                    <div class="bg-gray-50 dark:bg-gray-700/40 rounded-lg p-4">
                        <p class="text-xs text-gray-500">Instructor</p>
                        <p class="font-semibold text-gray-900 dark:text-white">{{ $course->instructor->name ?? 'Instructor' }}</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700/40 rounded-lg p-4">
                        <p class="text-xs text-gray-500">Type</p>
                        <p class="font-semibold text-gray-900 dark:text-white">{{ ucfirst($course->type ?? 'free') }}</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700/40 rounded-lg p-4">
                        <p class="text-xs text-gray-500">Progress</p>
                        <p class="font-semibold text-gray-900 dark:text-white">{{ $enrollment->progress ?? 0 }}%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
