<section>
    <div>
        <button type="button" class="px-6 py-2.5 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-lg font-medium transition shadow-lg shadow-red-600/20" onclick="document.getElementById('confirm-user-deletion').showModal()">
            <i class="fas fa-trash-alt mr-2"></i>
            {{ __('Delete Account') }}
        </button>
    </div>

    <!-- Delete User Confirmation Modal -->
    <dialog id="confirm-user-deletion" class="bg-gray-800 border border-gray-700 rounded-xl shadow-2xl backdrop:bg-black/50 max-w-md w-full">
        <div class="p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-lg bg-red-500/15 flex items-center justify-center text-red-400">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h2 class="text-xl font-bold text-white">{{ __('Delete Account') }}</h2>
            </div>

            <p class="text-sm text-gray-400 mb-6">
                {{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-4">
                @csrf
                @method('delete')

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-1">{{ __('Password') }}</label>
                    <input 
                        id="password" 
                        name="password" 
                        type="password" 
                        class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-red-500 focus:ring-2 focus:ring-red-500/20 focus:outline-none transition" 
                        placeholder="Enter your password to confirm"
                    />
                    @error('password')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" class="px-4 py-2 bg-gray-700/50 hover:bg-gray-700 text-gray-300 hover:text-white rounded-lg font-medium transition border border-gray-600" onclick="document.getElementById('confirm-user-deletion').close()">
                        {{ __('Cancel') }}
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-lg font-medium transition shadow-lg shadow-red-600/20">
                        <i class="fas fa-trash-alt mr-2"></i>
                        {{ __('Delete Account') }}
                    </button>
                </div>
            </form>
        </div>
    </dialog>

    <style>
        dialog::backdrop {
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
        }
        
        dialog {
            animation: modalIn 0.3s ease;
        }
        
        @keyframes modalIn {
            from {
                opacity: 0;
                transform: scale(0.95) translateY(10px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }
    </style>

    <script>
        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modal = document.getElementById('confirm-user-deletion');
                if (modal && modal.open) {
                    modal.close();
                }
            }
        });

        // Close modal on backdrop click
        document.getElementById('confirm-user-deletion')?.addEventListener('click', function(e) {
            if (e.target === this) {
                this.close();
            }
        });

        // Auto-close on successful submission
        document.querySelector('#confirm-user-deletion form')?.addEventListener('submit', function() {
            // Modal will close naturally on form submission
        });
    </script>
</section>