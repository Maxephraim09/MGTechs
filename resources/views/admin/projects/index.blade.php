<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('All Projects') }}
            </h2>
            <a href="{{ route('admin.projects.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition shadow-lg shadow-blue-600/20">
                <i class="fas fa-plus-circle mr-2"></i> New Project
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
                            <input type="text" placeholder="Search projects..." class="pl-9 pr-4 py-2 bg-gray-700/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition w-56 md:w-64">
                        </div>
                        <select class="px-4 py-2 bg-gray-700/50 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition">
                            <option value="">All Status</option>
                            <option value="planning">Planning</option>
                            <option value="in_progress">In Progress</option>
                            <option value="review">Review</option>
                            <option value="completed">Completed</option>
                        </select>
                        <select class="px-4 py-2 bg-gray-700/50 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition">
                            <option value="">All Clients</option>
                            @foreach($clients ?? [] as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-400">{{ $projects->total() ?? 0 }} projects</span>
                    </div>
                </div>

                <!-- Projects Grid -->
                <div class="p-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($projects ?? [] as $project)
                        <div class="bg-gray-700/20 rounded-xl border border-gray-700/50 overflow-hidden hover:border-blue-500/30 transition group">
                            <div class="p-4">
                                <div class="flex justify-between items-start">
                                    <h3 class="text-sm font-semibold text-white group-hover:text-blue-400 transition">
                                        <a href="{{ route('admin.projects.show', $project) }}">{{ $project->title }}</a>
                                    </h3>
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        {{ $project->status === 'completed' ? 'bg-green-500/20 text-green-400' : 
                                           ($project->status === 'in_progress' ? 'bg-blue-500/20 text-blue-400' : 
                                           ($project->status === 'review' ? 'bg-yellow-500/20 text-yellow-400' : 
                                           'bg-gray-500/20 text-gray-400')) }}">
                                        {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                    </span>
                                </div>
                                <p class="text-xs text-gray-400 mt-1">{{ $project->client->name ?? 'No Client' }}</p>
                                <p class="text-xs text-gray-500 mt-2 line-clamp-2">{{ $project->description ?? 'No description' }}</p>
                                <div class="mt-3">
                                    <div class="flex justify-between text-xs text-gray-500">
                                        <span>Progress</span>
                                        <span>{{ $project->progress_percentage ?? 0 }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-700 rounded-full h-1.5 mt-1">
                                        <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-1.5 rounded-full" style="width: {{ $project->progress_percentage ?? 0 }}%"></div>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center mt-3 pt-3 border-t border-gray-700/50">
                                    <div class="flex items-center gap-2 text-xs text-gray-500">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span>{{ $project->deadline ? $project->deadline->format('M d') : 'No deadline' }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.projects.show', $project) }}" class="text-blue-400 hover:text-blue-300 text-xs">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.projects.edit', $project) }}" class="text-yellow-400 hover:text-yellow-300 text-xs">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button onclick="confirmDelete({{ $project->id }})" class="text-red-400 hover:text-red-300 text-xs">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <form id="delete-form-{{ $project->id }}" action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="hidden">
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
                                <i class="fas fa-project-diagram text-2xl text-gray-500"></i>
                            </div>
                            <p class="text-sm text-gray-500">No projects found</p>
                            <a href="{{ route('admin.projects.create') }}" class="text-sm text-blue-400 hover:text-blue-300 mt-2 inline-block">
                                <i class="fas fa-plus-circle mr-1"></i> Create your first project
                            </a>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="p-4 border-t border-gray-700/50">
                    {{ $projects->links() ?? '' }}
                </div>
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