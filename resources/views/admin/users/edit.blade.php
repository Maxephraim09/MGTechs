<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Edit User') }}
            </h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.users.show', $user) }}" class="text-blue-400 hover:text-blue-300 transition">
                    <i class="fas fa-eye mr-2"></i> View
                </a>
                <a href="{{ route('admin.users.index') }}" class="text-gray-400 hover:text-white transition">
                    <i class="fas fa-arrow-left mr-2"></i> Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800/60 rounded-xl border border-gray-700/50 p-6">
                <!-- User Header -->
                <div class="flex items-center gap-4 mb-6 pb-4 border-b border-gray-700/50">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center text-2xl font-bold text-white">
                        {{ substr($user->name ?? 'U', 0, 2) }}
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">{{ $user->name }}</h3>
                        <p class="text-sm text-gray-400">{{ $user->email }}</p>
                        <span class="inline-flex items-center gap-1.5 text-xs {{ $user->is_active ? 'text-green-400' : 'text-red-400' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $user->is_active ? 'bg-green-400' : 'bg-red-400' }}"></span>
                            {{ $user->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>

                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Full Name <span class="text-red-400">*</span></label>
                            <input type="text" name="name" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Email Address <span class="text-red-400">*</span></label>
                            <input type="email" name="email" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Phone Number</label>
                            <input type="text" name="phone" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">New Password</label>
                                <input type="password" name="password" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" placeholder="Leave blank to keep current">
                                <p class="text-xs text-gray-500 mt-1">Leave blank to keep current password</p>
                                @error('password')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" placeholder="Confirm new password">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Role <span class="text-red-400">*</span></label>
                                <select name="role" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" required>
                                    <option value="student" {{ old('role', $user->role) == 'student' ? 'selected' : '' }}>Student</option>
                                    <option value="client" {{ old('role', $user->role) == 'client' ? 'selected' : '' }}>Client</option>
                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                @error('role')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex items-center gap-3 pt-6">
                                <input type="checkbox" name="is_active" id="is_active" class="w-4 h-4 accent-blue-600 rounded" {{ old('is_active', $user->is_active) ? 'checked' : '' }}>
                                <label for="is_active" class="text-sm text-gray-300">Active</label>
                            </div>
                        </div>

                        <div class="flex gap-3 pt-4 border-t border-gray-700/50">
                            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-lg font-medium transition shadow-lg shadow-blue-600/20">
                                <i class="fas fa-save mr-2"></i> Update User
                            </button>
                            <a href="{{ route('admin.users.index') }}" class="px-6 py-2.5 bg-gray-700/30 hover:bg-gray-700/50 text-gray-400 hover:text-white rounded-lg font-medium transition border border-gray-600">
                                Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>