<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@skillbridge.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'roles' => ['admin'],
            'is_admin' => true, // Ensure legacy flag is set just in case
            'bio' => 'System Administrator',
            'location' => 'HQ',
        ]);

        // 2. Moderator
        User::create([
            'name' => 'Moderator User',
            'email' => 'moderator@skillbridge.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'roles' => ['moderator'],
            'is_moderator' => true,
            'bio' => 'Community Moderator',
            'location' => 'Remote',
        ]);

        // 3. Provider
        User::create([
            'name' => 'Provider User',
            'email' => 'provider@skillbridge.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'roles' => ['provider'],
            'bio' => 'Professional Web Developer offering skills.',
            'skills' => ['Laravel', 'Vue.js', 'Tailwind CSS'],
            'location' => 'Jakarta',
        ]);

        // 4. Seeker
        User::create([
            'name' => 'Seeker User',
            'email' => 'seeker@skillbridge.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'roles' => ['seeker'],
            'bio' => 'Non-profit organization looking for talent.',
            'location' => 'Bali',
        ]);

        $this->command->info('✅ Created 4 demo users (password: password)');
        $this->command->info('   - admin@skillbridge.com (Role: Admin)');
        $this->command->info('   - moderator@skillbridge.com (Role: Moderator)');
        $this->command->info('   - provider@skillbridge.com (Role: Provider)');
        $this->command->info('   - seeker@skillbridge.com (Role: Seeker)');
    }
}
