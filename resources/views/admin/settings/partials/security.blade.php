<div id="tab-security" class="tab-panel {{ $activeTab == 'security' ? '' : 'hidden' }}">
    <h3 class="text-lg font-semibold text-white mb-2">Security Settings</h3>
    <p class="text-gray-400 text-sm mb-6">Configure security settings to protect your platform.</p>
    
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <input type="hidden" name="tab" value="security">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Session Timeout (minutes)</label>
                <input type="number" name="session_timeout" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['session_timeout'] ?? '60' }}" min="15">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Admin IP Whitelist</label>
                <input type="text" name="admin_ip_whitelist" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['admin_ip_whitelist'] ?? '' }}" placeholder="192.168.1.1, 10.0.0.1">
                <p class="text-xs text-gray-500 mt-1">Comma-separated IPs. Leave empty to allow all.</p>
            </div>
            <div class="flex items-center gap-4 pt-6">
                <label class="text-sm font-medium text-gray-300">Two-Factor Authentication (2FA)</label>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="two_factor_auth" class="sr-only peer" {{ ($settings['two_factor_auth'] ?? false) ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-600 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                </label>
            </div>
            <div class="flex items-center gap-4 pt-6">
                <label class="text-sm font-medium text-gray-300">Force HTTPS</label>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="force_https" class="sr-only peer" {{ ($settings['force_https'] ?? true) ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-600 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                </label>
            </div>
            <div class="flex items-center gap-4 pt-6">
                <label class="text-sm font-medium text-gray-300">Rate Limiting</label>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="rate_limiting" class="sr-only peer" {{ ($settings['rate_limiting'] ?? true) ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-600 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                </label>
            </div>
            <div class="flex items-center gap-4 pt-6">
                <label class="text-sm font-medium text-gray-300">CORS Protection</label>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="cors_protection" class="sr-only peer" {{ ($settings['cors_protection'] ?? true) ? 'checked' : '' }}>
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