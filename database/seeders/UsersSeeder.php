<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'email' => 'admin@example.com',
            'username' => 'Admin BGTK NTT',
            'role' => 'admin',
            'password' => 'admin123',
        ]);

        User::factory()->create([
            'email' => 'operator@example.com',
            'username' => 'Operator',
            'role' => 'operator',
            'password' => 'operator123',
        ]);

        // // Also seed users that appear in the old berita dump
        // foreach (['adminweb', 'devlp'] as $username) {
        //     User::firstOrCreate(
        //         ['username' => $username],
        //         [
        //             'email'    => $username . '@example.com',
        //             'role'     => 'operator',
        //             'password' => 'password',
        //         ]
        //     );
        // }

        $this->call(BeritaSeeder::class);
    }
}
