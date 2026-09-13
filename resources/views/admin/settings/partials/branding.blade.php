<div id="tab-branding" class="tab-panel {{ $activeTab == 'branding' ? '' : 'hidden' }}">
    <h3 class="text-lg font-semibold text-white mb-2">Branding & Design</h3>
    <p class="text-gray-400 text-sm mb-6">Customize your brand appearance across the platform.</p>
    
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="tab" value="branding">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Primary Color</label>
                <div class="flex items-center gap-3">
                    <input type="color" name="primary_color" class="w-12 h-12 rounded-lg border border-gray-600 bg-transparent cursor-pointer" value="{{ $settings['primary_color'] ?? '#4F46E5' }}">
                    <input type="text" name="primary_color" class="flex-1 bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['primary_color'] ?? '#4F46E5' }}">
                </div>
                <p class="text-xs text-gray-500 mt-1">Main brand color used throughout the site.</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Secondary Color</label>
                <div class="flex items-center gap-3">
                    <input type="color" name="secondary_color" class="w-12 h-12 rounded-lg border border-gray-600 bg-transparent cursor-pointer" value="{{ $settings['secondary_color'] ?? '#7C3AED' }}">
                    <input type="text" name="secondary_color" class="flex-1 bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['secondary_color'] ?? '#7C3AED' }}">
                </div>
                <p class="text-xs text-gray-500 mt-1">Secondary brand color for accents.</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Accent Color</label>
                <div class="flex items-center gap-3">
                    <input type="color" name="accent_color" class="w-12 h-12 rounded-lg border border-gray-600 bg-transparent cursor-pointer" value="{{ $settings['accent_color'] ?? '#06B6D4' }}">
                    <input type="text" name="accent_color" class="flex-1 bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['accent_color'] ?? '#06B6D4' }}">
                </div>
                <p class="text-xs text-gray-500 mt-1">Accent color for highlights and CTAs.</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Background Color</label>
                <div class="flex items-center gap-3">
                    <input type="color" name="bg_color" class="w-12 h-12 rounded-lg border border-gray-600 bg-transparent cursor-pointer" value="{{ $settings['background_color'] ?? '#0F172A' }}">
                    <input type="text" name="bg_color" class="flex-1 bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['background_color'] ?? '#0F172A' }}">
                </div>
                <p class="text-xs text-gray-500 mt-1">Default background color.</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Logo</label>
                @if($settings['logo'] ?? null)
                    <div class="mb-3 flex items-center justify-center rounded-lg border border-gray-700/70 bg-gray-900/60 p-3" style="height: 72px;">
                        <img src="{{ settingAsset('logo') }}" alt="{{ $settings['site_name'] ?? 'Site logo' }}" style="display:block; width:auto; max-width:200px; max-height:60px; object-fit:contain;">
                    </div>
                @endif
                <input type="file" name="logo" accept="image/png,image/jpeg,image/svg+xml" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-500/20 file:text-blue-400 hover:file:bg-blue-500/30">
                <p class="text-xs text-gray-500 mt-1">Recommended: 200x60px PNG or SVG</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Favicon</label>
                @if($settings['favicon'] ?? null)
                    <div class="mb-3 flex items-center justify-center rounded-lg border border-gray-700/70 bg-gray-900/60 p-3" style="height: 72px;">
                        <img src="{{ settingAsset('favicon') }}" alt="{{ $settings['site_name'] ?? 'Site favicon' }}" width="32" height="32" style="display:block; width:32px; height:32px; object-fit:contain;">
                    </div>
                @endif
                <input type="file" name="favicon" accept="image/x-icon,image/vnd.microsoft.icon,image/png" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-500/20 file:text-blue-400 hover:file:bg-blue-500/30">
                <p class="text-xs text-gray-500 mt-1">Recommended: 32x32px ICO or PNG</p>
            </div>
        </div>
        
        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-300 mb-1">Custom CSS</label>
            <textarea name="custom_css" rows="3" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition resize-none" placeholder="/* Add custom CSS here */">{{ $settings['custom_css'] ?? '' }}</textarea>
            <p class="text-xs text-gray-500 mt-1">Add custom CSS to override default styles.</p>
        </div>
        
        <div class="mt-6 pt-6 border-t border-gray-700/50 flex gap-3">
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-lg font-medium transition shadow-lg shadow-blue-600/20">
                <i class="fas fa-save mr-2"></i> Save Settings
            </button>
        </div>
    </form>
</div>
