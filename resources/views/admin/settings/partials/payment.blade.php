<div id="tab-payment" class="tab-panel {{ $activeTab == 'payment' ? '' : 'hidden' }}">
    <h3 class="text-lg font-semibold text-white mb-2">Payment Gateways</h3>
    <p class="text-gray-400 text-sm mb-6">Configure payment gateways for processing transactions.</p>
    
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <input type="hidden" name="tab" value="payment">
        
        <!-- Paystack -->
        <div class="mb-6 p-4 bg-gray-700/20 rounded-lg border border-gray-700/50">
            <h4 class="text-sm font-semibold text-blue-400 mb-3"><i class="fas fa-credit-card mr-2"></i> Paystack</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Public Key</label>
                    <input type="text" name="paystack_public" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['paystack_public'] ?? '' }}" placeholder="pk_live_xxxxxxxx">
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Secret Key</label>
                    <input type="password" name="paystack_secret" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" placeholder="sk_live_xxxxxxxx">
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Merchant Email</label>
                    <input type="email" name="paystack_email" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['paystack_email'] ?? 'info@mgtechs.com.ng' }}">
                </div>
                <div class="flex items-center gap-4 pt-6">
                    <label class="text-sm text-gray-400">Enable Paystack</label>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="paystack_enabled" class="sr-only peer" {{ ($settings['paystack_enabled'] ?? false) ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-600 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </div>
            </div>
        </div>
        
        <!-- Flutterwave -->
        <div class="mb-6 p-4 bg-gray-700/20 rounded-lg border border-gray-700/50">
            <h4 class="text-sm font-semibold text-purple-400 mb-3"><i class="fas fa-wallet mr-2"></i> Flutterwave</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Public Key</label>
                    <input type="text" name="flutterwave_public" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['flutterwave_public'] ?? '' }}" placeholder="FLWPUBK-xxxxxxxx">
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Secret Key</label>
                    <input type="password" name="flutterwave_secret" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" placeholder="FLWSECK-xxxxxxxx">
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Encryption Key</label>
                    <input type="text" name="flutterwave_encryption" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['flutterwave_encryption'] ?? '' }}" placeholder="xxxxxxxx">
                </div>
                <div class="flex items-center gap-4 pt-6">
                    <label class="text-sm text-gray-400">Enable Flutterwave</label>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="flutterwave_enabled" class="sr-only peer" {{ ($settings['flutterwave_enabled'] ?? false) ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-600 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </div>
            </div>
        </div>
        
        <!-- Stripe -->
        <div class="mb-6 p-4 bg-gray-700/20 rounded-lg border border-gray-700/50">
            <h4 class="text-sm font-semibold text-cyan-400 mb-3"><i class="fab fa-stripe mr-2"></i> Stripe</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Publishable Key</label>
                    <input type="text" name="stripe_public" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['stripe_public'] ?? '' }}" placeholder="pk_live_xxxxxxxx">
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Secret Key</label>
                    <input type="password" name="stripe_secret" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" placeholder="sk_live_xxxxxxxx">
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Webhook Secret</label>
                    <input type="text" name="stripe_webhook" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['stripe_webhook'] ?? '' }}" placeholder="whsec_xxxxxxxx">
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Currency</label>
                    <select name="stripe_currency" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition">
                        <option value="NGN" {{ ($settings['stripe_currency'] ?? 'NGN') == 'NGN' ? 'selected' : '' }}>NGN - Nigerian Naira</option>
                        <option value="USD" {{ ($settings['stripe_currency'] ?? '') == 'USD' ? 'selected' : '' }}>USD - US Dollar</option>
                        <option value="EUR" {{ ($settings['stripe_currency'] ?? '') == 'EUR' ? 'selected' : '' }}>EUR - Euro</option>
                        <option value="GBP" {{ ($settings['stripe_currency'] ?? '') == 'GBP' ? 'selected' : '' }}>GBP - British Pound</option>
                    </select>
                </div>
                <div class="flex items-center gap-4 pt-6">
                    <label class="text-sm text-gray-400">Enable Stripe</label>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="stripe_enabled" class="sr-only peer" {{ ($settings['stripe_enabled'] ?? false) ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-600 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Default Currency</label>
                <select name="default_currency" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition">
                    <option value="NGN" {{ ($settings['default_currency'] ?? 'NGN') == 'NGN' ? 'selected' : '' }}>NGN - Nigerian Naira</option>
                    <option value="USD" {{ ($settings['default_currency'] ?? '') == 'USD' ? 'selected' : '' }}>USD - US Dollar</option>
                    <option value="EUR" {{ ($settings['default_currency'] ?? '') == 'EUR' ? 'selected' : '' }}>EUR - Euro</option>
                    <option value="GBP" {{ ($settings['default_currency'] ?? '') == 'GBP' ? 'selected' : '' }}>GBP - British Pound</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Tax Rate (%)</label>
                <input type="number" name="tax_rate" step="0.1" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" value="{{ $settings['tax_rate'] ?? '7.5' }}">
            </div>
        </div>
        
        <div class="mt-6 pt-6 border-t border-gray-700/50 flex gap-3">
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-lg font-medium transition shadow-lg shadow-blue-600/20">
                <i class="fas fa-save mr-2"></i> Save Settings
            </button>
        </div>
    </form>
</div>