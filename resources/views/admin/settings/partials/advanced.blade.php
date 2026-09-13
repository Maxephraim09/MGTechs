<div id="tab-advanced" class="tab-panel {{ $activeTab == 'advanced' ? '' : 'hidden' }}">
    <h3 class="text-lg font-semibold text-white mb-2">Advanced Settings</h3>
    <p class="text-gray-400 text-sm mb-6">Advanced configuration options for developers.</p>
    
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <input type="hidden" name="tab" value="advanced">
        
        <div class="grid grid-cols-1 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Custom PHP ini Settings</label>
                <textarea name="php_ini" rows="4" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition resize-none" placeholder="memory_limit = 256M&#10;upload_max_filesize = 64M&#10;post_max_size = 64M&#10;max_execution_time = 300">{{ $settings['php_ini'] ?? "memory_limit = 256M\nupload_max_filesize = 64M\npost_max_size = 64M\nmax_execution_time = 300" }}</textarea>
                <p class="text-xs text-gray-500 mt-1">One setting per line. These will override default PHP settings.</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Custom Header Scripts</label>
                <textarea name="custom_header_scripts" rows="3" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition resize-none" placeholder="<!-- Custom scripts to add in head -->">{{ $settings['custom_header_scripts'] ?? '' }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Scripts added to the head section of every page.</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Custom Footer Scripts</label>
                <textarea name="custom_footer_scripts" rows="3" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition resize-none" placeholder="<!-- Custom scripts to add before closing body -->">{{ $settings['custom_footer_scripts'] ?? '' }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Scripts added before the closing body tag.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-center gap-4 pt-6">
                    <label class="text-sm font-medium text-gray-300">Enable API</label>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="enable_api" class="sr-only peer" {{ ($settings['enable_api'] ?? true) ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-600 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">API Rate Limit (per minute)</label>
                    <input type="number" name="api_rate_limit" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['api_rate_limit'] ?? '60' }}" min="1">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Cron Job Command</label>
                <input type="text" class="w-full bg-gray-700/30 border border-gray-600 rounded-lg px-4 py-2.5 text-gray-400 font-mono text-sm cursor-not-allowed" value="* * * * * php {{ base_path('artisan') }} schedule:run" disabled>
                <p class="text-xs text-gray-500 mt-1">Add this to your server's crontab.</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Queue Worker Command</label>
                <input type="text" class="w-full bg-gray-700/30 border border-gray-600 rounded-lg px-4 py-2.5 text-gray-400 font-mono text-sm cursor-not-allowed" value="php {{ base_path('artisan') }} queue:work --daemon" disabled>
            </div>
        </div>
        
        <div class="mt-6 pt-6 border-t border-gray-700/50 flex gap-3">
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-lg font-medium transition shadow-lg shadow-blue-600/20">
                <i class="fas fa-save mr-2"></i> Save Settings
            </button>
            <button type="button" class="px-6 py-2.5 bg-red-600/20 hover:bg-red-600/30 text-red-400 rounded-lg font-medium transition border border-red-600/20">
                <i class="fas fa-undo-alt mr-2"></i> Reset to Defaults
            </button>
        </div>
    </form>
</div>