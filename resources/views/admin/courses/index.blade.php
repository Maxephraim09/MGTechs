<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('All Courses') }}
            </h2>
            <a href="{{ route('admin.courses.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition shadow-lg shadow-blue-600/20">
                <i class="fas fa-plus-circle mr-2"></i> New Course
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800/60 rounded-xl border border-gray-700/50 overflow-hidden">
                <!-- Filters -->
                <div class="p-4 border-b border-gray-700/50 flex flex-wrap gap-3 items-center justify-between">
                    <div class="flex items-center gap-3 flex-wrap">
                        <div class="relative">
                            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm"></i>
                            <input type="text" placeholder="Search courses..." class="pl-9 pr-4 py-2 bg-gray-700/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition w-56 md:w-64">
                        </div>
                        <select class="px-4 py-2 bg-gray-700/50 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition">
                            <option value="">All Status</option>
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                        <select class="px-4 py-2 bg-gray-700/50 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition">
                            <option value="">All Types</option>
                            <option value="free">Free</option>
                            <option value="paid">Paid</option>
                        </select>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-400">{{ $courses->total() ?? 0 }} courses</span>
                    </div>
                </div>

                <!-- Courses Grid -->
                <div class="p-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($courses ?? [] as $course)
                        <div class="bg-gray-700/20 rounded-xl border border-gray-700/50 overflow-hidden hover:border-blue-500/30 transition group">
                            <div class="relative h-32 bg-gradient-to-r from-blue-600 to-purple-600">
                                <div class="absolute inset-0 bg-black/20"></div>
                                <div class="absolute bottom-3 left-3">
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        {{ $course->type === 'free' ? 'bg-green-500/20 text-green-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                                        {{ ucfirst($course->type ?? 'free') }}
                                    </span>
                                    <span class="px-2 py-1 text-xs rounded-full bg-white/10 text-white ml-1">
                                        {{ $course->students_count ?? 0 }} students
                                    </span>
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="text-sm font-semibold text-white group-hover:text-blue-400 transition">
                                    <a href="{{ route('admin.courses.show', $course) }}">{{ $course->title }}</a>
                                </h3>
                                <p class="text-xs text-gray-400 mt-1">By {{ $course->instructor->name ?? 'N/A' }}</p>
                                <p class="text-xs text-gray-500 mt-2 line-clamp-2">{{ $course->description ?? 'No description' }}</p>
                                <div class="flex justify-between items-center mt-3 pt-3 border-t border-gray-700/50">
                                    <span class="inline-flex items-center gap-1.5 text-xs {{ $course->is_published ? 'text-green-400' : 'text-gray-400' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $course->is_published ? 'bg-green-400' : 'bg-gray-400' }}"></span>
                                        {{ $course->is_published ? 'Published' : 'Draft' }}
                                    </span>
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.courses.show', $course) }}" class="text-blue-400 hover:text-blue-300 text-xs">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.courses.edit', $course) }}" class="text-yellow-400 hover:text-yellow-300 text-xs">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button onclick="confirmDelete({{ $course->id }})" class="text-red-400 hover:text-red-300 text-xs">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <form id="delete-form-{{ $course->id }}" action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <div class="w-16 h-16 bg-gray-700/30 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-graduation-cap text-2xl text-gray-500"></i>
                            </div>
                            <p class="text-sm text-gray-500">No courses found</p>
                            <a href="{{ route('admin.courses.create') }}" class="text-sm text-blue-400 hover:text-blue-300 mt-2 inline-block">
                                <i class="fas fa-plus-circle mr-1"></i> Create your first course
                            </a>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="p-4 border-t border-gray-700/50">
                    {{ $courses->links() ?? '' }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this course? This action cannot be undone.')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
    @endpush
</x-app-layout>