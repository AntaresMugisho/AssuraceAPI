<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Claim extends Model
{
    use HasFactory;

    // Relationships

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    // Local scopes

    public function scopePending(Builder $query): void
    {
        $query->where("status", "pending");
    }

    public function scopeApproved(Builder $query): void
    {
        $query->where("status", "pending");
    }

    public function scopeRejected(Builder $query): void
    {
        $query->where("status", "pending");
    }

    
    // Helpers

    public function isPending():  bool
    {
        return $this->status === "pending";
    }

    public function isApproved(): bool
    {
        return $this->status === "approved";
    }

    public function isRejected(): bool
    {
        return $this->status === "rejected";
    }
}
