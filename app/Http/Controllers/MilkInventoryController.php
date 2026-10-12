<?php

namespace App\Http\Controllers;

use App\Models\MilkInventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MilkInventoryController extends Controller
{
    public function create(Request $request)
    {
        return Inertia::render('Worker/MilkReceived');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'quantity_liters' => 'required|numeric|min:0',
            'fat_percentage' => 'nullable|numeric|min:0|max:100',
            'source' => 'nullable|string|max:255',
            'received_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        MilkInventory::create([
            'branch_id' => Auth::user()->branch_id,
            'user_id' => Auth::id(),
            'quantity_liters' => $validated['quantity_liters'],
            'fat_percentage' => $validated['fat_percentage'] ?? null,
            'source' => $validated['source'] ?? null,
            'received_date' => $validated['received_date'],
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Milk inventory recorded successfully!');
    }
}
