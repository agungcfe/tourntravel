<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(['email' => 'admin@tourntravel.test'], [
            'name' => 'Administrator',
            'password' => 'password',
            'role' => User::ROLE_ADMIN,
            'is_active' => true,
        ]);

        User::updateOrCreate(['email' => 'editor@tourntravel.test'], [
            'name' => 'Editor Konten',
            'password' => 'password',
            'role' => User::ROLE_EDITOR,
            'is_active' => true,
        ]);
    }
}
