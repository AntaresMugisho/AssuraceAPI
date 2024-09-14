<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
    use HasFactory;

    // Relationships


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function upgradeFromPlan(): BelongsTo
    {
        return $this->belongsTo(Plan::class, "upgrade_from");
    }

    public function renewalOfPlan(): BelongsTo
    {
        return $this->belongsTo(Plan::class, "renewal_of");
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }



    // Helpers

    public function isActive(): bool
    {
        return $this->status === "active";
    }

    public function isExpired(): bool
    {
        return $this->status === "expired";
    }

    public function isCanceled(): bool
    {
        return $this->status === "canceled";
    }

    public function isUpgraded(): bool
    {
        return $this->status === "upgraded";
    }

    public function isRenewed(): bool
    {
        return $this->status === "renewed";
    }

    public function isPaid(): bool
    {
        return $this->status === "paid";
    }

    public function isUnpaid(): bool
    {
        return $this->status === "unpaid";
    }


}
