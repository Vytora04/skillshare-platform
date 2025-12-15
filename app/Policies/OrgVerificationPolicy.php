<?php

namespace App\Policies;

use App\Models\OrgVerification;
use App\Models\User;

class OrgVerificationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('moderator');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, OrgVerification $verification): bool
    {
        return $user->hasRole('admin') || $user->hasRole('moderator') || $user->id === $verification->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, OrgVerification $verification): bool
    {
        return $user->hasRole('admin') || $user->hasRole('moderator');
    }
}
