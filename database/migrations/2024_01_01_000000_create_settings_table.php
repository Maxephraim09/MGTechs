<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('group')->index(); // general, branding, system, communication, payment, etc.
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text'); // text, number, boolean, json, color, file
            $table->boolean('is_encrypted')->default(false);
            $table->boolean('is_public')->default(false);
            $table->text('description')->nullable();
            $table->json('options')->nullable(); // For select, radio, etc.
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            // Indexes
            $table->index(['group', 'key']);
        });
        
        // Insert default settings
        $this->seedDefaultSettings();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
    
    /**
     * Seed default settings
     */
    private function seedDefaultSettings(): void
    {
        $settings = [
            // ===== GENERAL SETTINGS =====
            ['group' => 'general', 'key' => 'site_name', 'value' => 'MGTECHS Limited', 'type' => 'text', 'description' => 'The name of your website'],
            ['group' => 'general', 'key' => 'tagline', 'value' => "Nigeria's Trusted Technology Partner", 'type' => 'text', 'description' => 'A short description of your site'],
            ['group' => 'general', 'key' => 'timezone', 'value' => 'Africa/Lagos', 'type' => 'text', 'description' => 'Default timezone'],
            ['group' => 'general', 'key' => 'language', 'value' => 'en', 'type' => 'text', 'description' => 'Default language'],
            ['group' => 'general', 'key' => 'date_format', 'value' => 'Y-m-d', 'type' => 'text'],
            ['group' => 'general', 'key' => 'time_format', 'value' => 'H:i', 'type' => 'text'],
            
            // ===== BRANDING SETTINGS =====
            ['group' => 'branding', 'key' => 'primary_color', 'value' => '#4F46E5', 'type' => 'color', 'description' => 'Main brand color'],
            ['group' => 'branding', 'key' => 'secondary_color', 'value' => '#7C3AED', 'type' => 'color', 'description' => 'Secondary brand color'],
            ['group' => 'branding', 'key' => 'accent_color', 'value' => '#06B6D4', 'type' => 'color', 'description' => 'Accent color'],
            ['group' => 'branding', 'key' => 'background_color', 'value' => '#0F172A', 'type' => 'color', 'description' => 'Default background color'],
            ['group' => 'branding', 'key' => 'logo', 'value' => '', 'type' => 'file', 'description' => 'Primary logo'],
            ['group' => 'branding', 'key' => 'favicon', 'value' => '', 'type' => 'file', 'description' => 'Favicon'],
            ['group' => 'branding', 'key' => 'custom_css', 'value' => '', 'type' => 'textarea', 'description' => 'Custom CSS'],
            ['group' => 'branding', 'key' => 'logo_text', 'value' => 'MG', 'type' => 'text'],
            ['group' => 'branding', 'key' => 'logo_highlight', 'value' => 'TECHS', 'type' => 'text'],
            ['group' => 'branding', 'key' => 'logo_badge', 'value' => 'Limited', 'type' => 'text'],
            
            // ===== SYSTEM SETTINGS =====
            ['group' => 'system', 'key' => 'app_env', 'value' => 'production', 'type' => 'text', 'description' => 'Application environment'],
            ['group' => 'system', 'key' => 'debug_mode', 'value' => 'false', 'type' => 'boolean', 'description' => 'Enable debug mode'],
            ['group' => 'system', 'key' => 'app_url', 'value' => 'https://mgtechs.com.ng', 'type' => 'text', 'description' => 'Application URL'],
            ['group' => 'system', 'key' => 'app_version', 'value' => '1.0.0', 'type' => 'text', 'description' => 'Application version'],
            ['group' => 'system', 'key' => 'session_lifetime', 'value' => '120', 'type' => 'number', 'description' => 'Session lifetime in minutes'],
            ['group' => 'system', 'key' => 'max_login_attempts', 'value' => '5', 'type' => 'number', 'description' => 'Maximum login attempts'],
            ['group' => 'system', 'key' => 'maintenance_mode', 'value' => 'false', 'type' => 'boolean', 'description' => 'Maintenance mode'],
            ['group' => 'system', 'key' => 'maintenance_message', 'value' => "We're currently performing scheduled maintenance. We'll be back soon!", 'type' => 'text'],
            ['group' => 'system', 'key' => 'maintenance_content', 'value' => "We're currently performing scheduled maintenance to improve your experience. We'll be back online shortly.\n\nIf you need immediate assistance, please contact us at info@mgtechs.com.ng", 'type' => 'textarea'],
            ['group' => 'system', 'key' => 'maintenance_whitelist', 'value' => '', 'type' => 'text', 'description' => 'Allowed IPs during maintenance'],
            
            // ===== COMMUNICATION - EMAIL =====
            ['group' => 'communication', 'key' => 'mail_driver', 'value' => 'smtp', 'type' => 'text', 'description' => 'Mail driver'],
            ['group' => 'communication', 'key' => 'mail_host', 'value' => 'smtp.gmail.com', 'type' => 'text', 'description' => 'SMTP host'],
            ['group' => 'communication', 'key' => 'mail_port', 'value' => '587', 'type' => 'number', 'description' => 'SMTP port'],
            ['group' => 'communication', 'key' => 'mail_encryption', 'value' => 'tls', 'type' => 'text', 'description' => 'Encryption type'],
            ['group' => 'communication', 'key' => 'mail_username', 'value' => 'info@mgtechs.com.ng', 'type' => 'text', 'description' => 'SMTP username'],
            ['group' => 'communication', 'key' => 'mail_password', 'value' => '', 'type' => 'text', 'is_encrypted' => true, 'description' => 'SMTP password'],
            ['group' => 'communication', 'key' => 'mail_from_address', 'value' => 'info@mgtechs.com.ng', 'type' => 'text', 'description' => 'From email'],
            ['group' => 'communication', 'key' => 'mail_from_name', 'value' => 'MGTECHS Limited', 'type' => 'text', 'description' => 'From name'],
            
            // ===== COMMUNICATION - SMS =====
            ['group' => 'communication', 'key' => 'sms_provider', 'value' => 'twilio', 'type' => 'text', 'description' => 'SMS provider'],
            ['group' => 'communication', 'key' => 'sms_api_key', 'value' => '', 'type' => 'text', 'is_encrypted' => true, 'description' => 'SMS API key'],
            ['group' => 'communication', 'key' => 'sms_sender_id', 'value' => 'MGTECHS', 'type' => 'text', 'description' => 'SMS sender ID'],
            ['group' => 'communication', 'key' => 'sms_country_code', 'value' => '+234', 'type' => 'text', 'description' => 'Default country code'],
            ['group' => 'communication', 'key' => 'sms_enabled', 'value' => 'true', 'type' => 'boolean', 'description' => 'Enable SMS'],
            
            // ===== COMMUNICATION - NOTIFICATIONS =====
            ['group' => 'communication', 'key' => 'email_notifications', 'value' => 'true', 'type' => 'boolean', 'description' => 'Enable email notifications'],
            ['group' => 'communication', 'key' => 'sms_notifications', 'value' => 'true', 'type' => 'boolean', 'description' => 'Enable SMS notifications'],
            ['group' => 'communication', 'key' => 'push_notifications', 'value' => 'false', 'type' => 'boolean', 'description' => 'Enable push notifications'],
            ['group' => 'communication', 'key' => 'notification_emails', 'value' => 'info@mgtechs.com.ng', 'type' => 'text', 'description' => 'Notification recipient emails'],
            
            // ===== PAYMENT SETTINGS =====
            ['group' => 'payment', 'key' => 'default_currency', 'value' => 'NGN', 'type' => 'text', 'description' => 'Default currency'],
            ['group' => 'payment', 'key' => 'tax_rate', 'value' => '7.5', 'type' => 'number', 'description' => 'Tax rate percentage'],
            
            // Paystack
            ['group' => 'payment', 'key' => 'paystack_public', 'value' => '', 'type' => 'text', 'description' => 'Paystack public key'],
            ['group' => 'payment', 'key' => 'paystack_secret', 'value' => '', 'type' => 'text', 'is_encrypted' => true, 'description' => 'Paystack secret key'],
            ['group' => 'payment', 'key' => 'paystack_email', 'value' => 'info@mgtechs.com.ng', 'type' => 'text', 'description' => 'Paystack merchant email'],
            ['group' => 'payment', 'key' => 'paystack_callback', 'value' => '/payment/callback', 'type' => 'text', 'description' => 'Paystack callback URL'],
            ['group' => 'payment', 'key' => 'paystack_enabled', 'value' => 'false', 'type' => 'boolean', 'description' => 'Enable Paystack'],
            
            // Flutterwave
            ['group' => 'payment', 'key' => 'flutterwave_public', 'value' => '', 'type' => 'text', 'description' => 'Flutterwave public key'],
            ['group' => 'payment', 'key' => 'flutterwave_secret', 'value' => '', 'type' => 'text', 'is_encrypted' => true, 'description' => 'Flutterwave secret key'],
            ['group' => 'payment', 'key' => 'flutterwave_encryption', 'value' => '', 'type' => 'text', 'description' => 'Flutterwave encryption key'],
            ['group' => 'payment', 'key' => 'flutterwave_callback', 'value' => '/payment/flutterwave/callback', 'type' => 'text', 'description' => 'Flutterwave callback URL'],
            ['group' => 'payment', 'key' => 'flutterwave_enabled', 'value' => 'false', 'type' => 'boolean', 'description' => 'Enable Flutterwave'],
            
            // Stripe
            ['group' => 'payment', 'key' => 'stripe_public', 'value' => '', 'type' => 'text', 'description' => 'Stripe publishable key'],
            ['group' => 'payment', 'key' => 'stripe_secret', 'value' => '', 'type' => 'text', 'is_encrypted' => true, 'description' => 'Stripe secret key'],
            ['group' => 'payment', 'key' => 'stripe_webhook', 'value' => '', 'type' => 'text', 'description' => 'Stripe webhook secret'],
            ['group' => 'payment', 'key' => 'stripe_currency', 'value' => 'NGN', 'type' => 'text', 'description' => 'Stripe currency'],
            ['group' => 'payment', 'key' => 'stripe_enabled', 'value' => 'false', 'type' => 'boolean', 'description' => 'Enable Stripe'],
            
            // ===== USER MANAGEMENT =====
            ['group' => 'users', 'key' => 'default_role', 'value' => 'student', 'type' => 'text', 'description' => 'Default user role'],
            ['group' => 'users', 'key' => 'registration_status', 'value' => 'open', 'type' => 'text', 'description' => 'Registration status'],
            ['group' => 'users', 'key' => 'email_verification', 'value' => 'true', 'type' => 'boolean', 'description' => 'Require email verification'],
            ['group' => 'users', 'key' => 'admin_approval', 'value' => 'false', 'type' => 'boolean', 'description' => 'Require admin approval'],
            ['group' => 'users', 'key' => 'social_login', 'value' => 'true', 'type' => 'boolean', 'description' => 'Allow social login'],
            ['group' => 'users', 'key' => 'activity_logs', 'value' => 'enabled', 'type' => 'text', 'description' => 'Activity logs status'],
            
            // ===== SEO SETTINGS =====
            ['group' => 'seo', 'key' => 'meta_title', 'value' => 'MGTECHS Limited - Web Development & Digital Solutions', 'type' => 'text', 'description' => 'Default meta title'],
            ['group' => 'seo', 'key' => 'meta_description', 'value' => 'MGTECHS Limited is a registered Nigerian technology company specializing in Web Development, Software, Graphics, Printing, Branding, and IT Consultation.', 'type' => 'textarea', 'description' => 'Default meta description'],
            ['group' => 'seo', 'key' => 'meta_keywords', 'value' => 'MGTECHS, web development Nigeria, software development, graphics design, printing services, branding, IT consultation, LMS, CBT, e-learning Nigeria', 'type' => 'text', 'description' => 'Meta keywords'],
            ['group' => 'seo', 'key' => 'ga_id', 'value' => '', 'type' => 'text', 'description' => 'Google Analytics ID'],
            ['group' => 'seo', 'key' => 'gtm_id', 'value' => '', 'type' => 'text', 'description' => 'Google Tag Manager ID'],
            ['group' => 'seo', 'key' => 'custom_meta', 'value' => '', 'type' => 'textarea', 'description' => 'Custom meta tags'],
            
            // ===== SECURITY SETTINGS =====
            ['group' => 'security', 'key' => 'two_factor_auth', 'value' => 'false', 'type' => 'boolean', 'description' => 'Require 2FA'],
            ['group' => 'security', 'key' => 'force_https', 'value' => 'true', 'type' => 'boolean', 'description' => 'Force HTTPS'],
            ['group' => 'security', 'key' => 'rate_limiting', 'value' => 'true', 'type' => 'boolean', 'description' => 'Enable rate limiting'],
            ['group' => 'security', 'key' => 'cors_protection', 'value' => 'true', 'type' => 'boolean', 'description' => 'Enable CORS protection'],
            ['group' => 'security', 'key' => 'admin_ip_whitelist', 'value' => '', 'type' => 'text', 'description' => 'Allowed admin IPs'],
            ['group' => 'security', 'key' => 'session_timeout', 'value' => '60', 'type' => 'number', 'description' => 'Session timeout in minutes'],
            
            // ===== SOCIAL MEDIA =====
            ['group' => 'social', 'key' => 'facebook_url', 'value' => '', 'type' => 'text', 'description' => 'Facebook URL'],
            ['group' => 'social', 'key' => 'twitter_url', 'value' => '', 'type' => 'text', 'description' => 'Twitter URL'],
            ['group' => 'social', 'key' => 'instagram_url', 'value' => '', 'type' => 'text', 'description' => 'Instagram URL'],
            ['group' => 'social', 'key' => 'linkedin_url', 'value' => '', 'type' => 'text', 'description' => 'LinkedIn URL'],
            ['group' => 'social', 'key' => 'youtube_url', 'value' => '', 'type' => 'text', 'description' => 'YouTube URL'],
            ['group' => 'social', 'key' => 'github_url', 'value' => '', 'type' => 'text', 'description' => 'GitHub URL'],
            ['group' => 'social', 'key' => 'discord_url', 'value' => '', 'type' => 'text', 'description' => 'Discord URL'],
            ['group' => 'social', 'key' => 'whatsapp_url', 'value' => '', 'type' => 'text', 'description' => 'WhatsApp URL'],
            
            // ===== ANALYTICS =====
            ['group' => 'analytics', 'key' => 'ga4_id', 'value' => '', 'type' => 'text', 'description' => 'Google Analytics 4 ID'],
            ['group' => 'analytics', 'key' => 'gtm_id_analytics', 'value' => '', 'type' => 'text', 'description' => 'Google Tag Manager ID'],
            ['group' => 'analytics', 'key' => 'fb_pixel', 'value' => '', 'type' => 'text', 'description' => 'Facebook Pixel ID'],
            ['group' => 'analytics', 'key' => 'linkedin_insight', 'value' => '', 'type' => 'text', 'description' => 'LinkedIn Insight Tag'],
            ['group' => 'analytics', 'key' => 'cookie_consent', 'value' => 'true', 'type' => 'boolean', 'description' => 'Show cookie consent'],
            
            // ===== BACKUP SETTINGS =====
            ['group' => 'backup', 'key' => 'backup_frequency', 'value' => 'daily', 'type' => 'text', 'description' => 'Backup frequency'],
            ['group' => 'backup', 'key' => 'backup_retention', 'value' => '30', 'type' => 'number', 'description' => 'Backup retention in days'],
            ['group' => 'backup', 'key' => 'backup_storage', 'value' => 'local', 'type' => 'text', 'description' => 'Backup storage location'],
            ['group' => 'backup', 'key' => 'max_backups', 'value' => '10', 'type' => 'number', 'description' => 'Maximum backups to keep'],
            ['group' => 'backup', 'key' => 'auto_backup', 'value' => 'true', 'type' => 'boolean', 'description' => 'Enable auto backup'],
            ['group' => 'backup', 'key' => 'backup_files', 'value' => 'true', 'type' => 'boolean', 'description' => 'Include files in backup'],
            
            // ===== LEGAL & COMPLIANCE =====
            ['group' => 'legal', 'key' => 'company_reg', 'value' => 'RC 1234567', 'type' => 'text', 'description' => 'Company registration number'],
            ['group' => 'legal', 'key' => 'tax_id', 'value' => '', 'type' => 'text', 'description' => 'Tax ID / VAT number'],
            ['group' => 'legal', 'key' => 'privacy_policy', 'value' => 'This Privacy Policy describes how MGTECHS Limited collects, uses, and protects your personal information.', 'type' => 'textarea', 'description' => 'Privacy policy text'],
            ['group' => 'legal', 'key' => 'terms_of_service', 'value' => 'These Terms of Service govern your use of our website and services.', 'type' => 'textarea', 'description' => 'Terms of service text'],
            ['group' => 'legal', 'key' => 'cookie_policy', 'value' => 'This Cookie Policy explains how we use cookies and similar technologies.', 'type' => 'textarea', 'description' => 'Cookie policy text'],
            ['group' => 'legal', 'key' => 'force_cookie_consent', 'value' => 'false', 'type' => 'boolean', 'description' => 'Force cookie consent'],
            
            // ===== ADVANCED =====
            ['group' => 'advanced', 'key' => 'php_ini', 'value' => "memory_limit = 256M\nupload_max_filesize = 64M\npost_max_size = 64M\nmax_execution_time = 300", 'type' => 'textarea', 'description' => 'Custom PHP settings'],
            ['group' => 'advanced', 'key' => 'custom_header_scripts', 'value' => '', 'type' => 'textarea', 'description' => 'Custom header scripts'],
            ['group' => 'advanced', 'key' => 'custom_footer_scripts', 'value' => '', 'type' => 'textarea', 'description' => 'Custom footer scripts'],
            ['group' => 'advanced', 'key' => 'enable_api', 'value' => 'true', 'type' => 'boolean', 'description' => 'Enable API'],
            ['group' => 'advanced', 'key' => 'api_rate_limit', 'value' => '60', 'type' => 'number', 'description' => 'API rate limit per minute'],
        ];
        
        foreach ($settings as $setting) {
            DB::table('settings')->insert([
                'group' => $setting['group'],
                'key' => $setting['key'],
                'value' => $setting['value'] ?? null,
                'type' => $setting['type'],
                'is_encrypted' => $setting['is_encrypted'] ?? false,
                'is_public' => $setting['is_public'] ?? false,
                'description' => $setting['description'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
};