<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Branch::truncate();

        Branch::create([
            'name' => 'Main Branch',
            'location' => '123 Milk Street, Nairobi',
            'phone' => '+254 700 123 456',
            'manager_name' => 'John Manager',
            'is_active' => true,
        ]);

        Branch::create([
            'name' => 'West Branch',
            'location' => '456 Dairy Avenue, Nairobi',
            'phone' => '+254 700 789 012',
            'manager_name' => 'Jane Manager',
            'is_active' => true,
        ]);

        Branch::create([
            'name' => 'East Branch',
            'location' => '789 Cream Road, Nairobi',
            'phone' => '+254 700 345 678',
            'manager_name' => 'Bob Manager',
            'is_active' => true,
        ]);
    }
}
