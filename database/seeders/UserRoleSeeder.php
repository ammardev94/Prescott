<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Profile;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        $rolesData = [
            ['name' => 'Admin',   'code' => 'admin'],
            ['name' => 'User',   'code' => 'user'],
        ];

        foreach ($rolesData as $role) {
            Role::firstOrCreate(
                ['code' => $role['code']],
                ['name' => $role['name'], 'created_at' => Carbon::now()]
            );
        }

        $usersData = [
            ['name' => 'Admin',   'email' => 'admin@example.com',   'password' => 'admin123'],
            ['name' => 'User',  'email' => 'userOne@example.com',  'password' => 'admin123'],
        ];

        foreach ($usersData as $userData) {

            $roleCode = strtolower(explode(' ', $userData['name'])[0]);
            $role = Role::where('code', $roleCode)->first();
            
            User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name'       => $userData['name'],
                    'role_id'       => $role->id,
                    'password'   => Hash::make($userData['password']),
                    'created_at' => Carbon::now(),
                ]
            );

        }
    }
}

