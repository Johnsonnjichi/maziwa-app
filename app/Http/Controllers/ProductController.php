<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::where('is_active', true)->get();

        return Inertia::render('Manager/ItemsAndPrices', [
            'products' => $products,
        ]);
    }
}
