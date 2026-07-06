<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    public const STATUS_BARU = 'baru';

    public const STATUS_MENUNGGU = 'menunggu_verifikasi';

    public const STATUS_TERVERIFIKASI = 'terverifikasi';

    public const STATUS_LUNAS = 'lunas';

    public const STATUS_BATAL = 'batal';

    protected $fillable = [
        'invoice_no', 'member_id', 'service_package_id', 'package_name', 'amount',
        'payment_method', 'status', 'scheduled_at', 'notes', 'verified_by', 'verified_at',
    ];

    protected $casts = [
        'amount' => 'integer',
        'scheduled_at' => 'datetime',
        'verified_at' => 'datetime',
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(ServicePackage::class, 'service_package_id');
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function isPaid(): bool
    {
        return $this->status === self::STATUS_LUNAS;
    }

    /**
     * Status metadata (label & badge class) keyed by status value.
     *
     * @return array<string, array<string, string>>
     */
    public static function statuses(): array
    {
        return [
            self::STATUS_BARU => ['label' => 'Baru', 'class' => 'bg-slate-100 text-slate-600'],
            self::STATUS_MENUNGGU => ['label' => 'Menunggu Verifikasi', 'class' => 'bg-amber-100 text-amber-700'],
            self::STATUS_TERVERIFIKASI => ['label' => 'Terverifikasi', 'class' => 'bg-blue-100 text-blue-700'],
            self::STATUS_LUNAS => ['label' => 'Lunas', 'class' => 'bg-primary-100 text-primary-700'],
            self::STATUS_BATAL => ['label' => 'Batal', 'class' => 'bg-red-100 text-red-700'],
        ];
    }

    public function statusLabel(): string
    {
        return self::statuses()[$this->status]['label'] ?? $this->status;
    }

    public function statusClass(): string
    {
        return self::statuses()[$this->status]['class'] ?? 'bg-slate-100 text-slate-600';
    }

    /**
     * Generate the next sequential invoice number, e.g. INV-2026-0007.
     */
    public static function generateInvoiceNo(): string
    {
        $year = now()->year;
        $prefix = 'INV-'.$year.'-';

        $last = static::where('invoice_no', 'like', $prefix.'%')
            ->orderByDesc('invoice_no')
            ->value('invoice_no');

        $next = $last ? ((int) substr($last, -4) + 1) : 1;

        return $prefix.str_pad((string) $next, 4, '0', STR_PAD_LEFT);
    }
}
