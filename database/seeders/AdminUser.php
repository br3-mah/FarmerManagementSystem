<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin user already exists
        $adminEmail = 'admin@gna.com';
        $adminExists = User::where('email', $adminEmail)->first();

        if (!$adminExists) {
            User::create([
                'fname' => 'Staff',
                'lname' => 'Admin',
                'email' => $adminEmail,
                'password' => Hash::make('password123'), // Replace with a strong password
            ]);

            $this->command->info('Admin user created successfully.');
        } else {
            $this->command->info('Admin user already exists.');
        }
    }
}
