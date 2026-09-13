<?php

namespace Tests\Feature;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_settings_update_persists_unchecked_security_toggles(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->post(route('admin.settings.update'), [
                'tab' => 'security',
                'session_timeout' => 45,
                'admin_ip_whitelist' => '',
            ])
            ->assertRedirect();

        $this->assertSame(45.0, Setting::get('session_timeout'));
        $this->assertFalse(Setting::get('two_factor_auth'));
        $this->assertFalse(Setting::get('force_https'));
        $this->assertFalse(Setting::get('rate_limiting'));
        $this->assertFalse(Setting::get('cors_protection'));
    }

    public function test_non_admin_cannot_update_settings(): void
    {
        $this->actingAs(User::factory()->client()->create())
            ->post(route('admin.settings.update'), ['tab' => 'general'])
            ->assertForbidden();
    }

    public function test_admin_can_upload_branding_assets_even_when_file_settings_are_missing(): void
    {
        Storage::fake('public');

        $admin = User::factory()->admin()->create();
        Setting::whereIn('key', ['logo', 'favicon'])->delete();

        $this->actingAs($admin)
            ->post(route('admin.settings.update'), [
                'tab' => 'branding',
                'primary_color' => '#111827',
                'secondary_color' => '#2563EB',
                'accent_color' => '#06B6D4',
                'bg_color' => '#0F172A',
                'logo' => UploadedFile::fake()->image('logo.png', 200, 60),
                'favicon' => UploadedFile::fake()->image('favicon.png', 32, 32),
            ])
            ->assertRedirect();

        $logo = Setting::get('logo');
        $favicon = Setting::get('favicon');

        $this->assertNotEmpty($logo);
        $this->assertNotEmpty($favicon);
        $this->assertStringStartsWith('settings/logo/', $logo);
        $this->assertStringStartsWith('settings/favicon/', $favicon);
        Storage::disk('public')->assertExists($logo);
        Storage::disk('public')->assertExists($favicon);
    }
}
