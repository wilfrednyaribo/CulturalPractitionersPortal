<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\County;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Make sure a county exists first (needed for the foreign key)
        $county = County::firstOrCreate(
            ['code' => 'NBI'],
            ['name' => 'Nairobi City', 'is_active' => true]
        );

        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('Password'),
                'role' => 'super_admin',
                'county_id' => $county->id,
                'sub_county_id' => null,
                'phone_number' => '0700000000',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Super admin created: admin@admin.com / Password');
    }
}