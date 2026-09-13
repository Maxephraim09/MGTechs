<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        // Settings are already seeded in the migration
        // This seeder can be used to add additional settings or reset defaults
        
        $this->command->info('✅ Settings already seeded in migration.');
    }
}