<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'ADMIN',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Petani',
            'email' => 'petani@gmail.com',
            'role' => 'PETANI',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Pabrik',
            'email' => 'pabrik@gmail.com',
            'role' => 'PABRIK',
            'password' => Hash::make('password'),
        ]);
    }
}
