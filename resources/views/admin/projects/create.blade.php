<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Create New Project') }}
            </h2>
            <a href="{{ route('admin.projects.index') }}" class="text-gray-400 hover:text-white transition">
                <i class="fas fa-arrow-left mr-2"></i> Back to Projects
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800/60 rounded-xl border border-gray-700/50 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-purple-500/15 flex items-center justify-center text-purple-400">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">New Project</h3>
                        <p class="text-sm text-gray-400">Fill in the details below to create a new project.</p>
                    </div>
                </div>

                <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Project Title <span class="text-red-400">*</span></label>
                            <input type="text" name="title" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ old('title') }}" required placeholder="e.g., Website Redesign">
                            @error('title')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Client <span class="text-red-400">*</span></label>
                            <select name="client_id" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" required>
                                <option value="">Select Client</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
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
                                <input type="text" name="client_name" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white" value="{{ old('client_name') }}" placeholder="Defaults to selected user">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Client Email</label>
                                <input type="email" name="client_email" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white" value="{{ old('client_email') }}" placeholder="Defaults to selected user">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Company</label>
                                <input type="text" name="client_company" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white" value="{{ old('client_company') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Phone</label>
                                <input type="text" name="client_phone" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white" value="{{ old('client_phone') }}">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Client Address</label>
                            <textarea name="client_address" rows="2" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white resize-none">{{ old('client_address') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Description</label>
                            <textarea name="description" rows="4" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition resize-none" placeholder="Describe the project...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Start Date</label>
                                <input type="date" name="start_date" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ old('start_date') }}">
                                @error('start_date')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Deadline</label>
                                <input type="date" name="deadline" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ old('deadline') }}">
                                @error('deadline')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Status</label>
                                <select name="status" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition">
                                    <option value="planning" {{ old('status') == 'planning' ? 'selected' : '' }}>Planning</option>
                                    <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="review" {{ old('status') == 'review' ? 'selected' : '' }}>Review</option>
                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Progress (%)</label>
                                <input type="number" name="progress_percentage" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ old('progress_percentage', 0) }}" min="0" max="100">
                                @error('progress_percentage')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Project Amount</label>
                                <input type="number" step="0.01" name="project_amount" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white" value="{{ old('project_amount', 0) }}" min="0">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Amount Paid</label>
                                <input type="number" step="0.01" name="amount_paid" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white" value="{{ old('amount_paid', 0) }}" min="0">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Project URL</label>
                                <input type="url" name="project_url" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white" value="{{ old('project_url') }}" placeholder="https://example.com">
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
                            <p class="text-xs text-gray-500 mt-1">Upload project-related files (max 10MB each)</p>
                        </div>

                        <div class="flex gap-3 pt-4 border-t border-gray-700/50">
                            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-lg font-medium transition shadow-lg shadow-blue-600/20">
                                <i class="fas fa-save mr-2"></i> Create Project
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
