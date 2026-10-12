<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyCloseout extends Model
{
    protected $fillable = [
        'opening_balance',
        'branch_id',
        'user_id',
        'closeout_date',
        'total_sales',
        'cash_on_hand',
        'total_expenses',
        'net_cash',
        'expected_cash',
        'variance',
        'notes',
    ];

    protected $casts = [
        'closeout_date' => 'date',
        'opening_balance' => 'decimal:2',
        'total_sales' => 'decimal:2',
        'cash_on_hand' => 'decimal:2',
        'total_expenses' => 'decimal:2',
        'net_cash' => 'decimal:2',
        'expected_cash' => 'decimal:2',
        'variance' => 'decimal:2',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
