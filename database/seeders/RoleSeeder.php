<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // ============================================
        // 1. ADMIN USERS
        // ============================================
        $admins = [
            [
                'name' => 'Super Admin',
                'email' => 'admin@mgtechs.com.ng',
                'phone' => '08012345678',
                'role' => 'admin',
                'avatar' => 'https://ui-avatars.com/api/?name=Super+Admin&background=4F46E5&color=fff&size=128',
            ],
            [
                'name' => 'Maxwell Ephraim Halilu',
                'email' => 'maxwell@mgtechs.com.ng',
                'phone' => '08098765432',
                'role' => 'admin',
                'avatar' => 'https://ui-avatars.com/api/?name=Maxwell+Ephraim+Halilu&background=7C3AED&color=fff&size=128',
            ],
            [
                'name' => 'Admin Staff',
                'email' => 'staff@mgtechs.com.ng',
                'phone' => '08023456789',
                'role' => 'admin',
                'avatar' => 'https://ui-avatars.com/api/?name=Admin+Staff&background=6D28D9&color=fff&size=128',
            ],
        ];

        foreach ($admins as $admin) {
            if (!User::where('email', $admin['email'])->exists()) {
                User::create([
                    'name' => $admin['name'],
                    'email' => $admin['email'],
                    'password' => Hash::make('password'),
                    'phone' => $admin['phone'],
                    'role' => $admin['role'],
                    'avatar' => $admin['avatar'],
                    'is_active' => true,
                    'email_verified_at' => now(),
                ]);
                $this->command->info("✅ Admin created: {$admin['email']}");
            }
        }

        // ============================================
        // 2. CLIENT USERS
        // ============================================
        $clients = [
            [
                'name' => 'Adeola Consulting Ltd',
                'email' => 'adeola@client.com',
                'phone' => '08023456789',
                'company' => 'Adeola Consulting Ltd',
            ],
            [
                'name' => 'Chidi Eze',
                'email' => 'chidi@client.com',
                'phone' => '08034567890',
                'company' => 'Eze Enterprises',
            ],
            [
                'name' => 'Folake Adeyemi',
                'email' => 'folake@client.com',
                'phone' => '08045678901',
                'company' => 'Adeyemi Holdings',
            ],
            [
                'name' => 'Babatunde Ola',
                'email' => 'tunde@client.com',
                'phone' => '08056789012',
                'company' => 'Ola Industries',
            ],
            [
                'name' => 'Ngozi Okonkwo',
                'email' => 'ngozi@client.com',
                'phone' => '08067890123',
                'company' => 'Okonkwo Global',
            ],
            [
                'name' => 'Emeka Nwosu',
                'email' => 'emeka@client.com',
                'phone' => '08078901234',
                'company' => 'Nwosu Tech Solutions',
            ],
            [
                'name' => 'Fatima Bello',
                'email' => 'fatima@client.com',
                'phone' => '08089012345',
                'company' => 'Bello Group',
            ],
            [
                'name' => 'Yusuf Aliyu',
                'email' => 'yusuf@client.com',
                'phone' => '08090123456',
                'company' => 'Aliyu & Sons',
            ],
            [
                'name' => 'Grace Okafor',
                'email' => 'graceclient@client.com',
                'phone' => '08101234567',
                'company' => 'Okafor Ventures',
            ],
            [
                'name' => 'Peter Obi',
                'email' => 'peterclient@client.com',
                'phone' => '08112345678',
                'company' => 'Obi Enterprises',
            ],
        ];

        foreach ($clients as $client) {
            if (!User::where('email', $client['email'])->exists()) {
                User::create([
                    'name' => $client['name'],
                    'email' => $client['email'],
                    'password' => Hash::make('password'),
                    'phone' => $client['phone'],
                    'role' => 'client',
                    'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($client['name']) . '&background=10B981&color=fff&size=128',
                    'is_active' => true,
                    'email_verified_at' => now(),
                ]);
                $this->command->info("✅ Client created: {$client['email']}");
            }
        }

        // ============================================
        // 3. STUDENT USERS
        // ============================================
        $students = [
            // Primary Test Students
            [
                'name' => 'Ahmed Bello',
                'email' => 'ahmed@student.com',
                'phone' => '08078901234',
            ],
            [
                'name' => 'Grace Okafor',
                'email' => 'grace@student.com',
                'phone' => '08089012345',
            ],
            [
                'name' => 'Samuel Johnson',
                'email' => 'samuel@student.com',
                'phone' => '08090123456',
            ],
            [
                'name' => 'Joy Eze',
                'email' => 'joy@student.com',
                'phone' => '08101234567',
            ],
            [
                'name' => 'Peter Obi',
                'email' => 'peter@student.com',
                'phone' => '08112345678',
            ],
            
            // Additional Students
            [
                'name' => 'Chioma Nwachukwu',
                'email' => 'chioma@student.com',
                'phone' => '08123456789',
            ],
            [
                'name' => 'David Adebayo',
                'email' => 'david@student.com',
                'phone' => '08134567890',
            ],
            [
                'name' => 'Esther Akpan',
                'email' => 'esther@student.com',
                'phone' => '08145678901',
            ],
            [
                'name' => 'Michael Ogunlade',
                'email' => 'michael@student.com',
                'phone' => '08156789012',
            ],
            [
                'name' => 'Sarah Ibrahim',
                'email' => 'sarah@student.com',
                'phone' => '08167890123',
            ],
            [
                'name' => 'Victor Adeyemi',
                'email' => 'victor@student.com',
                'phone' => '08178901234',
            ],
            [
                'name' => 'Mercy Okonkwo',
                'email' => 'mercy@student.com',
                'phone' => '08189012345',
            ],
            [
                'name' => 'Daniel Eze',
                'email' => 'daniel@student.com',
                'phone' => '08190123456',
            ],
            [
                'name' => 'Blessing Okafor',
                'email' => 'blessing@student.com',
                'phone' => '08201234567',
            ],
            [
                'name' => 'Emeka Nwosu',
                'email' => 'emekastudent@student.com',
                'phone' => '08212345678',
            ],
            [
                'name' => 'Fatima Bello',
                'email' => 'fatimastudent@student.com',
                'phone' => '08223456789',
            ],
            [
                'name' => 'Joseph Aliyu',
                'email' => 'joseph@student.com',
                'phone' => '08234567890',
            ],
            [
                'name' => 'Maryam Abubakar',
                'email' => 'maryam@student.com',
                'phone' => '08245678901',
            ],
            [
                'name' => 'Chinedu Okafor',
                'email' => 'chinedu@student.com',
                'phone' => '08256789012',
            ],
            [
                'name' => 'Aisha Bello',
                'email' => 'aisha@student.com',
                'phone' => '08267890123',
            ],
        ];

        foreach ($students as $student) {
            if (!User::where('email', $student['email'])->exists()) {
                User::create([
                    'name' => $student['name'],
                    'email' => $student['email'],
                    'password' => Hash::make('password'),
                    'phone' => $student['phone'],
                    'role' => 'student',
                    'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($student['name']) . '&background=3B82F6&color=fff&size=128',
                    'is_active' => true,
                    'email_verified_at' => now(),
                ]);
                $this->command->info("✅ Student created: {$student['email']}");
            }
        }

        // ============================================
        // 4. INACTIVE/UNVERIFIED USERS (For Testing)
        // ============================================
        $inactiveUsers = [
            [
                'name' => 'Inactive User',
                'email' => 'inactive@test.com',
                'role' => 'student',
                'is_active' => false,
            ],
            [
                'name' => 'Unverified User',
                'email' => 'unverified@test.com',
                'role' => 'client',
                'is_active' => true,
                'email_verified_at' => null,
            ],
        ];

        foreach ($inactiveUsers as $user) {
            if (!User::where('email', $user['email'])->exists()) {
                User::create([
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => Hash::make('password'),
                    'phone' => '080' . rand(10000000, 99999999),
                    'role' => $user['role'],
                    'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($user['name']) . '&background=6B7280&color=fff&size=128',
                    'is_active' => $user['is_active'],
                    'email_verified_at' => $user['email_verified_at'] ?? now(),
                ]);
                $this->command->info("✅ Test user created: {$user['email']} (inactive: " . ($user['is_active'] ? 'No' : 'Yes') . ")");
            }
        }

        // ============================================
        // Summary
        // ============================================
        $this->command->newLine();
        $this->command->info('✅ ==========================================');
        $this->command->info('✅ All test users created successfully!');
        $this->command->info('✅ ==========================================');
        $this->command->newLine();
        
        $this->command->info('📋 Admin Credentials:');
        $this->command->info('  🔑 admin@mgtechs.com.ng / password');
        $this->command->info('  🔑 maxwell@mgtechs.com.ng / password');
        $this->command->info('  🔑 staff@mgtechs.com.ng / password');
        $this->command->newLine();
        
        $this->command->info('📋 Client Credentials:');
        $this->command->info('  🔑 adeola@client.com / password');
        $this->command->info('  🔑 chidi@client.com / password');
        $this->command->info('  🔑 folake@client.com / password');
        $this->command->newLine();
        
        $this->command->info('📋 Student Credentials:');
        $this->command->info('  🔑 ahmed@student.com / password');
        $this->command->info('  🔑 grace@student.com / password');
        $this->command->info('  🔑 samuel@student.com / password');
        $this->command->info('  🔑 joy@student.com / password');
        $this->command->info('  🔑 peter@student.com / password');
        $this->command->newLine();
        
        $this->command->info('📊 Summary:');
        $this->command->info('  👑 Admins: ' . User::where('role', 'admin')->count());
        $this->command->info('  🤝 Clients: ' . User::where('role', 'client')->count());
        $this->command->info('  🎓 Students: ' . User::where('role', 'student')->count());
        $this->command->info('  📦 Total Users: ' . User::count());
        $this->command->newLine();
        
        $this->command->info('💡 Tip: All users have the password: "password"');
        $this->command->info('🚀 Visit /login to start testing!');
    }
}