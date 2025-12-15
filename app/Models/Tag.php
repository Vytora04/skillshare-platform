<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    protected $fillable = ['name', 'slug', 'description'];

    /**
     * Get the skill posts that have this tag.
     */
    public function skillPosts(): BelongsToMany
    {
        return $this->belongsToMany(SkillPost::class);
    }
}
