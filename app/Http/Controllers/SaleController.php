<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SaleController extends Controller
{
    public function create(Request $request)
    {
        $products = Product::where('is_active', true)->get(['id', 'name', 'price', 'unit']);

        return Inertia::render('Worker/RecordSale', [
            'products' => $products,
        ]);
    }

    public function dashboard()
    {
        $sales = Sale::with(['user', 'saleItems.product'])
            ->latest()
            ->limit(10)
            ->get()
            ->map(function (Sale $sale) {
                return [
                    'id' => $sale->id,
                    'user' => $sale->user?->name ?? 'Unknown user',
                    'payment_method' => ucfirst($sale->payment_method),
                    'total_amount' => (float) $sale->total_amount,
                    'cash_received' => (float) $sale->cash_received,
                    'change_given' => (float) $sale->change_given,
                    'created_at' => $sale->created_at?->format('Y-m-d H:i:s'),
                    'items' => $sale->saleItems->map(function ($item) {
                        return [
                            'product' => $item->product?->name ?? 'Product deleted',
                            'quantity' => (int) $item->quantity,
                            'subtotal' => (float) $item->subtotal,
                        ];
                    })->all(),
                ];
            });

        $totalRevenue = (float) Sale::sum('total_amount');
        $averageOrder = Sale::count() > 0 ? $totalRevenue / Sale::count() : 0;
        $unitsSold = SaleItem::sum('quantity');

        return Inertia::render('Manager/SalesOverview', [
            'sales' => $sales,
            'summary' => [
                'total_sales' => Sale::count(),
                'total_revenue' => $totalRevenue,
                'average_order' => $averageOrder,
                'units_sold' => $unitsSold,
            ],
        ]);
    }

    public function saleItemsDashboard()
    {
        $items = SaleItem::with('product')
            ->get()
            ->groupBy('product_id')
            ->map(function ($entries, $productId) {
                $product = $entries->first()->product;
                $quantity = $entries->sum('quantity');

                return [
                    'product_id' => (int) $productId,
                    'name' => $product?->name ?? 'Unknown product',
                    'sku' => $product?->sku ?? 'N/A',
                    'quantity' => (int) $quantity,
                    'revenue' => (float) $entries->sum('subtotal'),
                ];
            })
            ->sortByDesc('revenue')
            ->values()
            ->all();

        return Inertia::render('Manager/SaleItemsDashboard', [
            'items' => $items,
            'summary' => [
                'items_sold' => SaleItem::sum('quantity'),
                'top_product' => ! empty($items) ? $items[0]['name'] : 'No sales yet',
                'total_revenue' => (float) SaleItem::sum('subtotal'),
            ],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'cash_received' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,mobile,bank',
            'notes' => 'nullable|string',
        ]);

        $totalAmount = 0;
        $saleItems = [];

        foreach ($validated['items'] as $item) {
            $product = Product::findOrFail($item['product_id']);
            $subtotal = $product->price * $item['quantity'];
            $totalAmount += $subtotal;

            $saleItems[] = [
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $product->price,
                'subtotal' => $subtotal,
            ];
        }

        $changeGiven = max(0, $validated['cash_received'] - $totalAmount);

        $sale = Sale::create([
            'branch_id' => Auth::user()->branch_id,
            'user_id' => Auth::id(),
            'total_amount' => $totalAmount,
            'cash_received' => $validated['cash_received'],
            'change_given' => $changeGiven,
            'payment_method' => $validated['payment_method'],
            'notes' => $validated['notes'] ?? null,
        ]);

        foreach ($saleItems as $item) {
            $sale->saleItems()->create($item);
        }

        return redirect()->back()->with('success', 'Sale recorded successfully!');
    }
}
