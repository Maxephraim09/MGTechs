<div id="tab-backup" class="tab-panel {{ $activeTab == 'backup' ? '' : 'hidden' }}">
    <h3 class="text-lg font-semibold text-white mb-2">Backup & Maintenance</h3>
    <p class="text-gray-400 text-sm mb-6">Configure backup settings and maintenance tasks.</p>
    
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <input type="hidden" name="tab" value="backup">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Backup Frequency</label>
                <select name="backup_frequency" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition">
                    <option value="daily" {{ ($settings['backup_frequency'] ?? 'daily') == 'daily' ? 'selected' : '' }}>Daily</option>
                    <option value="weekly" {{ ($settings['backup_frequency'] ?? '') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                    <option value="monthly" {{ ($settings['backup_frequency'] ?? '') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                    <option value="manual" {{ ($settings['backup_frequency'] ?? '') == 'manual' ? 'selected' : '' }}>Manual Only</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Backup Retention (days)</label>
                <input type="number" name="backup_retention" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['backup_retention'] ?? '30' }}" min="7">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Backup Storage Location</label>
                <select name="backup_storage" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition">
                    <option value="local" {{ ($settings['backup_storage'] ?? 'local') == 'local' ? 'selected' : '' }}>Local Storage</option>
                    <option value="s3" {{ ($settings['backup_storage'] ?? '') == 's3' ? 'selected' : '' }}>Amazon S3</option>
                    <option value="google_drive" {{ ($settings['backup_storage'] ?? '') == 'google_drive' ? 'selected' : '' }}>Google Drive</option>
                    <option value="dropbox" {{ ($settings['backup_storage'] ?? '') == 'dropbox' ? 'selected' : '' }}>Dropbox</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Maximum Backups</label>
                <input type="number" name="max_backups" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['max_backups'] ?? '10' }}" min="3">
            </div>
            <div class="flex items-center gap-4 pt-6">
                <label class="text-sm font-medium text-gray-300">Auto Backup</label>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="auto_backup" class="sr-only peer" {{ ($settings['auto_backup'] ?? true) ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-600 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                </label>
            </div>
            <div class="flex items-center gap-4 pt-6">
                <label class="text-sm font-medium text-gray-300">Backup Images & Files</label>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="backup_files" class="sr-only peer" {{ ($settings['backup_files'] ?? true) ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-600 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                </label>
            </div>
        </div>
        
        <div class="mt-4 p-4 bg-yellow-500/10 border border-yellow-500/20 rounded-lg">
            <h4 class="text-sm font-semibold text-yellow-400 mb-2"><i class="fas fa-exclamation-triangle mr-2"></i> Maintenance Mode</h4>
            <div class="flex items-center gap-4">
                <label class="text-sm text-gray-300">Enable Maintenance Mode</label>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="maintenance_mode" class="sr-only peer" {{ ($settings['maintenance_mode'] ?? false) ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-600 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                </label>
                <span class="text-xs text-gray-500">Only admins can access the site during maintenance</span>
            </div>
            <div class="mt-3">
                <label class="block text-sm text-gray-300 mb-1">Maintenance Message</label>
                <input type="text" name="maintenance_message" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['maintenance_message'] ?? "We're currently performing scheduled maintenance. We'll be back soon!" }}">
            </div>
            <div class="mt-3">
                <label class="block text-sm text-gray-300 mb-1">Allowed IPs During Maintenance</label>
                <input type="text" name="maintenance_whitelist" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['maintenance_whitelist'] ?? '' }}" placeholder="192.168.1.1, 10.0.0.1">
                <p class="text-xs text-gray-500 mt-1">Comma-separated IPs that can access the site during maintenance.</p>
            </div>
        </div>
        
        <div class="mt-6 pt-6 border-t border-gray-700/50 flex gap-3">
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-lg font-medium transition shadow-lg shadow-blue-600/20">
                <i class="fas fa-save mr-2"></i> Save Settings
            </button>
            <button type="button" class="px-6 py-2.5 bg-emerald-600/20 hover:bg-emerald-600/30 text-emerald-400 rounded-lg font-medium transition border border-emerald-600/20">
                <i class="fas fa-database mr-2"></i> Run Backup Now
            </button>
        </div>
    </form>
</div>