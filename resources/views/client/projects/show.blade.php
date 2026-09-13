<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-white leading-tight">{{ $project->title }}</h2>
                <p class="text-sm text-gray-400">Project Code: {{ $project->project_code ?? 'N/A' }}</p>
            </div>
            <a href="{{ route('client.projects.index') }}" class="text-gray-400 hover:text-white transition">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-gray-800/60 rounded-xl border border-gray-700/50 p-6">
                    <div class="flex items-center justify-between">
                        <span class="px-3 py-1 text-sm rounded-full {{ $project->status_badge }}">{{ $project->status_text }}</span>
                        <span class="text-sm text-gray-400">{{ $project->progress_percentage ?? 0 }}%</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-2 mt-3">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $project->progress_percentage ?? 0 }}%"></div>
                    </div>
                    <p class="text-gray-300 mt-5">{{ $project->description ?? 'No description' }}</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6 text-sm">
                        <div><p class="text-gray-500">Start Date</p><p class="text-white">{{ $project->start_date?->format('M d, Y') ?? 'N/A' }}</p></div>
                        <div><p class="text-gray-500">End Date</p><p class="text-white">{{ $project->end_date?->format('M d, Y') ?? $project->deadline?->format('M d, Y') ?? 'N/A' }}</p></div>
                        <div><p class="text-gray-500">Project URL</p><p class="text-white">@if($project->project_url)<a class="text-blue-400" href="{{ $project->project_url }}" target="_blank">{{ $project->project_url }}</a>@else N/A @endif</p></div>
                        <div><p class="text-gray-500">Client</p><p class="text-white">{{ $project->client_name ?? Auth::user()->name }}</p></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                        <div class="bg-gray-700/30 rounded-lg p-4"><p class="text-xs text-gray-500">Total</p><p class="text-white font-semibold">NGN {{ number_format($project->project_amount ?? 0, 2) }}</p></div>
                        <div class="bg-gray-700/30 rounded-lg p-4"><p class="text-xs text-gray-500">Paid</p><p class="text-green-400 font-semibold">NGN {{ number_format($project->amount_paid ?? 0, 2) }}</p></div>
                        <div class="bg-gray-700/30 rounded-lg p-4"><p class="text-xs text-gray-500">Balance</p><p class="text-yellow-400 font-semibold">NGN {{ number_format($project->balance ?? $project->balance_due, 2) }}</p></div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="bg-gray-800/60 rounded-xl border border-gray-700/50 p-4">
                        <h4 class="text-sm font-semibold text-white mb-3">Files</h4>
                        <div class="space-y-2">
                            @foreach($project->files as $file)
                                <a href="{{ route('client.projects.download', [$project, $file]) }}" class="block text-sm text-blue-400 hover:text-blue-300">
                                    <i class="fas fa-download mr-2"></i>{{ $file->filename }}
                                </a>
                            @endforeach
                            @if($project->agreement_file)
                                <a href="{{ asset('storage/'.$project->agreement_file) }}" class="block text-sm text-blue-400 hover:text-blue-300" target="_blank"><i class="fas fa-file-contract mr-2"></i>Agreement</a>
                            @endif
                            @if($project->proposal_file)
                                <a href="{{ asset('storage/'.$project->proposal_file) }}" class="block text-sm text-blue-400 hover:text-blue-300" target="_blank"><i class="fas fa-file-pdf mr-2"></i>Proposal</a>
                            @endif
                            @if($project->files->isEmpty() && ! $project->agreement_file && ! $project->proposal_file)
                                <p class="text-sm text-gray-500">No files uploaded yet.</p>
                            @endif
                        </div>
                    </div>

                    <div class="bg-gray-800/60 rounded-xl border border-gray-700/50 p-4">
                        <h4 class="text-sm font-semibold text-white mb-3">Upload File</h4>
                        <form action="{{ route('client.projects.upload', $project) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                            @csrf
                            <input type="file" name="file" required class="w-full text-sm text-gray-300">
                            <button class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm">Upload</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-gray-800/60 rounded-xl border border-gray-700/50 p-6">
                    <h4 class="text-sm font-semibold text-white mb-4">Send Feedback</h4>
                    <form action="{{ route('client.projects.feedback', $project) }}" method="POST" class="space-y-3">
                        @csrf
                        <textarea name="client_feedback" rows="4" required class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white resize-none" placeholder="Write your feedback..."></textarea>
                        <select name="rating" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white">
                            <option value="">Optional rating</option>
                            @for($i = 1; $i <= 5; $i++)<option value="{{ $i }}">{{ $i }} star{{ $i > 1 ? 's' : '' }}</option>@endfor
                        </select>
                        <button class="px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-lg">Send Feedback</button>
                    </form>
                </div>

                <div class="bg-gray-800/60 rounded-xl border border-gray-700/50 p-6">
                    <h4 class="text-sm font-semibold text-white mb-4">Project Updates</h4>
                    <div class="space-y-3 max-h-80 overflow-y-auto">
                        @forelse($updates as $update)
                            <div class="border border-gray-700/50 rounded-lg p-3">
                                <div class="flex justify-between gap-3">
                                    <p class="text-sm text-white">{{ $update->user->name ?? 'System' }}</p>
                                    <p class="text-xs text-gray-500">{{ $update->created_at->diffForHumans() }}</p>
                                </div>
                                <p class="text-sm text-gray-300 mt-2">{{ $update->admin_update ?? $update->client_feedback ?? $update->content }}</p>
                                @if($update->rating)<p class="text-xs text-yellow-400 mt-2">Rating: {{ $update->rating }}/5</p>@endif
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">No updates yet.</p>
                        @endforelse
                    </div>
                    <div class="mt-4">{{ $updates->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
