<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;
    

    // Relationships


    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }


    // Helpers


    public function wasSuccess():bool
    {
        return $this->status === "success";
    }

    public function hasFailed():bool
    {
        return $this->status === "failed";
    }

}
