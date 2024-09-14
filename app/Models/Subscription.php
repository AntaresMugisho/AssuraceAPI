<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    use HasFactory;

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
}
