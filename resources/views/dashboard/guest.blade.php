<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100 dark:bg-gray-900">
        <div class="max-w-4xl w-full mx-auto px-4 py-8">
            <!-- Logo -->
            <div class="text-center mb-8">
                @if($settings['logo'] ?? null)
                    <img src="{{ settingAsset('logo') }}" alt="{{ $settings['site_name'] ?? 'MGTECHS' }}" class="mx-auto" style="display:block; width:auto; max-width:220px; max-height:64px; object-fit:contain;">
                @else
                    <div class="inline-flex items-center gap-3 text-3xl font-extrabold">
                        <span class="text-gray-900 dark:text-white">{{ $settings['logo_text'] ?? 'MG' }}</span>
                        <span class="bg-gradient-to-r from-blue-500 to-purple-500 bg-clip-text text-transparent">{{ $settings['logo_highlight'] ?? 'TECHS' }}</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400 font-normal bg-gray-200 dark:bg-gray-800 px-2 py-0.5 rounded-full">{{ $settings['logo_badge'] ?? 'Limited' }}</span>
                    </div>
                @endif
                <p class="text-gray-600 dark:text-gray-300 mt-2">{{ $settings['tagline'] ?? "Nigeria's Trusted Technology Partner" }}</p>
            </div>

            <!-- Hero Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 p-8 text-center">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    Welcome to <span class="bg-gradient-to-r from-blue-500 to-purple-500 bg-clip-text text-transparent">{{ $settings['site_name'] ?? 'MGTECHS' }}</span>
                </h1>
                <p class="text-gray-600 dark:text-gray-300 text-lg mb-6 max-w-2xl mx-auto">
                    {{ $settings['meta_description'] ?? $settings['tagline'] ?? 'Your trusted partner for Web Development, Software Solutions, Graphics Design, Printing, Branding, and IT Consultation.' }}
                </p>

                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('login') }}" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white rounded-xl font-semibold transition">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="px-6 py-3 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-900 dark:text-white rounded-xl font-semibold transition">
                        <i class="fas fa-user-plus mr-2"></i> Register
                    </a>
                </div>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 text-center hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-blue-500/10 rounded-xl flex items-center justify-center text-blue-500 mx-auto mb-3">
                        <i class="fas fa-code text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white">Web Development</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Custom websites and applications</p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 text-center hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center text-green-500 mx-auto mb-3">
                        <i class="fas fa-graduation-cap text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white">LMS & Training</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Online learning platforms</p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 text-center hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-purple-500/10 rounded-xl flex items-center justify-center text-purple-500 mx-auto mb-3">
                        <i class="fas fa-paint-brush text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white">Graphics & Branding</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Professional design services</p>
                </div>
            </div>

            <!-- Testimonial -->
            <div class="mt-8 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 text-center">
                <div class="text-yellow-500 mb-2">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="text-gray-600 dark:text-gray-300 italic">"{{ $settings['site_name'] ?? 'MGTECHS' }} delivered an exceptional web solution that transformed our business operations. Professional, reliable, and innovative."</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">— Adeola Consulting, CEO</p>
            </div>

            <!-- Footer -->
            <div class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400">
                &copy; {{ date('Y') }} {{ brandSetting('company_name', $settings['site_name'] ?? 'MGTECHS Limited') }}. All Rights Reserved.
            </div>
        </div>
    </div>
</x-guest-layout>
