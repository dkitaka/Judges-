<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Score extends Model
{
    protected $fillable = [
        'judge_id',
        'user_id',
        'points',
    ];

    /**
     * Get the judge who gave this score
     */
    public function judge(): BelongsTo
    {
        return $this->belongsTo(Judge::class);
    }

    /**
     * Get the user who received this score
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
