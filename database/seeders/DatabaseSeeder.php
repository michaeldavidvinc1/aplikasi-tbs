<?php

namespace Database\Seeders;

use App\Models\HargaTbs;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
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
            'name' => 'Koperasi',
            'email' => 'koperasi@gmail.com',
            'role' => 'KOPERASI',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Pimpinan',
            'email' => 'pimpinan@gmail.com',
            'role' => 'PIMPINAN',
            'password' => Hash::make('password'),
        ]);

        HargaTbs::create([
           'harga_per_kilo' => 1500,
            'berlaku' => Carbon::now()->addDay(7),
        ]);
    }
}
