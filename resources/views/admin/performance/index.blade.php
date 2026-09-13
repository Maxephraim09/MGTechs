<x-app-layout>
    <x-slot name="header">Website Performance</x-slot>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-gray-800/60 border border-gray-700/50 rounded-xl p-4"><p class="text-gray-400 text-sm">Users</p><p class="text-2xl text-white font-bold">{{ $totalUsers }}</p></div>
        <div class="bg-gray-800/60 border border-gray-700/50 rounded-xl p-4"><p class="text-gray-400 text-sm">Students</p><p class="text-2xl text-white font-bold">{{ $students }}</p></div>
        <div class="bg-gray-800/60 border border-gray-700/50 rounded-xl p-4"><p class="text-gray-400 text-sm">Enrollments</p><p class="text-2xl text-white font-bold">{{ $enrollments }}</p></div>
        <div class="bg-gray-800/60 border border-gray-700/50 rounded-xl p-4"><p class="text-gray-400 text-sm">Revenue</p><p class="text-2xl text-white font-bold">₦{{ number_format($revenue, 2) }}</p></div>
        <div class="bg-gray-800/60 border border-gray-700/50 rounded-xl p-4"><p class="text-gray-400 text-sm">Content Views</p><p class="text-2xl text-white font-bold">{{ number_format($contentViews) }}</p></div>
        <div class="bg-gray-800/60 border border-gray-700/50 rounded-xl p-4"><p class="text-gray-400 text-sm">Downloads</p><p class="text-2xl text-white font-bold">{{ number_format($contentDownloads) }}</p></div>
        <div class="bg-gray-800/60 border border-gray-700/50 rounded-xl p-4"><p class="text-gray-400 text-sm">Published Content</p><p class="text-2xl text-white font-bold">{{ $publishedContent }}</p></div>
        <div class="bg-gray-800/60 border border-gray-700/50 rounded-xl p-4"><p class="text-gray-400 text-sm">Approved Reviews</p><p class="text-2xl text-white font-bold">{{ $approvedReviews }}</p></div>
    </div>

    <div class="bg-gray-800/60 border border-gray-700/50 rounded-xl overflow-hidden">
        <div class="p-4 border-b border-gray-700/50"><h3 class="text-white font-semibold">Top Content</h3></div>
        <div class="divide-y divide-gray-700/50">
            @forelse($topContent as $item)
                <div class="p-4 flex items-center justify-between">
                    <div>
                        <p class="text-white">{{ $item->title }}</p>
                        <p class="text-xs text-gray-500">{{ ucfirst($item->type) }} • {{ $item->is_published ? 'Published' : 'Draft' }}</p>
                    </div>
                    <div class="text-right text-sm text-gray-300">
                        <p>{{ number_format($item->views_count) }} views</p>
                        <p>{{ number_format($item->downloads_count) }} downloads</p>
                    </div>
                </div>
            @empty
                <p class="p-6 text-center text-gray-400">No content metrics yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
