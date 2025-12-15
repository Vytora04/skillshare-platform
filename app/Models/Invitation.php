<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invitation extends Model
{
    protected $fillable = [
        'skill_post_id',
        'sender_id',
        'receiver_id',
        'type',
        'status',
        'message',
    ];

    /**
     * Get the skill post associated with this invitation.
     */
    public function skillPost(): BelongsTo
    {
        return $this->belongsTo(SkillPost::class);
    }

    /**
     * Get the user who sent the invitation.
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Get the user who received the invitation.
     */
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /**
     * Check if the invitation is pending.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if the invitation is accepted.
     */
    public function isAccepted(): bool
    {
        return $this->status === 'accepted';
    }

    /**
     * Check if the invitation is rejected.
     */
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }
}
