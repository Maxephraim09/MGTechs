<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">My Feedback</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800/60 border border-gray-700/50 rounded-xl divide-y divide-gray-700/50">
                @forelse($updates as $update)
                    <div class="p-4">
                        <p class="text-sm text-gray-400">{{ $update->project->title ?? 'Project' }} - {{ $update->created_at->diffForHumans() }}</p>
                        <p class="text-white mt-1">{{ $update->client_feedback }}</p>
                        @if($update->rating)<p class="text-sm text-yellow-400 mt-1">Rating: {{ $update->rating }}/5</p>@endif
                    </div>
                @empty
                    <p class="p-8 text-center text-gray-500">No feedback submitted yet.</p>
                @endforelse
            </div>
            <div class="mt-4">{{ $updates->links() }}</div>
        </div>
    </div>
</x-app-layout>
