<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'is_moderator',
        'roles',
        'bio',
        'skills',
        'portfolio_url',
        'location',
        'availability',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'is_moderator' => 'boolean',
            'roles' => 'array',
            'skills' => 'array',
        ];
    }

    /**
     * Check if user has a specific role.
     */
    public function hasRole(string $role): bool
    {
        return in_array($role, $this->roles ?? []);
    }

    /**
     * Check if user has any of the given roles.
     */
    public function hasAnyRole(array $roles): bool
    {
        return !empty(array_intersect($roles, $this->roles ?? []));
    }

    /**
     * Add a role to user.
     */
    public function addRole(string $role): void
    {
        $roles = $this->roles ?? [];
        if (!in_array($role, $roles)) {
            $roles[] = $role;
            $this->update(['roles' => $roles]);
        }
    }

    /**
     * Remove a role from user.
     */
    public function removeRole(string $role): void
    {
        $roles = $this->roles ?? [];
        $roles = array_values(array_diff($roles, [$role]));
        $this->update(['roles' => $roles]);
    }

    /**
     * Set user roles (replaces all existing roles).
     */
    public function setRoles(array $roles): void
    {
        $this->update(['roles' => $roles]);
    }

    /**
     * Check if user is a provider.
     */
    public function isProvider(): bool
    {
        return $this->hasRole('provider');
    }

    /**
     * Check if user is a seeker.
     */
    public function isSeeker(): bool
    {
        return $this->hasRole('seeker');
    }

    /**
     * Check if user is an organization representative.
     */
    public function isOrgRep(): bool
    {
        return $this->hasRole('org_rep');
    }

    /**
     * Check if user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin') || $this->is_admin;
    }

    /**
     * Check if user is a moderator.
     */
    public function isModerator(): bool
    {
        return $this->hasRole('moderator') || $this->is_moderator;
    }

    /**
     * Check if user is a regular user (not admin or moderator).
     */
    public function isUser(): bool
    {
        return !$this->isAdmin() && !$this->isModerator();
    }

    /**
     * Check if user has any moderating privileges (admin or moderator).
     */
    public function isStaff(): bool
    {
        return $this->isAdmin() || $this->isModerator();
    }

    /**
     * Get user's primary role as a string.
     */
    public function getRole(): string
    {
        if ($this->isAdmin()) {
            return 'Admin';
        }
        if ($this->isModerator()) {
            return 'Moderator';
        }
        if ($this->isOrgRep()) {
            return 'Organization Rep';
        }
        if ($this->isProvider() && $this->isSeeker()) {
            return 'Provider & Seeker';
        }
        if ($this->isProvider()) {
            return 'Provider';
        }
        if ($this->isSeeker()) {
            return 'Seeker';
        }
        return 'User';
    }

    /**
     * Make user an admin.
     */
    public function makeAdmin(): void
    {
        $this->update(['is_admin' => true, 'is_moderator' => false]);
    }

    /**
     * Remove admin privileges from user.
     */
    public function removeAdmin(): void
    {
        $this->update(['is_admin' => false]);
    }

    /**
     * Make user a moderator.
     */
    public function makeModerator(): void
    {
        $this->update(['is_moderator' => true, 'is_admin' => false]);
    }

    /**
     * Remove moderator privileges from user.
     */
    public function removeModerator(): void
    {
        $this->update(['is_moderator' => false]);
    }

    public function sentInvitations()
    {
        return $this->hasMany(Invitation::class, 'sender_id');
    }

    public function receivedInvitations()
    {
        return $this->hasMany(Invitation::class, 'receiver_id');
    }

    public function orgVerification()
    {
        return $this->hasOne(OrgVerification::class);
    }

    public function isVerifiedOrg(): bool
    {
        return $this->orgVerification && $this->orgVerification->isApproved();
    }

    /**
     * Make user a regular user (remove all roles).
     */
    public function makeUser(): void
    {
        $this->update(['is_admin' => false, 'is_moderator' => false]);
    }

    /**
     * Get all skill posts created by this user.
     */
    public function skillPosts()
    {
        return $this->hasMany(\App\Models\SkillPost::class);
    }
}
