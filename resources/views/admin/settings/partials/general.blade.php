<div id="tab-general" class="tab-panel {{ $activeTab == 'general' ? '' : 'hidden' }}">
    <h3 class="text-lg font-semibold text-white mb-2">General Settings</h3>
    <p class="text-gray-400 text-sm mb-6">Configure basic site information and preferences.</p>
    
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <input type="hidden" name="tab" value="general">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Site Name</label>
                <input type="text" name="site_name" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['site_name'] ?? 'MGTECHS Limited' }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Tagline</label>
                <input type="text" name="tagline" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['tagline'] ?? "Nigeria's Trusted Technology Partner" }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Timezone</label>
                <select name="timezone" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition">
                    <option value="Africa/Lagos" {{ ($settings['timezone'] ?? 'Africa/Lagos') == 'Africa/Lagos' ? 'selected' : '' }}>Africa/Lagos (UTC+1)</option>
                    <option value="Africa/Cairo" {{ ($settings['timezone'] ?? '') == 'Africa/Cairo' ? 'selected' : '' }}>Africa/Cairo (UTC+2)</option>
                    <option value="UTC" {{ ($settings['timezone'] ?? '') == 'UTC' ? 'selected' : '' }}>UTC</option>
                    <option value="America/New_York" {{ ($settings['timezone'] ?? '') == 'America/New_York' ? 'selected' : '' }}>America/New_York (UTC-5)</option>
                    <option value="Europe/London" {{ ($settings['timezone'] ?? '') == 'Europe/London' ? 'selected' : '' }}>Europe/London (UTC+0)</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Language</label>
                <select name="language" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition">
                    <option value="en" {{ ($settings['language'] ?? 'en') == 'en' ? 'selected' : '' }}>English</option>
                    <option value="ha" {{ ($settings['language'] ?? '') == 'ha' ? 'selected' : '' }}>Hausa</option>
                    <option value="yo" {{ ($settings['language'] ?? '') == 'yo' ? 'selected' : '' }}>Yoruba</option>
                    <option value="ig" {{ ($settings['language'] ?? '') == 'ig' ? 'selected' : '' }}>Igbo</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Date Format</label>
                <input type="text" name="date_format" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['date_format'] ?? 'Y-m-d' }}" placeholder="Y-m-d">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Time Format</label>
                <input type="text" name="time_format" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['time_format'] ?? 'H:i' }}" placeholder="H:i">
            </div>
        </div>
        
        <div class="mt-6 pt-6 border-t border-gray-700/50 flex gap-3">
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-lg font-medium transition shadow-lg shadow-blue-600/20">
                <i class="fas fa-save mr-2"></i> Save Settings
            </button>
        </div>
    </form>
</div>