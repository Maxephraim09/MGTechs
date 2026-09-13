<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Profile Settings') }}
            </h2>
            <div class="flex items-center gap-3">
                <span class="px-3 py-1 text-xs bg-blue-500/20 text-blue-400 rounded-full border border-blue-500/20">
                    <i class="fas fa-user-circle mr-1"></i>
                    {{ Auth::user()->role ?? 'User' }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- ===== PROFILE HEADER ===== -->
            <div class="bg-gray-800/60 rounded-xl overflow-hidden border border-gray-700/50">
                <div class="p-6 flex items-center gap-6">
                    <div class="relative">
                        <div class="w-20 h-20 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center text-2xl font-bold text-white">
                            {{ substr(Auth::user()->name ?? 'U', 0, 2) }}
                        </div>
                        <button class="absolute bottom-0 right-0 w-7 h-7 bg-gray-700 rounded-full flex items-center justify-center text-xs text-gray-400 hover:text-white hover:bg-gray-600 transition border border-gray-600">
                            <i class="fas fa-camera"></i>
                        </button>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">{{ Auth::user()->name ?? 'User' }}</h3>
                        <p class="text-sm text-gray-400">{{ Auth::user()->email ?? '' }}</p>
                        <p class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-circle text-green-500 text-[6px] mr-1"></i>
                            Active
                        </p>
                    </div>
                </div>
            </div>

            <!-- ===== UPDATE PROFILE INFORMATION ===== -->
            <div class="bg-gray-800/60 rounded-xl overflow-hidden border border-gray-700/50">
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-8 h-8 rounded-lg bg-blue-500/15 flex items-center justify-center text-blue-400">
                            <i class="fas fa-user-edit text-sm"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-white">{{ __('Profile Information') }}</h3>
                    </div>
                    <p class="text-sm text-gray-400 mb-6">Update your account's profile information and email address.</p>
                    
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- ===== UPDATE PASSWORD ===== -->
            <div class="bg-gray-800/60 rounded-xl overflow-hidden border border-gray-700/50">
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-8 h-8 rounded-lg bg-purple-500/15 flex items-center justify-center text-purple-400">
                            <i class="fas fa-lock text-sm"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-white">{{ __('Update Password') }}</h3>
                    </div>
                    <p class="text-sm text-gray-400 mb-6">Ensure your account is using a long, random password to stay secure.</p>
                    
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- ===== DELETE ACCOUNT ===== -->
            <div class="bg-gray-800/60 rounded-xl overflow-hidden border border-red-500/20">
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-8 h-8 rounded-lg bg-red-500/15 flex items-center justify-center text-red-400">
                            <i class="fas fa-trash-alt text-sm"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-red-400">{{ __('Delete Account') }}</h3>
                    </div>
                    <p class="text-sm text-gray-400 mb-6">Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
                    
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>