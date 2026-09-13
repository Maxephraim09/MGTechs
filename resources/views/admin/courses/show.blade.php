<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Course Details') }}
            </h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.courses.edit', $course) }}" class="px-4 py-2 bg-yellow-600/20 hover:bg-yellow-600/30 text-yellow-400 rounded-lg text-sm font-medium transition border border-yellow-600/20">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <a href="{{ route('admin.courses.index') }}" class="text-gray-400 hover:text-white transition">
                    <i class="fas fa-arrow-left mr-2"></i> Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800/60 rounded-xl border border-gray-700/50 overflow-hidden">
                <!-- Course Header -->
                <div class="relative h-48 bg-gradient-to-r from-blue-600 to-purple-600">
                    <div class="absolute inset-0 bg-black/20"></div>
                    <div class="absolute bottom-4 left-6">
                        <h3 class="text-2xl font-bold text-white">{{ $course->title }}</h3>
                        <p class="text-white/80 text-sm">By {{ $course->instructor->name ?? 'N/A' }}</p>
                    </div>
                    <div class="absolute top-4 right-6 flex gap-2">
                        <span class="px-3 py-1 text-sm rounded-full font-medium
                            {{ $course->type === 'free' ? 'bg-green-500/20 text-green-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                            {{ ucfirst($course->type ?? 'free') }}
                        </span>
                        <span class="px-3 py-1 text-sm rounded-full font-medium
                            {{ $course->is_published ? 'bg-green-500/20 text-green-400' : 'bg-gray-500/20 text-gray-400' }}">
                            {{ $course->is_published ? 'Published' : 'Draft' }}
                        </span>
                    </div>
                </div>

                <!-- Course Info -->
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-sm font-semibold text-gray-400 mb-3">Course Information</h4>
                        <div class="space-y-3">
                            <div class="flex justify-between py-2 border-b border-gray-700/30">
                                <span class="text-xs text-gray-500">Description</span>
                                <span class="text-sm text-white text-right">{{ $course->description ?? 'No description' }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-700/30">
                                <span class="text-xs text-gray-500">Price</span>
                                <span class="text-sm text-white">{{ $course->type === 'free' ? 'Free' : '₦' . number_format($course->price ?? 0, 2) }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-700/30">
                                <span class="text-xs text-gray-500">Duration</span>
                                <span class="text-sm text-white">{{ $course->duration_days ?? 'N/A' }} days</span>
                            </div>
                            <div class="flex justify-between py-2">
                                <span class="text-xs text-gray-500">Category</span>
                                <span class="text-sm text-white">{{ $course->category->name ?? 'Uncategorized' }}</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-sm font-semibold text-gray-400 mb-3">Statistics</h4>
                        <div class="space-y-3">
                            <div class="flex justify-between py-2 border-b border-gray-700/30">
                                <span class="text-xs text-gray-500">Students Enrolled</span>
                                <span class="text-sm text-white">{{ $course->enrollments_count ?? 0 }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-700/30">
                                <span class="text-xs text-gray-500">Lessons</span>
                                <span class="text-sm text-white">{{ $course->lessons_count ?? 0 }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-700/30">
                                <span class="text-xs text-gray-500">Created</span>
                                <span class="text-sm text-white">{{ $course->created_at ? $course->created_at->format('M d, Y') : 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between py-2">
                                <span class="text-xs text-gray-500">Last Updated</span>
                                <span class="text-sm text-white">{{ $course->updated_at ? $course->updated_at->format('M d, Y') : 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lessons List -->
                <div class="p-6 border-t border-gray-700/50">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-sm font-semibold text-white">Lessons</h4>
                        <a href="#" class="text-sm text-blue-400 hover:text-blue-300">Add Lesson</a>
                    </div>
                    <div class="space-y-2">
                        @forelse($course->lessons ?? [] as $lesson)
                            <div class="flex items-center justify-between p-3 hover:bg-gray-700/20 rounded-lg transition">
                                <div class="flex items-center gap-3">
                                    <span class="text-sm text-gray-400">{{ $loop->iteration }}.</span>
                                    <span class="text-sm text-white">{{ $lesson->title }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs text-gray-500">{{ $lesson->duration_minutes ?? 0 }} min</span>
                                    <a href="#" class="text-blue-400 hover:text-blue-300 text-xs"><i class="fas fa-edit"></i></a>
                                    <button class="text-red-400 hover:text-red-300 text-xs"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-500 py-4">No lessons added yet</p>
                        @endforelse
                    </div>
                </div>

                <!-- Delete -->
                <div class="p-6 border-t border-gray-700/50 flex justify-end">
                    <button onclick="confirmDelete({{ $course->id }})" class="px-4 py-2 bg-red-600/20 hover:bg-red-600/30 text-red-400 rounded-lg text-sm font-medium transition border border-red-600/20">
                        <i class="fas fa-trash mr-2"></i> Delete Course
                    </button>
                    <form id="delete-form-{{ $course->id }}" action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
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