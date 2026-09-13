<x-app-layout>
    <x-slot name="header">Course Categories</x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="bg-gray-800/60 border border-gray-700/50 rounded-xl p-5">
            <h3 class="text-white font-semibold mb-4">Create Category</h3>
            <form method="POST" action="{{ route('admin.course-categories.store') }}" class="space-y-4">
                @csrf
                <input name="name" value="{{ old('name') }}" required placeholder="Category name" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white">
                <input name="slug" value="{{ old('slug') }}" placeholder="optional-slug" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white">
                <label class="flex items-center gap-2 text-sm text-gray-300">
                    <input type="checkbox" name="is_active" value="1" checked class="accent-blue-600"> Active
                </label>
                <button class="px-5 py-2.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-medium">Save Category</button>
            </form>
        </div>

        <div class="lg:col-span-2 bg-gray-800/60 border border-gray-700/50 rounded-xl overflow-hidden">
            <div class="p-4 border-b border-gray-700/50 flex justify-between">
                <h3 class="text-white font-semibold">All Categories</h3>
                <span class="text-sm text-gray-400">{{ $categories->total() }} total</span>
            </div>
            <div class="divide-y divide-gray-700/50">
                @forelse($categories as $category)
                    <form method="POST" action="{{ route('admin.course-categories.update', $category) }}" class="p-4 grid grid-cols-1 md:grid-cols-12 gap-3 items-center">
                        @csrf
                        @method('PUT')
                        <input name="name" value="{{ $category->name }}" class="md:col-span-3 bg-gray-700/50 border border-gray-600 rounded-lg px-3 py-2 text-white">
                        <input name="slug" value="{{ $category->slug }}" class="md:col-span-3 bg-gray-700/50 border border-gray-600 rounded-lg px-3 py-2 text-white">
                        <span class="md:col-span-2 text-sm text-gray-400">{{ $category->courses_count }} courses</span>
                        <label class="md:col-span-2 flex items-center gap-2 text-sm text-gray-300">
                            <input type="checkbox" name="is_active" value="1" {{ $category->is_active ? 'checked' : '' }} class="accent-blue-600"> Active
                        </label>
                        <button class="md:col-span-1 px-3 py-2 rounded-lg bg-blue-600 text-white text-sm">Update</button>
                        <button form="delete-category-{{ $category->id }}" class="md:col-span-1 px-3 py-2 rounded-lg bg-red-600/20 text-red-300 text-sm" onclick="return confirm('Delete this category?')">Delete</button>
                    </form>
                    <form id="delete-category-{{ $category->id }}" method="POST" action="{{ route('admin.course-categories.destroy', $category) }}" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                @empty
                    <p class="p-6 text-center text-gray-400">No categories yet.</p>
                @endforelse
            </div>
            <div class="p-4">{{ $categories->links() }}</div>
        </div>
    </div>
</x-app-layout>
