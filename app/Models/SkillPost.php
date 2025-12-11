<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SkillPost extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'type',
        'skills',
        'location',
        'time_commitment',
        'description',
    ];

    /**
     * Get the user who created this post.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
