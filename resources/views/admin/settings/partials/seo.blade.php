<div id="tab-seo" class="tab-panel {{ $activeTab == 'seo' ? '' : 'hidden' }}">
    <h3 class="text-lg font-semibold text-white mb-2">SEO Settings</h3>
    <p class="text-gray-400 text-sm mb-6">Configure SEO settings for better search engine visibility.</p>
    
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <input type="hidden" name="tab" value="seo">
        
        <div class="grid grid-cols-1 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Default Meta Title</label>
                <input type="text" name="meta_title" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['meta_title'] ?? 'MGTECHS Limited - Web Development & Digital Solutions' }}">
                <p class="text-xs text-gray-500 mt-1">Recommended: 50-60 characters</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Default Meta Description</label>
                <textarea name="meta_description" rows="3" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition resize-none">{{ $settings['meta_description'] ?? 'MGTECHS Limited is a registered Nigerian technology company specializing in Web Development, Software, Graphics, Printing, Branding, and IT Consultation.' }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Recommended: 150-160 characters</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Meta Keywords</label>
                <input type="text" name="meta_keywords" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['meta_keywords'] ?? 'MGTECHS, web development Nigeria, software development, graphics design, printing services, branding, IT consultation, LMS, CBT, e-learning Nigeria' }}">
                <p class="text-xs text-gray-500 mt-1">Comma-separated keywords</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Google Analytics ID</label>
                    <input type="text" name="ga_id" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['ga_id'] ?? '' }}" placeholder="G-XXXXXXXXXX">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Google Tag Manager ID</label>
                    <input type="text" name="gtm_id" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['gtm_id'] ?? '' }}" placeholder="GTM-XXXXXXX">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Custom SEO Meta Tags</label>
                <textarea name="custom_meta" rows="3" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition resize-none" placeholder="&lt;meta name='robots' content='index,follow'&gt;">{{ $settings['custom_meta'] ?? '' }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Additional meta tags to include in the head section.</p>
            </div>
        </div>
        
        <div class="mt-6 pt-6 border-t border-gray-700/50 flex gap-3">
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-lg font-medium transition shadow-lg shadow-blue-600/20">
                <i class="fas fa-save mr-2"></i> Save Settings
            </button>
        </div>
    </form>
</div>