<x-app-layout>
    <x-slot name="header">Published Content</x-slot>

    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.content.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium">New Content</a>
    </div>

    <div class="bg-gray-800/60 border border-gray-700/50 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-900/40 text-gray-400"><tr><th class="text-left p-3">Title</th><th class="text-left p-3">Type</th><th class="text-left p-3">Status</th><th class="text-left p-3">Performance</th><th class="text-right p-3">Actions</th></tr></thead>
                <tbody class="divide-y divide-gray-700/50">
                    @forelse($items as $item)
                        <tr>
                            <td class="p-3 text-white">{{ $item->title }}<br><span class="text-xs text-gray-500">/{{ $item->slug }}</span></td>
                            <td class="p-3 text-gray-300">{{ ucfirst($item->type) }}</td>
                            <td class="p-3"><span class="px-2 py-1 rounded-full text-xs {{ $item->is_published ? 'bg-green-500/20 text-green-300' : 'bg-gray-500/20 text-gray-300' }}">{{ $item->is_published ? 'Published' : 'Draft' }}</span></td>
                            <td class="p-3 text-gray-300">{{ $item->views_count }} views • {{ $item->downloads_count }} downloads</td>
                            <td class="p-3 text-right space-x-2">
                                @if($item->is_published)<a href="{{ route('content.show', $item) }}" class="text-green-300" target="_blank">Public</a>@endif
                                <a href="{{ route('admin.content.edit', $item) }}" class="text-blue-300">Edit</a>
                                <form method="POST" action="{{ route('admin.content.destroy', $item) }}" class="inline" onsubmit="return confirm('Delete this content?')">@csrf @method('DELETE')<button class="text-red-300">Delete</button></form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="p-6 text-center text-gray-400">No content yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4">{{ $items->links() }}</div>
    </div>
</x-app-layout>
