<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
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
        ];
    }

    /**
     * Check if user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    /**
     * Check if user is a moderator.
     */
    public function isModerator(): bool
    {
        return $this->is_moderator;
    }

    /**
     * Check if user is a regular user (not admin or moderator).
     */
    public function isUser(): bool
    {
        return !$this->is_admin && !$this->is_moderator;
    }

    /**
     * Check if user has any moderating privileges (admin or moderator).
     */
    public function isStaff(): bool
    {
        return $this->is_admin || $this->is_moderator;
    }

    /**
     * Get user's role as a string.
     */
    public function getRole(): string
    {
        if ($this->is_admin) {
            return 'Admin';
        }
        if ($this->is_moderator) {
            return 'Moderator';
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

    /**
     * Make user a regular user (remove all roles).
     */
    public function makeUser(): void
    {
        $this->update(['is_admin' => false, 'is_moderator' => false]);
    }
}
