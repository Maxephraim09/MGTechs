<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Edit Project') }}
            </h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.projects.show', $project) }}" class="text-blue-400 hover:text-blue-300 transition">
                    <i class="fas fa-eye mr-2"></i> View
                </a>
                <a href="{{ route('admin.projects.index') }}" class="text-gray-400 hover:text-white transition">
                    <i class="fas fa-arrow-left mr-2"></i> Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800/60 rounded-xl border border-gray-700/50 p-6">
                <div class="flex items-center gap-4 mb-6 pb-4 border-b border-gray-700/50">
                    <div class="w-12 h-12 rounded-lg bg-purple-500/15 flex items-center justify-center text-purple-400">
                        <i class="fas fa-project-diagram text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">{{ $project->title }}</h3>
                        <p class="text-sm text-gray-400">Project #{{ $project->id }} • {{ $project->client->name ?? 'No Client' }}</p>
                    </div>
                </div>

                <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Project Title <span class="text-red-400">*</span></label>
                            <input type="text" name="title" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ old('title', $project->title) }}" required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Client <span class="text-red-400">*</span></label>
                            <select name="client_id" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" required>
                                <option value="">Select Client</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id', $project->client_id) == $client->id ? 'selected' : '' }}>
                                        {{ $client->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('client_id')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Client Name</label>
                                <input type="text" name="client_name" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white" value="{{ old('client_name', $project->client_name) }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Client Email</label>
                                <input type="email" name="client_email" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white" value="{{ old('client_email', $project->client_email) }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Company</label>
                                <input type="text" name="client_company" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white" value="{{ old('client_company', $project->client_company) }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Phone</label>
                                <input type="text" name="client_phone" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white" value="{{ old('client_phone', $project->client_phone) }}">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Client Address</label>
                            <textarea name="client_address" rows="2" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white resize-none">{{ old('client_address', $project->client_address) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Description</label>
                            <textarea name="description" rows="4" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition resize-none">{{ old('description', $project->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Start Date</label>
                                <input type="date" name="start_date" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ old('start_date', $project->start_date ? $project->start_date->format('Y-m-d') : '') }}">
                                @error('start_date')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Deadline</label>
                                <input type="date" name="deadline" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ old('deadline', $project->deadline ? $project->deadline->format('Y-m-d') : '') }}">
                                @error('deadline')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Status</label>
                                <select name="status" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition">
                                    <option value="planning" {{ old('status', $project->status) == 'planning' ? 'selected' : '' }}>Planning</option>
                                    <option value="in_progress" {{ old('status', $project->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="review" {{ old('status', $project->status) == 'review' ? 'selected' : '' }}>Review</option>
                                    <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Progress (%)</label>
                                <input type="number" name="progress_percentage" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ old('progress_percentage', $project->progress_percentage ?? 0) }}" min="0" max="100">
                                @error('progress_percentage')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Project Amount</label>
                                <input type="number" step="0.01" name="project_amount" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white" value="{{ old('project_amount', $project->project_amount ?? 0) }}" min="0">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Amount Paid</label>
                                <input type="number" step="0.01" name="amount_paid" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white" value="{{ old('amount_paid', $project->amount_paid ?? 0) }}" min="0">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Project URL</label>
                                <input type="url" name="project_url" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white" value="{{ old('project_url', $project->project_url) }}">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Project Image</label>
                            <input type="file" name="image" accept="image/*" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-500/20 file:text-blue-400">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Agreement File</label>
                                <input type="file" name="agreement_file" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-500/20 file:text-blue-400">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Proposal File</label>
                                <input type="file" name="proposal_file" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-500/20 file:text-blue-400">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Additional Project Files</label>
                            <input type="file" name="files[]" multiple class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-500/20 file:text-blue-400 hover:file:bg-blue-500/30">
                            @if($project->files && $project->files->count() > 0)
                                <div class="mt-2 flex flex-wrap gap-2">
                                    @foreach($project->files as $file)
                                        <span class="text-xs bg-gray-700/30 px-2 py-1 rounded text-gray-400">
                                            <i class="fas fa-file mr-1"></i> {{ $file->filename }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="flex gap-3 pt-4 border-t border-gray-700/50">
                            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-lg font-medium transition shadow-lg shadow-blue-600/20">
                                <i class="fas fa-save mr-2"></i> Update Project
                            </button>
                            <a href="{{ route('admin.projects.index') }}" class="px-6 py-2.5 bg-gray-700/30 hover:bg-gray-700/50 text-gray-400 hover:text-white rounded-lg font-medium transition border border-gray-600">
                                Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
