<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServicePackage extends Model
{
    protected $fillable = [
        'code', 'tier', 'name', 'slug', 'price', 'duration', 'description', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'integer',
        'sort_order' => 'integer',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function getPriceLabelAttribute(): string
    {
        return $this->price > 0 ? 'Rp '.number_format($this->price, 0, ',', '.') : 'Gratis';
    }

    /**
     * A package is free when its price is zero (no payment/proof needed to order).
     */
    public function isFree(): bool
    {
        return (int) $this->price <= 0;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
