<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SkillPost;
use App\Models\Project;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard with user statistics.
     */
    public function dashboard()
    {
        $currentUser = Auth::user();
        
        $users = User::paginate(15);
        $totalUsers = User::count();
        $totalAdmins = User::whereJsonContains('roles', 'admin')->count();
        $totalModerators = User::whereJsonContains('roles', 'moderator')->count();
        $totalRegularUsers = $totalUsers - $totalAdmins;
        
        // Platform stats
        $totalPosts = SkillPost::count();
        $totalProjects = Project::count();
        $totalInvitations = Invitation::count();
        $pendingInvitations = Invitation::where('status', 'pending')->count();
        $activeProjects = Project::where('status', 'active')->count();

        return view('admin.dashboard', compact(
            'users', 'totalUsers', 'totalAdmins', 'totalModerators', 'totalRegularUsers', 'currentUser',
            'totalPosts', 'totalProjects', 'totalInvitations', 'pendingInvitations', 'activeProjects'
        ));
    }

    /**
     * Toggle user role (Admins can only manage moderators, Moderators can promote/demote to regular).
     */
    public function toggleRole(User $target)
    {
        $currentUser = Auth::user();

        // Prevent users from changing their own role
        if ($target->id === $currentUser->id) {
            return back()->with('error', 'You cannot change your own role.');
        }

        // ADMIN RULES: Can only delete posts, cannot manage admin/moderator roles
        if ($currentUser->isAdmin() && !$currentUser->isModerator()) {
            return back()->with('error', 'Admins can only delete posts, not manage user roles.');
        }

        // MODERATOR RULES
        if ($currentUser->isModerator()) {
            // Cannot remove moderator status from another moderator
            if ($target->isModerator()) {
                return back()->with('error', 'You cannot change another moderator\'s role.');
            }

            // Can make someone a moderator
            if ($target->isAdmin()) {
                $target->makeUser();
                return back()->with('success', ucfirst($target->name) . ' is now a regular user.');
            }

            // Can make a regular user a moderator
            if ($target->isUser()) {
                $target->makeModerator();
                return back()->with('success', ucfirst($target->name) . ' is now a moderator.');
            }
        }

        return back()->with('error', 'Unauthorized action.');
    }

    /**
     * List all users.
     */
    public function listUsers()
    {
        $users = User::paginate(20);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show user details.
     */
    public function showUser(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Delete a user (Admins and Moderators can delete users).
     */
    public function deleteUser(User $user)
    {
        $currentUser = Auth::user();

        // Prevent deleting yourself
        if ($user->id === $currentUser->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        // Only admins and moderators can delete users
        if (!$currentUser->isStaff()) {
            return back()->with('error', 'Only staff can delete users.');
        }

        $userName = $user->name;
        $user->delete();

        return back()->with('success', ucfirst($userName) . ' has been deleted.');
    }
}
