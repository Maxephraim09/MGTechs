<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        return Setting::get($key, $default);
    }
}

if (!function_exists('settingGroup')) {
    function settingGroup($group)
    {
        return Setting::getGroup($group);
    }
}

if (!function_exists('settings')) {
    function settings()
    {
        return Setting::getAllSettings();
    }
}

if (!function_exists('settingAsset')) {
    function settingAsset($key, $default = null)
    {
        $path = setting($key, $default);

        if (!$path) {
            return null;
        }

        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        return Storage::disk('public')->url(ltrim($path, '/'));
    }
}

if (!function_exists('brandSetting')) {
    function brandSetting($key, $default = null)
    {
        $aliases = [
            'company_name' => ['company_name', 'site_name'],
            'company_rc' => ['company_rc', 'company_reg'],
            'contact_email' => ['contact_email', 'mail_from_address'],
            'social_twitter' => ['social_twitter', 'twitter_url'],
            'social_linkedin' => ['social_linkedin', 'linkedin_url'],
            'social_github' => ['social_github', 'github_url'],
            'social_youtube' => ['social_youtube', 'youtube_url'],
        ];

        foreach ($aliases[$key] ?? [$key] as $settingKey) {
            $value = setting($settingKey);

            if (filled($value)) {
                return $value;
            }
        }

        return $default;
    }
}
