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
        // Moderator with all roles
        User::create([
            'name' => 'Moderator Demo',
            'email' => 'moderator@skillbridge.test',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'roles' => ['admin', 'moderator', 'provider', 'seeker', 'org_rep'],
            'bio' => 'Platform moderator with full access to all features.',
            'skills' => ['Web Development', 'Content Moderation', 'Project Management'],
            'portfolio_url' => 'https://github.com/moderator',
            'location' => 'Jakarta, Indonesia',
            'availability' => 'Full-time',
        ]);

        // Regular user
        User::create([
            'name' => 'Regular User',
            'email' => 'user@skillbridge.test',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'roles' => ['provider', 'seeker'],
            'bio' => 'Regular user looking to collaborate on social impact projects.',
            'skills' => ['Graphic Design', 'Social Media'],
            'location' => 'Bandung, Indonesia',
            'availability' => 'Part-time',
        ]);

        $this->command->info('✅ Created 2 demo users (password: password)');
        $this->command->info('   - moderator@skillbridge.test (All roles - Admin, Moderator, Provider, Seeker, Org Rep)');
        $this->command->info('   - user@skillbridge.test (Provider + Seeker)');
    }
}
