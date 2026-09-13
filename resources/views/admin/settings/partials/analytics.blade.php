<div id="tab-analytics" class="tab-panel {{ $activeTab == 'analytics' ? '' : 'hidden' }}">
    <h3 class="text-lg font-semibold text-white mb-2">Analytics & Tracking</h3>
    <p class="text-gray-400 text-sm mb-6">Configure analytics and tracking services.</p>
    
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <input type="hidden" name="tab" value="analytics">
        
        <div class="grid grid-cols-1 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Google Analytics 4 Measurement ID</label>
                <input type="text" name="ga4_id" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['ga4_id'] ?? '' }}" placeholder="G-XXXXXXXXXX">
                <p class="text-xs text-gray-500 mt-1">Format: G-XXXXXXXXXX</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Google Tag Manager ID</label>
                <input type="text" name="gtm_id_analytics" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['gtm_id_analytics'] ?? '' }}" placeholder="GTM-XXXXXXX">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Facebook Pixel ID</label>
                <input type="text" name="fb_pixel" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['fb_pixel'] ?? '' }}" placeholder="123456789012345">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">LinkedIn Insight Tag</label>
                <input type="text" name="linkedin_insight" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['linkedin_insight'] ?? '' }}" placeholder="1234567">
            </div>
            <div class="flex items-center gap-4 pt-6">
                <label class="text-sm font-medium text-gray-300">Enable Cookie Consent</label>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="cookie_consent" class="sr-only peer" {{ ($settings['cookie_consent'] ?? true) ? 'checked' : '' }}>
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