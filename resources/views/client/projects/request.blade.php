<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">Request New Project</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800/60 border border-gray-700/50 rounded-xl p-6">
                <form action="{{ route('client.projects.request.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm text-gray-300 mb-1">Project Title</label>
                        <input name="title" required value="{{ old('title') }}" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-300 mb-1">Description</label>
                        <textarea name="description" rows="5" required class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white resize-none">{{ old('description') }}</textarea>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-300 mb-1">Budget</label>
                            <input name="budget" type="number" step="0.01" min="0" value="{{ old('budget') }}" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-300 mb-1">Timeline</label>
                            <input name="timeline" value="{{ old('timeline') }}" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white">
                        </div>
                    </div>
                    <button class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">Submit Request</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
