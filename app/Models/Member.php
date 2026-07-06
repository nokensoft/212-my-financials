<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    use Notifiable;

    public const STATUS_PENDING = 'pending';

    public const STATUS_VERIFIED = 'verified';

    public const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'name', 'phone', 'email', 'password', 'google_id', 'avatar', 'status',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function isVerified(): bool
    {
        return $this->status === self::STATUS_VERIFIED;
    }

    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isRejected(): bool
    {
        return $this->status === self::STATUS_REJECTED;
    }

    /**
     * @return array<string, array<string, string>>
     */
    public static function statuses(): array
    {
        return [
            self::STATUS_VERIFIED => ['label' => 'Terverifikasi', 'class' => 'bg-primary-100 text-primary-700'],
            self::STATUS_PENDING => ['label' => 'Menunggu Verifikasi', 'class' => 'bg-amber-100 text-amber-700'],
            self::STATUS_REJECTED => ['label' => 'Ditolak', 'class' => 'bg-red-100 text-red-700'],
        ];
    }
}
