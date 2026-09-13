<div id="tab-legal" class="tab-panel {{ $activeTab == 'legal' ? '' : 'hidden' }}">
    <h3 class="text-lg font-semibold text-white mb-2">Legal & Compliance</h3>
    <p class="text-gray-400 text-sm mb-6">Configure legal documents and compliance settings.</p>
    
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <input type="hidden" name="tab" value="legal">
        
        <div class="grid grid-cols-1 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Company Registration Number</label>
                <input type="text" name="company_reg" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['company_reg'] ?? 'RC 1234567' }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Tax ID / VAT Number</label>
                <input type="text" name="tax_id" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['tax_id'] ?? '' }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Privacy Policy</label>
                <textarea name="privacy_policy" rows="4" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition resize-none">{{ $settings['privacy_policy'] ?? 'This Privacy Policy describes how MGTECHS Limited collects, uses, and protects your personal information.' }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Terms of Service</label>
                <textarea name="terms_of_service" rows="4" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition resize-none">{{ $settings['terms_of_service'] ?? 'These Terms of Service govern your use of our website and services.' }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Cookie Policy</label>
                <textarea name="cookie_policy" rows="4" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition resize-none">{{ $settings['cookie_policy'] ?? 'This Cookie Policy explains how we use cookies and similar technologies.' }}</textarea>
            </div>
            <div class="flex items-center gap-4 pt-6">
                <label class="text-sm font-medium text-gray-300">Force Cookie Consent</label>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="force_cookie_consent" class="sr-only peer" {{ ($settings['force_cookie_consent'] ?? false) ? 'checked' : '' }}>
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