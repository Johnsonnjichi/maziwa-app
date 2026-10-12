<?php

namespace App\Http\Controllers;

use App\Models\DailyCloseout;
use App\Models\Expense;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DailyCloseoutController extends Controller
{
    public function create(Request $request)
    {
        $branchId = Auth::user()->branch_id;
        $today = now()->toDateString();

        $totalSales = Sale::where('branch_id', $branchId)
            ->whereDate('created_at', $today)
            ->sum('total_amount');

        $totalExpenses = Expense::where('branch_id', $branchId)
            ->whereDate('expense_date', $today)
            ->sum('amount');

        return Inertia::render('Worker/EndOfDay', [
            'total_sales' => $totalSales,
            'total_expenses' => $totalExpenses,
            'closeout_date' => $today,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'opening_balance' => 'required|numeric|min:0',
            'closeout_date' => 'required|date',
            'total_sales' => 'required|numeric|min:0',
            'cash_on_hand' => 'required|numeric|min:0',
            'total_expenses' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $netCash = $validated['cash_on_hand'] - $validated['total_expenses'];
        $expectedCash = $validated['opening_balance'] + $validated['total_sales'];
        $variance = $netCash - $expectedCash;

        DailyCloseout::create([
            'opening_balance' => $validated['opening_balance'],
            'branch_id' => Auth::user()->branch_id,
            'user_id' => Auth::id(),
            'closeout_date' => $validated['closeout_date'],
            'total_sales' => $validated['total_sales'],
            'cash_on_hand' => $validated['cash_on_hand'],
            'total_expenses' => $validated['total_expenses'],
            'net_cash' => $netCash,
            'expected_cash' => $expectedCash,
            'variance' => $variance,
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Daily closeout recorded successfully!');
    }

    public function show(Request $request)
    {
        $branchId = Auth::user()->branch_id;
        $today = now()->toDateString();

        $closeout = DailyCloseout::where('branch_id', $branchId)
            ->where('closeout_date', $today)
            ->first();

        return Inertia::render('Worker/CloseTheDay', [
            'closeout' => $closeout,
        ]);
    }
}
