<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Expense;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class BranchController extends Controller
{
    public function index(Request $request)
    {
        Log::info('Fetching all branches for manager dashboard');

        $branches = Branch::with(['sales' => function ($query) {
            $query->whereDate('created_at', '>=', now()->subDays(7));
        }])->get();

        $branchStats = $branches->map(function ($branch) {
            $totalSales = $branch->sales->sum('total_amount');
            $totalTransactions = $branch->sales->count();

            return [
                'id' => $branch->id,
                'name' => $branch->name,
                'location' => $branch->location,
                'manager_name' => $branch->manager_name,
                'is_active' => $branch->is_active,
                'total_sales' => $totalSales,
                'total_transactions' => $totalTransactions,
            ];
        });

        return Inertia::render('Manager/AllBranches', [
            'branches' => $branchStats,
        ]);
    }

    public function show(Request $request, Branch $branch)
    {
        Log::info("Fetching branch details for branch ID: {$branch->id}");

        $branch->load(['sales' => function ($query) {
            $query->whereDate('created_at', '>=', now()->subDays(30))->latest()->take(10);
        }]);

        $recentSales = $branch->sales->map(function ($sale) {
            return [
                'id' => $sale->id,
                'total_amount' => $sale->total_amount,
                'created_at' => $sale->created_at->format('Y-m-d H:i'),
                'user_name' => $sale->user->name ?? 'N/A',
            ];
        });

        $todaySales = Sale::where('branch_id', $branch->id)
            ->whereDate('created_at', today())
            ->sum('total_amount');

        $todayExpenses = Expense::where('branch_id', $branch->id)
            ->whereDate('expense_date', today())
            ->sum('amount');

        $monthlySales = Sale::where('branch_id', $branch->id)
            ->whereDate('created_at', '>=', now()->startOfMonth())
            ->sum('total_amount');

        return Inertia::render('Manager/BranchDetails', [
            'branch' => [
                'id' => $branch->id,
                'name' => $branch->name,
                'location' => $branch->location,
                'phone' => $branch->phone,
                'manager_name' => $branch->manager_name,
                'is_active' => $branch->is_active,
            ],
            'recent_sales' => $recentSales,
            'today_sales' => $todaySales,
            'today_expenses' => $todayExpenses,
            'monthly_sales' => $monthlySales,
        ]);
    }
}
