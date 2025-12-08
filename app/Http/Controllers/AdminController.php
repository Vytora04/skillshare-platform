<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard with user statistics.
     */
    public function dashboard()
    {
        $users = User::paginate(15);
        $totalUsers = User::count();
        $totalAdmins = User::where('is_admin', true)->count();
        $totalRegularUsers = $totalUsers - $totalAdmins;

        return view('admin.dashboard', compact('users', 'totalUsers', 'totalAdmins', 'totalRegularUsers'));
    }

    /**
     * Toggle user admin role.
     */
    public function toggleRole(User $user)
    {
        // Prevent admin from removing their own admin privileges
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot change your own role.');
        }

        if ($user->isAdmin()) {
            $user->removeAdmin();
            $message = ucfirst($user->name) . ' is no longer an admin.';
        } else {
            $user->makeAdmin();
            $message = ucfirst($user->name) . ' is now an admin.';
        }

        return back()->with('success', $message);
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
     * Delete a user.
     */
    public function deleteUser(User $user)
    {
        // Prevent deleting yourself
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $userName = $user->name;
        $user->delete();

        return back()->with('success', ucfirst($userName) . ' has been deleted.');
    }
}
