<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">My Projects</h2>
            <a href="{{ route('client.projects.request') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition">
                <i class="fas fa-plus-circle mr-2"></i> Request Project
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach(['total' => 'Total Projects', 'active' => 'Active Projects', 'completed' => 'Completed Projects'] as $key => $label)
                    <div class="bg-gray-800/60 border border-gray-700/50 rounded-xl p-5">
                        <p class="text-sm text-gray-400">{{ $label }}</p>
                        <p class="text-2xl font-bold text-white mt-1">{{ $stats[$key] ?? 0 }}</p>
                    </div>
                @endforeach
            </div>

            <div class="bg-gray-800/60 border border-gray-700/50 rounded-xl overflow-hidden">
                <div class="p-4 border-b border-gray-700/50">
                    <h3 class="text-sm font-semibold text-white">Project Tracker</h3>
                </div>
                <div class="divide-y divide-gray-700/50">
                    @forelse($projects as $project)
                        <a href="{{ route('client.projects.show', $project) }}" class="block p-4 hover:bg-gray-700/20 transition">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-semibold text-white">{{ $project->title }}</h4>
                                        <span class="px-2 py-1 text-xs rounded-full {{ $project->status_badge }}">{{ $project->status_text }}</span>
                                    </div>
                                    <p class="text-sm text-gray-400 mt-1">{{ $project->project_code ?? 'No code' }}</p>
                                    <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ $project->description ?? 'No description' }}</p>
                                </div>
                                <div class="w-full md:w-48">
                                    <div class="flex justify-between text-xs text-gray-400 mb-1">
                                        <span>Progress</span>
                                        <span>{{ $project->progress_percentage ?? 0 }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-700 rounded-full h-2">
                                        <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $project->progress_percentage ?? 0 }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <p class="text-center text-gray-500 py-10">You do not have any projects yet.</p>
                    @endforelse
                </div>
                <div class="p-4 border-t border-gray-700/50">{{ $projects->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
