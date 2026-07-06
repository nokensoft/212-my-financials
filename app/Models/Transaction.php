<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    public const TYPE_INCOME = 'pemasukan';

    public const TYPE_EXPENSE = 'pengeluaran';

    protected $fillable = [
        'date', 'type', 'category', 'description', 'amount', 'order_id',
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'integer',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function isIncome(): bool
    {
        return $this->type === self::TYPE_INCOME;
    }
}
