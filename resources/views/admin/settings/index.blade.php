<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Settings') }}
            </h2>
            <div class="flex items-center gap-3">
                <span class="text-xs text-gray-400">
                    <i class="fas fa-circle text-green-500 text-[6px] mr-1"></i>
                    All systems operational
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800/60 rounded-xl overflow-hidden border border-gray-700/50">
                <!-- Tabs Navigation -->
                <div class="border-b border-gray-700/50 px-4 py-2 flex flex-wrap gap-1 max-h-[120px] overflow-y-auto">
                    @php
                        $tabGroups = [
                            'general' => ['icon' => 'fa-sliders-h', 'label' => 'General'],
                            'branding' => ['icon' => 'fa-palette', 'label' => 'Branding'],
                            'system' => ['icon' => 'fa-server', 'label' => 'System'],
                            'communication' => ['icon' => 'fa-envelope', 'label' => 'Communication'],
                            'payment' => ['icon' => 'fa-credit-card', 'label' => 'Payment'],
                            'environment' => ['icon' => 'fa-cogs', 'label' => 'Environment'],
                            'users' => ['icon' => 'fa-users', 'label' => 'User Management'],
                            'seo' => ['icon' => 'fa-search', 'label' => 'SEO'],
                            'security' => ['icon' => 'fa-shield-alt', 'label' => 'Security'],
                            'social' => ['icon' => 'fa-share-alt', 'label' => 'Social Media'],
                            'analytics' => ['icon' => 'fa-chart-line', 'label' => 'Analytics'],
                            'backup' => ['icon' => 'fa-database', 'label' => 'Backup & Maintenance'],
                            'legal' => ['icon' => 'fa-gavel', 'label' => 'Legal & Compliance'],
                            'advanced' => ['icon' => 'fa-code', 'label' => 'Advanced'],
                        ];
                    @endphp
                    
                    @foreach($tabGroups as $key => $tab)
                        <button 
                            class="tab-btn px-3 py-1.5 text-xs rounded-lg transition flex items-center gap-1.5 {{ $activeTab == $key ? 'bg-blue-500/20 text-blue-400' : 'text-gray-400 hover:text-white hover:bg-gray-700/30' }}"
                            data-tab="{{ $key }}">
                            <i class="fas {{ $tab['icon'] }}"></i>
                            <span>{{ $tab['label'] }}</span>
                        </button>
                    @endforeach
                </div>
                
                <div class="p-6">
                    @if(session('success'))
                        <div class="mb-4 p-3 bg-green-500/20 border border-green-500/20 rounded-lg text-green-400 text-sm">
                            <i class="fas fa-check-circle mr-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="mb-4 p-3 bg-red-500/20 border border-red-500/20 rounded-lg text-red-400 text-sm">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <div class="tab-content">
                        @include('admin.settings.partials.general')
                        @include('admin.settings.partials.branding')
                        @include('admin.settings.partials.system')
                        @include('admin.settings.partials.communication')
                        @include('admin.settings.partials.payment')
                        @include('admin.settings.partials.environment')
                        @include('admin.settings.partials.users')
                        @include('admin.settings.partials.seo')
                        @include('admin.settings.partials.security')
                        @include('admin.settings.partials.social')
                        @include('admin.settings.partials.analytics')
                        @include('admin.settings.partials.backup')
                        @include('admin.settings.partials.legal')
                        @include('admin.settings.partials.advanced')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        input, select, textarea {
            color: #ffffff !important;
            background-color: rgba(55, 65, 81, 0.5) !important;
        }
        input::placeholder, textarea::placeholder {
            color: #9ca3af !important;
        }
        input:focus, select:focus, textarea:focus {
            color: #ffffff !important;
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2) !important;
        }
        input[type="file"] {
            color: #ffffff !important;
            background-color: rgba(55, 65, 81, 0.5) !important;
        }
        input[type="file"]::file-selector-button {
            background-color: rgba(59, 130, 246, 0.2) !important;
            color: #60a5fa !important;
            border: none !important;
            padding: 0.5rem 1rem !important;
            border-radius: 0.5rem !important;
            font-weight: 600 !important;
            cursor: pointer !important;
        }
        input[type="file"]::file-selector-button:hover {
            background-color: rgba(59, 130, 246, 0.3) !important;
        }
        select option {
            background-color: #1e293b !important;
            color: #ffffff !important;
        }
        .peer:checked ~ .peer-checked\:bg-blue-600 {
            background-color: #2563eb !important;
        }
        .tab-panel {
            animation: fadeIn 0.3s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    @push('scripts')
    <script>
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const tab = this.dataset.tab;
                document.querySelectorAll('.tab-btn').forEach(b => {
                    b.classList.remove('bg-blue-500/20', 'text-blue-400');
                    b.classList.add('text-gray-400');
                });
                this.classList.add('bg-blue-500/20', 'text-blue-400');
                this.classList.remove('text-gray-400');
                
                document.querySelectorAll('.tab-panel').forEach(p => p.classList.add('hidden'));
                const target = document.getElementById('tab-' + tab);
                if (target) target.classList.remove('hidden');
            });
        });

        document.querySelectorAll('input[type="color"]').forEach(picker => {
            picker.addEventListener('input', function() {
                const textInput = this.closest('.flex').querySelector('input[type="text"]');
                if (textInput) textInput.value = this.value;
            });
        });
    </script>
    @endpush
</x-app-layout>