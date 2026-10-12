<?php

use App\Http\Controllers\AdminPermissionController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DailyCloseoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\MilkInventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockTransferController;
use App\Http\Controllers\WastageController;
use App\Http\Controllers\YoghurtBatchController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return Inertia::render('Welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware(['permission:record_sales'])->group(function () {
        Route::get('/sales-dashboard', [SaleController::class, 'dashboard'])->name('sales.dashboard');
        Route::get('/sale-items-dashboard', [SaleController::class, 'saleItemsDashboard'])->name('sale-items.dashboard');
    });

    // Manager routes
    Route::middleware(['permission:view_branches'])->prefix('manager')->name('manager.')->group(function () {
        Route::get('/branches', [BranchController::class, 'index'])->name('branches');
    });

    Route::middleware(['permission:view_branch_details'])->prefix('manager')->name('manager.')->group(function () {
        Route::get('/branches/{branch}', [BranchController::class, 'show'])->name('branches.show');
    });

    Route::middleware(['permission:manage_items_prices'])->prefix('manager')->name('manager.')->group(function () {
        Route::get('/items-prices', [ProductController::class, 'index'])->name('items-prices');
    });

    Route::middleware(['permission:manage_permissions'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/permissions', [AdminPermissionController::class, 'index'])->name('permissions');
        Route::post('/permissions', [AdminPermissionController::class, 'update'])->name('permissions.update');
    });

    // Worker routes
    Route::middleware(['permission:record_sales'])->prefix('worker')->name('worker.')->group(function () {
        Route::get('/record-sale', [SaleController::class, 'create'])->name('record-sale');
        Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');
    });

    Route::middleware(['permission:add_milk_inventory'])->prefix('worker')->name('worker.')->group(function () {
        Route::get('/milk-received', [MilkInventoryController::class, 'create'])->name('milk-received');
        Route::post('/milk-inventory', [MilkInventoryController::class, 'store'])->name('milk-inventory.store');
    });

    Route::middleware(['permission:add_expenses'])->prefix('worker')->name('worker.')->group(function () {
        Route::get('/add-expense', [ExpenseController::class, 'create'])->name('add-expense');
        Route::post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');
    });

    Route::middleware(['permission:record_wastage'])->prefix('worker')->name('worker.')->group(function () {
        Route::get('/wastage', [WastageController::class, 'create'])->name('wastage');
        Route::post('/wastages', [WastageController::class, 'store'])->name('wastages.store');
    });

    Route::middleware(['permission:end_of_day'])->prefix('worker')->name('worker.')->group(function () {
        Route::get('/end-of-day', [DailyCloseoutController::class, 'create'])->name('end-of-day');
        Route::post('/daily-closeouts', [DailyCloseoutController::class, 'store'])->name('daily-closeouts.store');
        Route::get('/close-the-day', [DailyCloseoutController::class, 'show'])->name('close-the-day');
    });

    // Kitchen routes
    Route::middleware(['permission:make_yoghurt'])->prefix('kitchen')->name('kitchen.')->group(function () {
        Route::get('/make-yoghurt', [YoghurtBatchController::class, 'create'])->name('make-yoghurt');
        Route::post('/yoghurt-batches', [YoghurtBatchController::class, 'store'])->name('yoghurt-batches.store');
    });

    Route::middleware(['permission:send_stock'])->prefix('kitchen')->name('kitchen.')->group(function () {
        Route::get('/send-stock', [StockTransferController::class, 'create'])->name('send-stock');
        Route::post('/stock-transfers', [StockTransferController::class, 'store'])->name('stock-transfers.store');
    });

    // Branch routes
    Route::middleware(['permission:confirm_arrival'])->prefix('branch')->name('branch.')->group(function () {
        Route::get('/confirm-arrival/{stockTransfer}', [StockTransferController::class, 'confirm'])->name('confirm-arrival');
        Route::post('/stock-transfers/{stockTransfer}/confirm', [StockTransferController::class, 'update'])->name('stock-transfers.confirm');
    });
});

require __DIR__.'/settings.php';
