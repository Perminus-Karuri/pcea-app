<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;


class Adminseeder extends Seeder
{
    /**
     * Run the database seeds.
     * Admin seeder for creating the admin
     */
    public function run(): void
    {
        User::create([
            'name' => 'System Admin',
            'email' => 'admin@church.com',
            'phone' => null,
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);
    }
}
