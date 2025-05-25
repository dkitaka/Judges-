<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Judge extends Model
{
    protected $fillable = [
        'username',
        'display_name',
    ];

    /**
     * Get all scores given by this judge
     */
    public function scores(): HasMany
    {
        return $this->hasMany(Score::class);
    }

    /**
     * Get all users scored by this judge
     */
    public function scoredUsers()
    {
        return $this->belongsToMany(User::class, 'scores')
            ->withPivot('points')
            ->withTimestamps();
    }
}
