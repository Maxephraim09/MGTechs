<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Certificate</h2>
            <a href="{{ route('student.certificates.index') }}" class="text-sm text-blue-400 hover:text-blue-300">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-8 text-center">
                <p class="text-sm uppercase tracking-wider text-gray-500">Certificate of Completion</p>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mt-3">{{ $certificate->course->title ?? 'Course' }}</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-4">Certificate No: {{ $certificate->certificate_number }}</p>
                <p class="text-gray-500 dark:text-gray-400">Issued {{ $certificate->issued_at?->format('M d, Y') ?? $certificate->created_at->format('M d, Y') }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
