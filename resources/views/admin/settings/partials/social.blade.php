<div id="tab-social" class="tab-panel {{ $activeTab == 'social' ? '' : 'hidden' }}">
    <h3 class="text-lg font-semibold text-white mb-2">Social Media Integration</h3>
    <p class="text-gray-400 text-sm mb-6">Configure social media links and integrations.</p>
    
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <input type="hidden" name="tab" value="social">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1"><i class="fab fa-facebook mr-2 text-blue-400"></i> Facebook URL</label>
                <input type="url" name="facebook_url" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['facebook_url'] ?? '' }}" placeholder="https://facebook.com/mgtechs">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1"><i class="fab fa-twitter mr-2 text-blue-400"></i> Twitter URL</label>
                <input type="url" name="twitter_url" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['twitter_url'] ?? '' }}" placeholder="https://twitter.com/mgtechs">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1"><i class="fab fa-instagram mr-2 text-pink-400"></i> Instagram URL</label>
                <input type="url" name="instagram_url" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['instagram_url'] ?? '' }}" placeholder="https://instagram.com/mgtechs">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1"><i class="fab fa-linkedin mr-2 text-blue-400"></i> LinkedIn URL</label>
                <input type="url" name="linkedin_url" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['linkedin_url'] ?? '' }}" placeholder="https://linkedin.com/company/mgtechs">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1"><i class="fab fa-youtube mr-2 text-red-400"></i> YouTube URL</label>
                <input type="url" name="youtube_url" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['youtube_url'] ?? '' }}" placeholder="https://youtube.com/@mgtechs">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1"><i class="fab fa-github mr-2 text-gray-400"></i> GitHub URL</label>
                <input type="url" name="github_url" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['github_url'] ?? '' }}" placeholder="https://github.com/mgtechs">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1"><i class="fab fa-discord mr-2 text-indigo-400"></i> Discord URL</label>
                <input type="url" name="discord_url" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['discord_url'] ?? '' }}" placeholder="https://discord.gg/mgtechs">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1"><i class="fab fa-whatsapp mr-2 text-green-400"></i> WhatsApp URL</label>
                <input type="url" name="whatsapp_url" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['whatsapp_url'] ?? '' }}" placeholder="https://wa.me/2348161595906">
            </div>
        </div>
        
        <div class="mt-6 pt-6 border-t border-gray-700/50 flex gap-3">
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-lg font-medium transition shadow-lg shadow-blue-600/20">
                <i class="fas fa-save mr-2"></i> Save Settings
            </button>
        </div>
    </form>
</div>