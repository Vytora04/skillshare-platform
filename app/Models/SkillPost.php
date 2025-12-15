<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    /**
     * Get the tags associated with this post.
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
