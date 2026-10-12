<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Product;
use App\Models\StockTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class StockTransferController extends Controller
{
    public function create(Request $request)
    {
        $branches = Branch::where('is_active', true)->get(['id', 'name']);
        $products = Product::where('is_active', true)->get(['id', 'name', 'unit']);

        return Inertia::render('Kitchen/SendStock', [
            'branches' => $branches,
            'products' => $products,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'to_branch_id' => 'required|exists:branches,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'transfer_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        StockTransfer::create([
            'from_branch_id' => Auth::user()->branch_id,
            'to_branch_id' => $validated['to_branch_id'],
            'product_id' => $validated['product_id'],
            'user_id' => Auth::id(),
            'quantity' => $validated['quantity'],
            'status' => 'pending',
            'transfer_date' => $validated['transfer_date'],
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Stock transfer created successfully!');
    }

    public function confirm(Request $request, StockTransfer $stockTransfer)
    {
        return Inertia::render('Branch/ConfirmArrival', [
            'stockTransfer' => $stockTransfer->load(['product', 'fromBranch', 'user']),
        ]);
    }

    public function update(Request $request, StockTransfer $stockTransfer)
    {
        $stockTransfer->update([
            'status' => 'confirmed',
            'confirmed_date' => now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Stock confirmed successfully!');
    }
}
