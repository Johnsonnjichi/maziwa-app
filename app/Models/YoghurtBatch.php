<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class YoghurtBatch extends Model
{
    protected $fillable = [
        'user_id',
        'batch_number',
        'milk_quantity_liters',
        'flavor',
        'status',
        'production_date',
        'yield_quantity_liters',
        'notes',
    ];

    protected $casts = [
        'milk_quantity_liters' => 'decimal:2',
        'yield_quantity_liters' => 'decimal:2',
        'production_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
