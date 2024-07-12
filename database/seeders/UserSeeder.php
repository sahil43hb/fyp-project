<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 9; $i++) {
            User::create([
                'name' => "User $i",
                'email' => $i == 1 ? "footcase@admin.com" : "user$i@gmail.com",
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'role' => $i == 1 ? 'admin' : 'user',
                'username' => "user$i",
            ]);
        }

    }
}
