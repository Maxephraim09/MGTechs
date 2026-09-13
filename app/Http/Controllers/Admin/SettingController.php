<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    /**
     * Display settings page with all groups
     */
    public function index()
    {
        $settings = Setting::getAllSettings();
        $groups = [
            'general' => 'General Settings',
            'branding' => 'Branding & Design',
            'system' => 'System Configuration',
            'environment' => 'Environment',
            'communication' => 'Email & SMS',
            'payment' => 'Payment Gateways',
            'users' => 'User Management',
            'seo' => 'SEO & Meta',
            'security' => 'Security',
            'social' => 'Social Media',
            'analytics' => 'Analytics',
            'backup' => 'Backup & Maintenance',
            'legal' => 'Legal & Compliance',
            'advanced' => 'Advanced'
        ];
        
        // Get current active tab from session or default to 'general'
        $activeTab = session('active_tab', 'general');
        
        return view('admin.settings.index', compact('settings', 'groups', 'activeTab'));
    }

    /**
     * Update settings
     */
    public function update(Request $request)
    {
        try {
            $group = $request->input('tab', 'general');
            $allowedGroups = ['general', 'branding', 'system', 'communication', 'payment', 'users', 'seo', 'security', 'social', 'analytics', 'backup', 'legal', 'advanced'];

            abort_unless(in_array($group, $allowedGroups, true), 422, 'Invalid settings group.');

            $data = $request->except(['_token', '_method', 'tab']);
            if ($group === 'branding' && array_key_exists('bg_color', $data)) {
                $data['background_color'] = $data['bg_color'];
                unset($data['bg_color']);
            }

            $allowedKeys = $this->allowedKeysForGroup($group);
            $data = array_intersect_key($data, array_flip($allowedKeys));

            if ($group === 'branding') {
                foreach (['logo', 'favicon'] as $fileKey) {
                    if ($request->hasFile($fileKey)) {
                        $data[$fileKey] = $request->file($fileKey);
                    }
                }
            }

            foreach (Setting::where('group', $group)->where('type', 'boolean')->pluck('key') as $key) {
                $data[$key] = $request->boolean($key);
            }

            // Validate based on group
            $validator = $this->validateSettings($data, $group);
            
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('active_tab', $group);
            }

            // Process and save settings
            foreach ($data as $key => $value) {
                // Handle file uploads
                if ($request->hasFile($key)) {
                    $value = $this->handleFileUpload($request->file($key), $key);
                }
                
                // Handle boolean values
                if (in_array($key, ['debug_mode', 'maintenance_mode', 'email_verification', 'social_login', 'force_https', 'rate_limiting', 'cors_protection', 'cookie_consent', 'auto_backup', 'backup_files', 'force_cookie_consent', 'enable_api', 'sms_enabled', 'email_notifications', 'sms_notifications', 'push_notifications', 'paystack_enabled', 'flutterwave_enabled', 'stripe_enabled'])) {
                    $value = filter_var($value, FILTER_VALIDATE_BOOLEAN);
                }
                
                Setting::set($key, $value, $group);
            }
            
            // Log activity
            ActivityLog::log(
                'settings_updated',
                'Updated ' . $group . ' settings',
                ['keys' => array_keys($data)],
                $group
            );
            
            // Clear settings cache
            Setting::clearCache();
            
            return redirect()->back()
                ->with('success', 'Settings updated successfully!')
                ->with('active_tab', $group);
                
        } catch (\Exception $e) {
            Log::error('Settings update error: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Failed to update settings: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Validate settings based on group
     */
    private function validateSettings($data, $group)
    {
        $rules = [];
        
        switch ($group) {
            case 'general':
                $rules = [
                    'site_name' => 'required|string|max:255',
                    'tagline' => 'nullable|string|max:255',
                    'timezone' => 'required|string',
                    'language' => 'required|string|size:2',
                    'date_format' => 'nullable|string|max:50',
                    'time_format' => 'nullable|string|max:50',
                ];
                break;
                
            case 'branding':
                $rules = [
                    'primary_color' => 'nullable|string|max:7',
                    'secondary_color' => 'nullable|string|max:7',
                    'accent_color' => 'nullable|string|max:7',
                    'background_color' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
                    'logo' => 'nullable|file|mimes:png,jpg,jpeg,svg|max:2048',
                    'favicon' => 'nullable|file|mimes:ico,png|max:512',
                ];
                break;
                
            case 'system':
                $rules = [
                    'app_env' => 'nullable|in:local,staging,production',
                    'app_version' => 'nullable|string|max:50',
                    'app_url' => 'nullable|url',
                    'session_lifetime' => 'nullable|integer|min:15|max:1440',
                    'max_login_attempts' => 'nullable|integer|min:3|max:10',
                ];
                break;
                
            case 'communication':
                $rules = [
                    'mail_driver' => 'nullable|in:smtp,sendmail,mailgun,ses,log',
                    'mail_host' => 'nullable|string',
                    'mail_port' => 'nullable|integer|min:1|max:65535',
                    'mail_encryption' => 'nullable|in:tls,ssl',
                    'mail_username' => 'nullable|email',
                    'mail_from_address' => 'nullable|email',
                    'mail_from_name' => 'nullable|string|max:255',
                    'sms_sender_id' => 'nullable|string|max:11',
                    'notification_emails' => 'nullable|string',
                ];
                break;
                
            case 'payment':
                $rules = [
                    'default_currency' => 'nullable|string|size:3',
                    'tax_rate' => 'nullable|numeric|min:0|max:100',
                    'paystack_public' => 'nullable|string',
                    'paystack_email' => 'nullable|email',
                    'flutterwave_public' => 'nullable|string',
                    'stripe_public' => 'nullable|string',
                    'stripe_currency' => 'nullable|string|size:3',
                ];
                break;

            case 'users':
                $rules = [
                    'default_role' => 'nullable|in:admin,client,student',
                    'registration_status' => 'nullable|in:open,closed,approval',
                    'activity_logs' => 'nullable|in:enabled,disabled',
                ];
                break;
                
            case 'seo':
                $rules = [
                    'meta_title' => 'nullable|string|max:255',
                    'meta_description' => 'nullable|string|max:500',
                    'meta_keywords' => 'nullable|string|max:500',
                    'ga_id' => 'nullable|string|max:50',
                    'gtm_id' => 'nullable|string|max:50',
                    'custom_meta' => 'nullable|string|max:10000',
                ];
                break;
                
            case 'security':
                $rules = [
                    'session_timeout' => 'nullable|integer|min:15|max:1440',
                    'admin_ip_whitelist' => 'nullable|string',
                ];
                break;
                
            case 'social':
                $rules = [
                    'facebook_url' => 'nullable|url',
                    'twitter_url' => 'nullable|url',
                    'instagram_url' => 'nullable|url',
                    'linkedin_url' => 'nullable|url',
                    'youtube_url' => 'nullable|url',
                    'github_url' => 'nullable|url',
                    'discord_url' => 'nullable|url',
                    'whatsapp_url' => 'nullable|url',
                ];
                break;
                
            case 'backup':
                $rules = [
                    'backup_frequency' => 'nullable|in:daily,weekly,monthly,manual',
                    'backup_retention' => 'nullable|integer|min:7|max:365',
                    'max_backups' => 'nullable|integer|min:3|max:50',
                    'backup_storage' => 'nullable|in:local,s3,dropbox,google_drive',
                    'maintenance_message' => 'nullable|string|max:255',
                    'maintenance_whitelist' => 'nullable|string',
                ];
                break;

            case 'analytics':
                $rules = [
                    'ga4_id' => 'nullable|string|max:50',
                    'gtm_id_analytics' => 'nullable|string|max:50',
                    'fb_pixel' => 'nullable|string|max:50',
                    'linkedin_insight' => 'nullable|string|max:50',
                ];
                break;

            case 'legal':
                $rules = [
                    'company_reg' => 'nullable|string|max:255',
                    'tax_id' => 'nullable|string|max:255',
                    'privacy_policy' => 'nullable|string|max:50000',
                    'terms_of_service' => 'nullable|string|max:50000',
                    'cookie_policy' => 'nullable|string|max:50000',
                ];
                break;

            case 'advanced':
                $rules = [
                    'php_ini' => 'nullable|string|max:10000',
                    'custom_header_scripts' => 'nullable|string|max:20000',
                    'custom_footer_scripts' => 'nullable|string|max:20000',
                    'api_rate_limit' => 'nullable|integer|min:1|max:100000',
                ];
                break;
        }
        
        return Validator::make($data, $rules);
    }

    private function allowedKeysForGroup(string $group): array
    {
        $keys = Setting::where('group', $group)->pluck('key')->all();

        $fallbackKeys = [
            'general' => ['site_name', 'tagline', 'timezone', 'language', 'date_format', 'time_format'],
            'branding' => ['primary_color', 'secondary_color', 'accent_color', 'background_color', 'logo', 'favicon', 'custom_css', 'logo_text', 'logo_highlight', 'logo_badge'],
            'system' => ['app_env', 'debug_mode', 'app_url', 'app_version', 'session_lifetime', 'max_login_attempts', 'maintenance_mode'],
            'communication' => ['mail_driver', 'mail_host', 'mail_port', 'mail_encryption', 'mail_username', 'mail_password', 'mail_from_address', 'mail_from_name', 'sms_provider', 'sms_api_key', 'sms_sender_id', 'notification_emails', 'sms_enabled', 'email_notifications', 'sms_notifications', 'push_notifications'],
            'payment' => ['default_currency', 'tax_rate', 'paystack_public', 'paystack_secret', 'paystack_email', 'paystack_enabled', 'flutterwave_public', 'flutterwave_secret', 'flutterwave_encryption', 'flutterwave_enabled', 'stripe_public', 'stripe_secret', 'stripe_webhook', 'stripe_currency', 'stripe_enabled'],
            'users' => ['default_role', 'registration_status', 'email_verification', 'admin_approval', 'social_login', 'activity_logs'],
            'seo' => ['meta_title', 'meta_description', 'meta_keywords', 'ga_id', 'gtm_id', 'custom_meta'],
            'security' => ['two_factor_auth', 'force_https', 'rate_limiting', 'cors_protection', 'admin_ip_whitelist', 'session_timeout'],
            'social' => ['facebook_url', 'twitter_url', 'instagram_url', 'linkedin_url', 'youtube_url', 'github_url', 'discord_url', 'whatsapp_url'],
            'analytics' => ['ga4_id', 'gtm_id_analytics', 'fb_pixel', 'linkedin_insight', 'cookie_consent'],
            'backup' => ['backup_frequency', 'backup_retention', 'backup_storage', 'max_backups', 'auto_backup', 'backup_files', 'maintenance_mode', 'maintenance_message', 'maintenance_whitelist'],
            'legal' => ['company_reg', 'tax_id', 'privacy_policy', 'terms_of_service', 'cookie_policy', 'force_cookie_consent'],
            'advanced' => ['php_ini', 'custom_header_scripts', 'custom_footer_scripts', 'enable_api', 'api_rate_limit'],
        ];

        return array_values(array_unique(array_merge($keys, $fallbackKeys[$group] ?? [])));
    }

    /**
     * Handle file uploads
     */
    private function handleFileUpload($file, $key)
    {
        try {
            $path = $file->store('settings/' . $key, 'public');
            return $path;
        } catch (\Exception $e) {
            Log::error('File upload error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Clear cache
     */
    public function clearCache(Request $request)
    {
        try {
            $type = $request->input('type', 'all');
            $results = [];
            
            switch ($type) {
                case 'config':
                    Artisan::call('config:clear');
                    $results[] = 'Config cache cleared';
                    break;
                case 'route':
                    Artisan::call('route:clear');
                    $results[] = 'Route cache cleared';
                    break;
                case 'view':
                    Artisan::call('view:clear');
                    $results[] = 'View cache cleared';
                    break;
                case 'all':
                    Artisan::call('cache:clear');
                    Artisan::call('config:clear');
                    Artisan::call('route:clear');
                    Artisan::call('view:clear');
                    Setting::clearCache();
                    $results[] = 'All caches cleared';
                    break;
                default:
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid cache type'
                    ], 400);
            }
            
            ActivityLog::log(
                'cache_cleared',
                'Cleared cache: ' . $type,
                ['type' => $type]
            );
            
            return response()->json([
                'success' => true,
                'message' => implode(', ', $results),
                'type' => $type
            ]);
            
        } catch (\Exception $e) {
            Log::error('Cache clear error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to clear cache: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Reset settings to default
     */
    public function reset(Request $request)
    {
        try {
            $group = $request->input('group', 'all');
            
            if ($group === 'all') {
                Setting::truncate();
                $this->seedDefaultSettings();
                $message = 'All settings reset to default';
            } else {
                Setting::where('group', $group)->delete();
                $this->seedGroupDefaults($group);
                $message = ucfirst($group) . ' settings reset to default';
            }
            
            Setting::clearCache();
            
            ActivityLog::log(
                'settings_reset',
                'Reset settings: ' . ($group === 'all' ? 'all' : $group)
            );
            
            return redirect()->back()
                ->with('success', $message)
                ->with('active_tab', $group === 'all' ? 'general' : $group);
                
        } catch (\Exception $e) {
            Log::error('Settings reset error: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Failed to reset settings: ' . $e->getMessage());
        }
    }

    /**
     * Get setting by key (AJAX)
     */
    public function getSetting(Request $request)
    {
        $key = $request->input('key');
        
        if (!$key) {
            return response()->json([
                'success' => false,
                'message' => 'Key is required'
            ], 400);
        }
        
        $value = Setting::get($key);
        
        return response()->json([
            'success' => true,
            'key' => $key,
            'value' => $value
        ]);
    }

    /**
     * Update single setting (AJAX)
     */
    public function updateSetting(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'key' => 'required|string',
            'value' => 'nullable',
            'group' => 'nullable|string'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }
        
        try {
            $group = $request->input('group', 'general');
            Setting::set($request->key, $request->value, $group);
            Setting::clearCache();
            
            ActivityLog::log(
                'settings_updated',
                'Updated setting: ' . $request->key,
                ['key' => $request->key, 'group' => $group]
            );
            
            return response()->json([
                'success' => true,
                'message' => 'Setting updated successfully',
                'key' => $request->key,
                'value' => $request->value
            ]);
            
        } catch (\Exception $e) {
            Log::error('Setting update error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to update setting: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all settings by group (AJAX)
     */
    public function getGroup(Request $request)
    {
        $group = $request->input('group', 'general');
        
        $settings = Setting::getGroup($group);
        
        return response()->json([
            'success' => true,
            'group' => $group,
            'settings' => $settings
        ]);
    }

    /**
     * Seed default settings
     */
    private function seedDefaultSettings()
    {
        // This should match the settings defined in the migration
        $defaults = [
            // General
            ['group' => 'general', 'key' => 'site_name', 'value' => 'MGTECHS Limited', 'type' => 'text'],
            ['group' => 'general', 'key' => 'tagline', 'value' => "Nigeria's Trusted Technology Partner", 'type' => 'text'],
            ['group' => 'general', 'key' => 'timezone', 'value' => 'Africa/Lagos', 'type' => 'text'],
            ['group' => 'general', 'key' => 'language', 'value' => 'en', 'type' => 'text'],
            
            // Branding
            ['group' => 'branding', 'key' => 'primary_color', 'value' => '#4F46E5', 'type' => 'color'],
            ['group' => 'branding', 'key' => 'secondary_color', 'value' => '#7C3AED', 'type' => 'color'],
            ['group' => 'branding', 'key' => 'accent_color', 'value' => '#06B6D4', 'type' => 'color'],
            ['group' => 'branding', 'key' => 'background_color', 'value' => '#0F172A', 'type' => 'color'],
            ['group' => 'branding', 'key' => 'logo', 'value' => '', 'type' => 'file'],
            ['group' => 'branding', 'key' => 'favicon', 'value' => '', 'type' => 'file'],
            ['group' => 'branding', 'key' => 'custom_css', 'value' => '', 'type' => 'textarea'],
            ['group' => 'branding', 'key' => 'logo_text', 'value' => 'MG', 'type' => 'text'],
            ['group' => 'branding', 'key' => 'logo_highlight', 'value' => 'TECHS', 'type' => 'text'],
            ['group' => 'branding', 'key' => 'logo_badge', 'value' => 'Limited', 'type' => 'text'],
        ];
        
        foreach ($defaults as $setting) {
            if (!Setting::where('key', $setting['key'])->exists()) {
                Setting::create($setting);
            }
        }
    }

    /**
     * Seed group defaults
     */
    private function seedGroupDefaults($group)
    {
        // For simplicity, we'll just seed all defaults
        // In production, you'd want to seed specific group defaults
        $this->seedDefaultSettings();
    }

    /**
     * Export settings (JSON)
     */
    public function export()
    {
        try {
            $settings = Setting::all(['group', 'key', 'value', 'type']);
            
            return response()->json([
                'success' => true,
                'data' => $settings,
                'exported_at' => now()->toISOString()
            ]);
            
        } catch (\Exception $e) {
            Log::error('Settings export error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to export settings: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Import settings (JSON)
     */
    public function import(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'settings' => 'required|json'
            ]);
            
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            
            $importData = json_decode($request->settings, true);
            
            if (!is_array($importData)) {
                throw new \Exception('Invalid settings data format');
            }
            
            foreach ($importData as $setting) {
                if (isset($setting['key']) && isset($setting['value'])) {
                    $group = $setting['group'] ?? 'general';
                    Setting::set($setting['key'], $setting['value'], $group);
                }
            }
            
            Setting::clearCache();
            
            ActivityLog::log(
                'settings_imported',
                'Imported settings',
                ['count' => count($importData)]
            );
            
            return redirect()->back()
                ->with('success', 'Settings imported successfully! (' . count($importData) . ' settings)');
                
        } catch (\Exception $e) {
            Log::error('Settings import error: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Failed to import settings: ' . $e->getMessage());
        }
    }
}
