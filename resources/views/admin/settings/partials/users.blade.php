<div id="tab-users" class="tab-panel {{ $activeTab == 'users' ? '' : 'hidden' }}">
    <h3 class="text-lg font-semibold text-white mb-2">User Management</h3>
    <p class="text-gray-400 text-sm mb-6">Manage user roles, permissions, and registration settings.</p>
    
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <input type="hidden" name="tab" value="users">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Default User Role</label>
                <select name="default_role" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition">
                    <option value="student" {{ ($settings['default_role'] ?? 'student') == 'student' ? 'selected' : '' }}>Student</option>
                    <option value="client" {{ ($settings['default_role'] ?? '') == 'client' ? 'selected' : '' }}>Client</option>
                    <option value="admin" {{ ($settings['default_role'] ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Registration Status</label>
                <select name="registration_status" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition">
                    <option value="open" {{ ($settings['registration_status'] ?? 'open') == 'open' ? 'selected' : '' }}>Open (Anyone can register)</option>
                    <option value="invite_only" {{ ($settings['registration_status'] ?? '') == 'invite_only' ? 'selected' : '' }}>Invite Only</option>
                    <option value="closed" {{ ($settings['registration_status'] ?? '') == 'closed' ? 'selected' : '' }}>Closed (Admin only)</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Activity Logs</label>
                <select name="activity_logs" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition">
                    <option value="enabled" {{ ($settings['activity_logs'] ?? 'enabled') == 'enabled' ? 'selected' : '' }}>Enabled</option>
                    <option value="disabled" {{ ($settings['activity_logs'] ?? '') == 'disabled' ? 'selected' : '' }}>Disabled</option>
                    <option value="limited" {{ ($settings['activity_logs'] ?? '') == 'limited' ? 'selected' : '' }}>Limited (Admin only)</option>
                </select>
            </div>
            <div class="flex items-center gap-4 pt-6">
                <label class="text-sm font-medium text-gray-300">Email Verification Required</label>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="email_verification" class="sr-only peer" {{ ($settings['email_verification'] ?? true) ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-600 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                </label>
            </div>
            <div class="flex items-center gap-4 pt-6">
                <label class="text-sm font-medium text-gray-300">Admin Approval Required</label>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="admin_approval" class="sr-only peer" {{ ($settings['admin_approval'] ?? false) ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-600 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                </label>
            </div>
            <div class="flex items-center gap-4 pt-6">
                <label class="text-sm font-medium text-gray-300">Allow Social Login</label>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="social_login" class="sr-only peer" {{ ($settings['social_login'] ?? true) ? 'checked' : '' }}>
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