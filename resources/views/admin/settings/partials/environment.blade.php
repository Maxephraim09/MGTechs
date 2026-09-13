<div id="tab-environment" class="tab-panel {{ $activeTab == 'environment' ? '' : 'hidden' }}">
    <h3 class="text-lg font-semibold text-white mb-2">Environment Configuration</h3>
    <p class="text-gray-400 text-sm mb-6">View and configure server environment settings.</p>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-1">PHP Version</label>
            <input type="text" class="w-full bg-gray-700/30 border border-gray-600 rounded-lg px-4 py-2.5 text-gray-400 cursor-not-allowed" value="{{ phpversion() }}" disabled>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-1">Laravel Version</label>
            <input type="text" class="w-full bg-gray-700/30 border border-gray-600 rounded-lg px-4 py-2.5 text-gray-400 cursor-not-allowed" value="{{ app()->version() }}" disabled>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-1">Server Software</label>
            <input type="text" class="w-full bg-gray-700/30 border border-gray-600 rounded-lg px-4 py-2.5 text-gray-400 cursor-not-allowed" value="{{ $_SERVER['SERVER_SOFTWARE'] ?? 'N/A' }}" disabled>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-1">Server IP</label>
            <input type="text" class="w-full bg-gray-700/30 border border-gray-600 rounded-lg px-4 py-2.5 text-gray-400 cursor-not-allowed" value="{{ $_SERVER['SERVER_ADDR'] ?? '127.0.0.1' }}" disabled>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-1">Database Driver</label>
            <input type="text" class="w-full bg-gray-700/30 border border-gray-600 rounded-lg px-4 py-2.5 text-gray-400 cursor-not-allowed" value="{{ config('database.default') }}" disabled>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-1">Database Name</label>
            <input type="text" class="w-full bg-gray-700/30 border border-gray-600 rounded-lg px-4 py-2.5 text-gray-400 cursor-not-allowed" value="{{ config('database.connections.' . config('database.default') . '.database') }}" disabled>
        </div>
    </div>
    
    <div class="mt-4">
        <label class="block text-sm font-medium text-gray-300 mb-1">Environment Variables</label>
        <textarea class="w-full bg-gray-700/30 border border-gray-600 rounded-lg px-4 py-2.5 text-gray-400 cursor-not-allowed font-mono text-sm" rows="6" disabled>
APP_NAME=MGTECHS Limited
APP_ENV=production
APP_DEBUG=false
APP_URL=https://mgtechs.com.ng
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mgtechs
DB_USERNAME=root
DB_PASSWORD=********
        </textarea>
        <p class="text-xs text-gray-500 mt-1">Environment variables from .env file (sensitive data hidden).</p>
    </div>
</div>