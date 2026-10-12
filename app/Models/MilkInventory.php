<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MilkInventory extends Model
{
    protected $fillable = [
        'branch_id',
        'user_id',
        'quantity_liters',
        'fat_percentage',
        'source',
        'received_date',
        'notes',
    ];

    protected $casts = [
        'quantity_liters' => 'decimal:2',
        'fat_percentage' => 'decimal:2',
        'received_date' => 'date',
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
