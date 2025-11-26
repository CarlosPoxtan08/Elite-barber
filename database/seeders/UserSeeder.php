<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@demo.com',
                'password' => 'password',
                'role' => 'admin',
            ],
            [
                'name' => 'Staff User',
                'email' => 'staff@demo.com',
                'password' => 'password',
                'role' => 'staff',
            ],
            [
                'name' => 'Client User',
                'email' => 'client@demo.com',
                'password' => 'password',
                'role' => 'client',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make($userData['password']),
                    'email_verified_at' => now(),
                ]
            );

            if (!$user->hasRole($userData['role'])) {
                $user->assignRole($userData['role']);
            }
        }
    }
}
