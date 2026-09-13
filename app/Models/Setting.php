<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'group',
        'key',
        'value',
        'type',
        'is_encrypted',
        'is_public',
        'description',
        'options',
        'sort_order',
    ];

    protected $casts = [
        'is_encrypted' => 'boolean',
        'is_public' => 'boolean',
        'options' => 'array',
    ];

    protected $attributes = [
        'is_encrypted' => false,
        'is_public' => false,
    ];

    public static function get($key, $default = null)
    {
        $settings = static::getAllSettings();
        return $settings[$key] ?? $default;
    }

    public static function getAllSettings()
    {
        return Cache::remember('settings.all', 3600, function () {
            try {
                $settings = self::all();
                $result = [];
                foreach ($settings as $setting) {
                    $result[$setting->key] = self::castValue($setting);
                }
                return $result;
            } catch (\Exception $e) {
                return [];
            }
        });
    }

    public static function getGroup($group)
    {
        try {
            $settings = self::where('group', $group)->get();
            $result = [];
            foreach ($settings as $setting) {
                $result[$setting->key] = self::castValue($setting);
            }
            return $result;
        } catch (\Exception $e) {
            return [];
        }
    }

    public static function set($key, $value, $group = 'general')
    {
        try {
            $setting = self::where('key', $key)->first();
            if ($setting) {
                if ($setting->is_encrypted && filled($value)) {
                    $value = encrypt($value);
                }

                if ($setting->is_encrypted && blank($value)) {
                    return true;
                }

                $setting->value = $value;
                $setting->save();
            } else {
                self::create([
                    'key' => $key,
                    'value' => $value,
                    'group' => $group,
                    'type' => 'text',
                ]);
            }
            Cache::forget('settings.all');
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function updateSettings(array $settings)
    {
        try {
            foreach ($settings as $key => $value) {
                self::set($key, $value);
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function clearCache()
    {
        Cache::forget('settings.all');
        return true;
    }

    protected static function boot()
    {
        parent::boot();
        static::saved(function () {
            Cache::forget('settings.all');
        });
        static::deleted(function () {
            Cache::forget('settings.all');
        });
    }

    private static function castValue(self $setting)
    {
        $value = $setting->value;

        if ($setting->is_encrypted && $value) {
            try {
                $value = decrypt($value);
            } catch (\Exception $e) {
                return null;
            }
        }

        if ($setting->type === 'boolean') {
            return filter_var($value, FILTER_VALIDATE_BOOLEAN);
        }

        if ($setting->type === 'number' && is_numeric($value)) {
            return (float) $value;
        }

        return $value;
    }
}