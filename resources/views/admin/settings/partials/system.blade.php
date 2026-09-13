<div id="tab-system" class="tab-panel {{ $activeTab == 'system' ? '' : 'hidden' }}">
    <h3 class="text-lg font-semibold text-white mb-2">System Configuration</h3>
    <p class="text-gray-400 text-sm mb-6">Configure system-wide settings and preferences.</p>
    
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <input type="hidden" name="tab" value="system">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Application Environment</label>
                <select name="app_env" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition">
                    <option value="local" {{ ($settings['app_env'] ?? 'production') == 'local' ? 'selected' : '' }}>Local (Development)</option>
                    <option value="staging" {{ ($settings['app_env'] ?? '') == 'staging' ? 'selected' : '' }}>Staging</option>
                    <option value="production" {{ ($settings['app_env'] ?? 'production') == 'production' ? 'selected' : '' }}>Production</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">App Version</label>
                <input type="text" name="app_version" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['app_version'] ?? '1.0.0' }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Application URL</label>
                <input type="url" name="app_url" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['app_url'] ?? 'https://mgtechs.com.ng' }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Session Lifetime (minutes)</label>
                <input type="number" name="session_lifetime" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['session_lifetime'] ?? '120' }}" min="15">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Max Login Attempts</label>
                <input type="number" name="max_login_attempts" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['max_login_attempts'] ?? '5' }}" min="3">
            </div>
            <div class="flex items-center gap-4 pt-6">
                <label class="text-sm font-medium text-gray-300">Debug Mode</label>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="debug_mode" class="sr-only peer" {{ ($settings['debug_mode'] ?? false) ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-600 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                </label>
            </div>
        </div>
        
        <div class="mt-6 pt-6 border-t border-gray-700/50 flex gap-3">
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-lg font-medium transition shadow-lg shadow-blue-600/20">
                <i class="fas fa-save mr-2"></i> Save Settings
            </button>
        </div>
    </form>
</div>