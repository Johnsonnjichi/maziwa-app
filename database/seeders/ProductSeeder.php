<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::truncate();

        Product::create([
            'name' => 'Whole Milk',
            'sku' => 'MILK-1001',
            'price' => 120.00,
            'unit' => 'liters',
            'category' => 'milk',
            'description' => 'Fresh whole milk from local farms',
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'Skimmed Milk',
            'sku' => 'MILK-1002',
            'price' => 100.00,
            'unit' => 'liters',
            'category' => 'milk',
            'description' => 'Low-fat skimmed milk',
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'Yoghurt Plain',
            'sku' => 'YOGH-2001',
            'price' => 150.00,
            'unit' => 'liters',
            'category' => 'yoghurt',
            'description' => 'Plain natural yoghurt',
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'Yoghurt Strawberry',
            'sku' => 'YOGH-2002',
            'price' => 180.00,
            'unit' => 'liters',
            'category' => 'yoghurt',
            'description' => 'Strawberry flavored yoghurt',
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'Yoghurt Vanilla',
            'sku' => 'YOGH-2003',
            'price' => 175.00,
            'unit' => 'liters',
            'category' => 'yoghurt',
            'description' => 'Vanilla flavored yoghurt',
            'is_active' => true,
        ]);
    }
}
