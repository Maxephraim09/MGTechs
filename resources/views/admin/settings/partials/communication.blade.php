<div id="tab-communication" class="tab-panel {{ $activeTab == 'communication' ? '' : 'hidden' }}">
    <h3 class="text-lg font-semibold text-white mb-2">Email & SMS Settings</h3>
    <p class="text-gray-400 text-sm mb-6">Configure email, SMS, and notification settings.</p>
    
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <input type="hidden" name="tab" value="communication">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Mail Driver</label>
                <select name="mail_driver" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition">
                    <option value="smtp" {{ ($settings['mail_driver'] ?? 'smtp') == 'smtp' ? 'selected' : '' }}>SMTP</option>
                    <option value="sendmail" {{ ($settings['mail_driver'] ?? '') == 'sendmail' ? 'selected' : '' }}>Sendmail</option>
                    <option value="mailgun" {{ ($settings['mail_driver'] ?? '') == 'mailgun' ? 'selected' : '' }}>Mailgun</option>
                    <option value="ses" {{ ($settings['mail_driver'] ?? '') == 'ses' ? 'selected' : '' }}>Amazon SES</option>
                    <option value="log" {{ ($settings['mail_driver'] ?? '') == 'log' ? 'selected' : '' }}>Log (Testing)</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Mail Host</label>
                <input type="text" name="mail_host" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['mail_host'] ?? 'smtp.gmail.com' }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Mail Port</label>
                <input type="number" name="mail_port" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['mail_port'] ?? '587' }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Mail Encryption</label>
                <select name="mail_encryption" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition">
                    <option value="tls" {{ ($settings['mail_encryption'] ?? 'tls') == 'tls' ? 'selected' : '' }}>TLS</option>
                    <option value="ssl" {{ ($settings['mail_encryption'] ?? '') == 'ssl' ? 'selected' : '' }}>SSL</option>
                    <option value="" {{ ($settings['mail_encryption'] ?? '') == '' ? 'selected' : '' }}>None</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">SMTP Username</label>
                <input type="text" name="mail_username" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['mail_username'] ?? 'info@mgtechs.com.ng' }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">SMTP Password</label>
                <input type="password" name="mail_password" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" placeholder="••••••••">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">From Email</label>
                <input type="email" name="mail_from_address" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['mail_from_address'] ?? 'info@mgtechs.com.ng' }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">From Name</label>
                <input type="text" name="mail_from_name" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['mail_from_name'] ?? 'MGTECHS Limited' }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">SMS Provider</label>
                <select name="sms_provider" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition">
                    <option value="twilio" {{ ($settings['sms_provider'] ?? 'twilio') == 'twilio' ? 'selected' : '' }}>Twilio</option>
                    <option value="africastalking" {{ ($settings['sms_provider'] ?? '') == 'africastalking' ? 'selected' : '' }}>Africa's Talking</option>
                    <option value="termii" {{ ($settings['sms_provider'] ?? '') == 'termii' ? 'selected' : '' }}>Termii</option>
                    <option value="messagebird" {{ ($settings['sms_provider'] ?? '') == 'messagebird' ? 'selected' : '' }}>MessageBird</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">SMS Sender ID</label>
                <input type="text" name="sms_sender_id" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['sms_sender_id'] ?? 'MGTECHS' }}">
                <p class="text-xs text-gray-500 mt-1">Max 11 characters</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Notification Emails</label>
                <input type="text" name="notification_emails" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['notification_emails'] ?? 'info@mgtechs.com.ng' }}" placeholder="comma-separated emails">
            </div>
            <div class="flex items-center gap-4 pt-6">
                <label class="text-sm font-medium text-gray-300">Enable SMS Notifications</label>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="sms_enabled" class="sr-only peer" {{ ($settings['sms_enabled'] ?? true) ? 'checked' : '' }}>
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