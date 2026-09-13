<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Project Details') }}
            </h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.projects.edit', $project) }}" class="px-4 py-2 bg-yellow-600/20 hover:bg-yellow-600/30 text-yellow-400 rounded-lg text-sm font-medium transition border border-yellow-600/20">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <a href="{{ route('admin.projects.index') }}" class="text-gray-400 hover:text-white transition">
                    <i class="fas fa-arrow-left mr-2"></i> Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Project Header -->
            <div class="bg-gray-800/60 rounded-xl border border-gray-700/50 overflow-hidden">
                <div class="p-6 border-b border-gray-700/50">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xl font-bold text-white">{{ $project->title }}</h3>
                            <p class="text-sm text-gray-400 mt-1">Client: {{ $project->client->name ?? 'N/A' }}</p>
                            <div class="flex items-center gap-3 mt-2">
                                <span class="px-2 py-1 text-xs rounded-full font-medium
                                    {{ $project->status === 'completed' ? 'bg-green-500/20 text-green-400' : 
                                       ($project->status === 'in_progress' ? 'bg-blue-500/20 text-blue-400' : 
                                       ($project->status === 'review' ? 'bg-yellow-500/20 text-yellow-400' : 
                                       'bg-gray-500/20 text-gray-400')) }}">
                                    {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                </span>
                                <span class="text-xs text-gray-500">ID: #{{ $project->id }}</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-white">{{ $project->progress_percentage ?? 0 }}%</div>
                            <div class="text-xs text-gray-500">Progress</div>
                        </div>
                    </div>
                    <div class="mt-3 w-full bg-gray-700 rounded-full h-2">
                        <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-2 rounded-full" style="width: {{ $project->progress_percentage ?? 0 }}%"></div>
                    </div>
                </div>

                <!-- Project Info -->
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-sm font-semibold text-gray-400 mb-3">Project Information</h4>
                        <div class="space-y-3">
                            <div class="flex justify-between py-2 border-b border-gray-700/30">
                                <span class="text-xs text-gray-500">Description</span>
                                <span class="text-sm text-white text-right">{{ $project->description ?? 'No description' }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-700/30">
                                <span class="text-xs text-gray-500">Start Date</span>
                                <span class="text-sm text-white">{{ $project->start_date ? $project->start_date->format('M d, Y') : 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-700/30">
                                <span class="text-xs text-gray-500">Deadline</span>
                                <span class="text-sm text-white">{{ $project->deadline ? $project->deadline->format('M d, Y') : 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between py-2">
                                <span class="text-xs text-gray-500">Status</span>
                                <span class="text-sm text-white capitalize">{{ str_replace('_', ' ', $project->status) }}</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-sm font-semibold text-gray-400 mb-3">Timeline</h4>
                        <div class="space-y-3">
                            <div class="flex justify-between py-2 border-b border-gray-700/30">
                                <span class="text-xs text-gray-500">Created</span>
                                <span class="text-sm text-white">{{ $project->created_at ? $project->created_at->format('M d, Y H:i') : 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-700/30">
                                <span class="text-xs text-gray-500">Last Updated</span>
                                <span class="text-sm text-white">{{ $project->updated_at ? $project->updated_at->format('M d, Y H:i') : 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between py-2">
                                <span class="text-xs text-gray-500">Days Remaining</span>
                                <span class="text-sm {{ $project->deadline && $project->deadline->isPast() ? 'text-red-400' : 'text-green-400' }}">
                                    @if($project->deadline)
                                        {{ $project->deadline->diffInDays(now()) }} days
                                    @else
                                        N/A
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Updates / Timeline -->
            <div class="mt-6 bg-gray-800/60 rounded-xl border border-gray-700/50 overflow-hidden">
                <div class="p-4 border-b border-gray-700/50">
                    <h4 class="text-sm font-semibold text-white">Project Timeline</h4>
                </div>
                <div class="p-4 space-y-3 max-h-64 overflow-y-auto">
                    @forelse($project->updates ?? [] as $update)
                        <div class="flex items-start gap-3 p-3 hover:bg-gray-700/20 rounded-lg transition">
                            <div class="w-8 h-8 rounded-full bg-blue-500/15 flex items-center justify-center text-blue-400 text-xs flex-shrink-0">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">{{ $update->content }}</p>
                                <p class="text-xs text-gray-500">{{ $update->created_at->diffForHumans() }} by {{ $update->user->name ?? 'System' }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-8">No updates yet</p>
                    @endforelse
                </div>
            </div>

            <!-- Files -->
            <div class="mt-6 bg-gray-800/60 rounded-xl border border-gray-700/50 overflow-hidden">
                <div class="p-4 border-b border-gray-700/50">
                    <h4 class="text-sm font-semibold text-white">Project Files</h4>
                </div>
                <div class="p-4">
                    @if($project->files && $project->files->count() > 0)
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            @foreach($project->files as $file)
                                <div class="bg-gray-700/20 rounded-lg p-3 flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-blue-500/10 flex items-center justify-center text-blue-400">
                                        <i class="fas fa-file"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-white truncate">{{ $file->filename }}</p>
                                        <p class="text-xs text-gray-500">{{ number_format($file->size / 1024, 2) }} KB</p>
                                    </div>
                                    <a href="#" class="text-blue-400 hover:text-blue-300">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-gray-500 py-4">No files uploaded</p>
                    @endif
                </div>
            </div>

            <!-- Delete -->
            <div class="mt-6 flex justify-end">
                <button onclick="confirmDelete({{ $project->id }})" class="px-4 py-2 bg-red-600/20 hover:bg-red-600/30 text-red-400 rounded-lg text-sm font-medium transition border border-red-600/20">
                    <i class="fas fa-trash mr-2"></i> Delete Project
                </button>
                <form id="delete-form-{{ $project->id }}" action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this project? This action cannot be undone.')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
    @endpush
</x-app-layout>