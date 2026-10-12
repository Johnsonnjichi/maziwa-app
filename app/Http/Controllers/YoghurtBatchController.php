<?php

namespace App\Http\Controllers;

use App\Models\YoghurtBatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class YoghurtBatchController extends Controller
{
    public function create(Request $request)
    {
        return Inertia::render('Kitchen/MakeYoghurt');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'milk_quantity_liters' => 'required|numeric|min:0',
            'flavor' => 'nullable|string|max:255',
            'production_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $batchNumber = 'BATCH-'.date('Ymd').'-'.str_pad(YoghurtBatch::count() + 1, 4, '0', STR_PAD_LEFT);

        YoghurtBatch::create([
            'user_id' => Auth::id(),
            'batch_number' => $batchNumber,
            'milk_quantity_liters' => $validated['milk_quantity_liters'],
            'flavor' => $validated['flavor'] ?? null,
            'status' => 'preparing',
            'production_date' => $validated['production_date'],
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Yoghurt batch created successfully!');
    }
}
