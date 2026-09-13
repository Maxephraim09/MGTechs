<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('User Details') }}
            </h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.users.edit', $user) }}" class="px-4 py-2 bg-yellow-600/20 hover:bg-yellow-600/30 text-yellow-400 rounded-lg text-sm font-medium transition border border-yellow-600/20">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <a href="{{ route('admin.users.index') }}" class="text-gray-400 hover:text-white transition">
                    <i class="fas fa-arrow-left mr-2"></i> Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800/60 rounded-xl border border-gray-700/50 overflow-hidden">
                <!-- User Header -->
                <div class="p-6 border-b border-gray-700/50 flex items-center gap-6">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center text-3xl font-bold text-white">
                        {{ substr($user->name ?? 'U', 0, 2) }}
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">{{ $user->name }}</h3>
                        <p class="text-sm text-gray-400">{{ $user->email }}</p>
                        <div class="flex items-center gap-3 mt-1">
                            <span class="px-2 py-1 text-xs rounded-full font-medium
                                {{ $user->role === 'admin' ? 'bg-purple-500/20 text-purple-400 border border-purple-500/20' : 
                                   ($user->role === 'client' ? 'bg-blue-500/20 text-blue-400 border border-blue-500/20' : 
                                   'bg-green-500/20 text-green-400 border border-green-500/20') }}">
                                {{ ucfirst($user->role ?? 'user') }}
                            </span>
                            <span class="inline-flex items-center gap-1.5 text-xs {{ $user->is_active ? 'text-green-400' : 'text-red-400' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $user->is_active ? 'bg-green-400' : 'bg-red-400' }}"></span>
                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                            </span>
                            <span class="text-xs text-gray-500">ID: #{{ $user->id }}</span>
                        </div>
                    </div>
                </div>

                <!-- User Info -->
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-sm font-semibold text-gray-400 mb-3">Personal Information</h4>
                        <div class="space-y-3">
                            <div class="flex justify-between py-2 border-b border-gray-700/30">
                                <span class="text-xs text-gray-500">Full Name</span>
                                <span class="text-sm text-white">{{ $user->name }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-700/30">
                                <span class="text-xs text-gray-500">Email Address</span>
                                <span class="text-sm text-white">{{ $user->email }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-700/30">
                                <span class="text-xs text-gray-500">Phone Number</span>
                                <span class="text-sm text-white">{{ $user->phone ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-700/30">
                                <span class="text-xs text-gray-500">Role</span>
                                <span class="text-sm text-white capitalize">{{ $user->role ?? 'User' }}</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-sm font-semibold text-gray-400 mb-3">Account Information</h4>
                        <div class="space-y-3">
                            <div class="flex justify-between py-2 border-b border-gray-700/30">
                                <span class="text-xs text-gray-500">Status</span>
                                <span class="text-sm {{ $user->is_active ? 'text-green-400' : 'text-red-400' }}">
                                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-700/30">
                                <span class="text-xs text-gray-500">Email Verified</span>
                                <span class="text-sm {{ $user->email_verified_at ? 'text-green-400' : 'text-yellow-400' }}">
                                    {{ $user->email_verified_at ? 'Verified' : 'Pending' }}
                                </span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-700/30">
                                <span class="text-xs text-gray-500">Joined</span>
                                <span class="text-sm text-white">{{ $user->created_at ? $user->created_at->format('M d, Y H:i') : 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between py-2">
                                <span class="text-xs text-gray-500">Last Updated</span>
                                <span class="text-sm text-white">{{ $user->updated_at ? $user->updated_at->format('M d, Y H:i') : 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Stats -->
                <div class="p-6 border-t border-gray-700/50 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-gray-700/20 rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-blue-400">{{ $user->projects_count ?? 0 }}</div>
                        <div class="text-xs text-gray-500">Projects</div>
                    </div>
                    <div class="bg-gray-700/20 rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-green-400">{{ $user->enrollments_count ?? 0 }}</div>
                        <div class="text-xs text-gray-500">Enrollments</div>
                    </div>
                    <div class="bg-gray-700/20 rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-purple-400">{{ $user->certificates_count ?? 0 }}</div>
                        <div class="text-xs text-gray-500">Certificates</div>
                    </div>
                </div>

                <!-- Delete Button -->
                <div class="p-6 border-t border-gray-700/50 flex justify-end">
                    <button onclick="confirmDelete({{ $user->id }})" class="px-4 py-2 bg-red-600/20 hover:bg-red-600/30 text-red-400 rounded-lg text-sm font-medium transition border border-red-600/20">
                        <i class="fas fa-trash mr-2"></i> Delete User
                    </button>
                    <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user) }}" method="POST" class="hidden">
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
            if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
    @endpush
</x-app-layout>
