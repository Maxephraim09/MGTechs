<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // Share default settings
        View::share('settings', [
            'site_name' => 'MGTECHS Limited',
            'primary_color' => '#4F46E5',
            'secondary_color' => '#7C3AED',
            'accent_color' => '#06B6D4',
            'background_color' => '#0F172A',
            'logo' => null,
            'favicon' => null,
            'custom_css' => null,
            'logo_text' => 'MG',
            'logo_highlight' => 'TECHS',
            'logo_badge' => 'Limited',
            'company_name' => 'MGTECHS Limited',
            'company_rc' => 'RC 1234567',
            'contact_email' => 'info@mgtechs.com.ng',
            'contact_phone' => '+234 816 159 5906',
            'contact_address' => 'Yola, Nigeria',
        ]);

        // Try to load from database
        try {
            if (class_exists('App\Models\Setting') && Schema::hasTable('settings')) {
                View::composer('*', function ($view) {
                    try {
                        $dbSettings = \App\Models\Setting::getAllSettings();
                        if (!empty($dbSettings)) {
                            $view->with('settings', array_merge($view->shared('settings'), $dbSettings));
                        }
                    } catch (\Exception $e) {
                        // Silently fail
                    }
                });
            }
        } catch (\Exception $e) {
            // Silently fail
        }
    }
}
