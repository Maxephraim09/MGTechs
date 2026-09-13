<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">My Certificates</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($certificates as $certificate)
                    <a href="{{ route('student.certificates.show', $certificate) }}" class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-5 hover:border-yellow-500 transition">
                        <p class="font-semibold text-gray-900 dark:text-white">{{ $certificate->course->title ?? 'Certificate' }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $certificate->certificate_number }}</p>
                        <p class="text-xs text-gray-500 mt-3">Issued {{ $certificate->issued_at?->format('M d, Y') ?? $certificate->created_at->format('M d, Y') }}</p>
                    </a>
                @empty
                    <div class="col-span-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-8 text-center">
                        <p class="text-gray-500 dark:text-gray-400">No certificates issued yet.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-6">{{ $certificates->links() }}</div>
        </div>
    </div>
</x-app-layout>
