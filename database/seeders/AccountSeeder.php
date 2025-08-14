<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Account;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    public function run(): void
    {
       User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com', // <--- Custom email di sini
            'password' => Hash::make('password'), // Jangan lupa hash password!
        ]);

    }
}
