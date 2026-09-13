<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('My Dashboard') }}
            </h2>
            <span class="px-3 py-1 text-sm bg-blue-500/10 text-blue-400 rounded-full border border-blue-500/20">
                <i class="fas fa-user mr-1"></i> {{ Auth::user()->name }}
            </span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl p-8 mb-6 text-white">
                <h1 class="text-2xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h1>
                <p class="text-blue-100">Track your projects, communicate with our team, and manage your files.</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Total Projects</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['total'] ?? 0 }}</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-500/10 rounded-xl flex items-center justify-center text-blue-500">
                                <i class="fas fa-project-diagram text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Active Projects</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $activeProjects ?? 0 }}</p>
                            </div>
                            <div class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center text-green-500">
                                <i class="fas fa-play-circle text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Completed</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $completedProjects ?? 0 }}</p>
                            </div>
                            <div class="w-12 h-12 bg-purple-500/10 rounded-xl flex items-center justify-center text-purple-500">
                                <i class="fas fa-check-circle text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Files</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalFiles ?? ($stats['files'] ?? 0) }}</p>
                            </div>
                            <div class="w-12 h-12 bg-yellow-500/10 rounded-xl flex items-center justify-center text-yellow-500">
                                <i class="fas fa-file text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Projects List -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-semibold text-gray-900 dark:text-white">My Projects</h3>
                    <a href="{{ route('client.projects.index') }}" class="text-sm text-blue-400 hover:text-blue-300">View All</a>
                </div>
                
                <div class="space-y-4">
                    @forelse($projects ?? [] as $project)
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-medium text-gray-900 dark:text-white">{{ $project->title ?? 'Project' }}</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $project->description ?? 'No description' }}</p>
                                    <div class="flex items-center gap-3 mt-2 text-xs">
                                        <span class="px-2 py-1 rounded-full {{ $project->status === 'completed' ? 'bg-green-500/10 text-green-400' : ($project->status === 'in_progress' ? 'bg-blue-500/10 text-blue-400' : 'bg-yellow-500/10 text-yellow-400') }}">
                                            {{ ucfirst(str_replace('_', ' ', $project->status ?? 'planning')) }}
                                        </span>
                                        <span class="text-gray-400">Updated {{ $project->updated_at->diffForHumans() ?? 'recently' }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-24">
                                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $project->progress_percentage ?? 0 }}%"></div>
                                        </div>
                                        <span class="text-xs text-gray-500">{{ $project->progress_percentage ?? 0 }}%</span>
                                    </div>
                                    <a href="{{ route('client.projects.show', $project) }}" class="text-blue-400 hover:text-blue-300 text-sm">View</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 dark:text-gray-400 py-8">No projects assigned yet.</p>
                    @endforelse
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
                <a href="{{ route('client.projects.request') }}" class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-200 dark:border-gray-700 text-center hover:border-blue-500 transition">
                    <i class="fas fa-upload text-blue-400 text-xl mb-2 block"></i>
                    <span class="text-sm text-gray-700 dark:text-gray-300">Request Project</span>
                </a>
                <a href="{{ route('client.feedback.index') }}" class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-200 dark:border-gray-700 text-center hover:border-blue-500 transition">
                    <i class="fas fa-comment text-green-400 text-xl mb-2 block"></i>
                    <span class="text-sm text-gray-700 dark:text-gray-300">Feedback</span>
                </a>
                <a href="{{ route('client.projects.index') }}" class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-200 dark:border-gray-700 text-center hover:border-blue-500 transition">
                    <i class="fas fa-file-invoice text-purple-400 text-xl mb-2 block"></i>
                    <span class="text-sm text-gray-700 dark:text-gray-300">Project Files</span>
                </a>
                <a href="{{ route('profile.edit') }}" class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-200 dark:border-gray-700 text-center hover:border-blue-500 transition">
                    <i class="fas fa-user-edit text-yellow-400 text-xl mb-2 block"></i>
                    <span class="text-sm text-gray-700 dark:text-gray-300">Profile</span>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
