<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wastage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class WastageController extends Controller
{
    public function create(Request $request)
    {
        $products = Product::where('is_active', true)->get(['id', 'name', 'unit']);

        return Inertia::render('Worker/Wastage', [
            'products' => $products,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'reason' => 'required|string|max:255',
            'waste_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        Wastage::create([
            'branch_id' => Auth::user()->branch_id,
            'product_id' => $validated['product_id'],
            'user_id' => Auth::id(),
            'quantity' => $validated['quantity'],
            'reason' => $validated['reason'],
            'waste_date' => $validated['waste_date'],
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Wastage recorded successfully!');
    }
}
