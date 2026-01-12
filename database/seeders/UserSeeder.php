<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'Admin',
            ],
            [
                'name' => 'User',
                'email' => 'user@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'User',
            ],
        ];

        foreach ($users as $data) {
            $user = User::updateOrCreate(['email' => $data['email']], ['name' => $data['name'], 'email' => $data['email'], 'password' => $data['password'],]);

            //asign role
            $user->assignRole($data['role']);
        }
    }
}
