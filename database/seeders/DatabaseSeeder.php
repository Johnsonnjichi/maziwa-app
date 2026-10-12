<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::truncate();

        $this->call([
            BranchSeeder::class,
            ProductSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@peda.com',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Manager User',
            'email' => 'manager@peda.com',
            'role' => 'manager',
            'branch_id' => 1,
        ]);

        User::factory()->create([
            'name' => 'Worker User',
            'email' => 'worker@peda.com',
            'role' => 'worker',
            'branch_id' => 1,
        ]);


    }
}
