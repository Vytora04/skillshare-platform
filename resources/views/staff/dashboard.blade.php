@extends('layouts.app')

@section('title', Auth::user()->isAdmin() ? 'Admin Dashboard' : 'Moderator Dashboard')

@section('content')
<div class="max-w-6xl mx-auto py-12 px-4">
    <div class="mb-8">
        <h1 class="text-3xl font-bold mb-2">{{ Auth::user()->isAdmin() ? 'Admin Dashboard' : 'Moderator Dashboard' }}</h1>
        <p class="text-gray-600">Manage users and site settings</p>
    </div>

    <!-- Stats Section -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6">
            <h3 class="text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase mb-2">Total Users</h3>
            <p class="text-3xl font-bold text-emerald-600 dark:text-emerald-400">{{ $totalUsers }}</p>
        </div>
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6">
            <h3 class="text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase mb-2">Skill Posts</h3>
            <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $totalPosts }}</p>
        </div>
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6">
            <h3 class="text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase mb-2">Projects</h3>
            <p class="text-3xl font-bold text-purple-600 dark:text-purple-400">{{ $totalProjects }}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $activeProjects }} active</p>
        </div>
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6">
            <h3 class="text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase mb-2">Invitations</h3>
            <p class="text-3xl font-bold text-yellow-600 dark:text-yellow-400">{{ $totalInvitations }}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $pendingInvitations }} pending</p>
        </div>
    </div>

    <!-- Users Management Table -->
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden mb-8">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700">
            <h2 class="text-xl font-bold text-gray-800 dark:text-white">Users Management</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-slate-700 border-b border-gray-200 dark:border-slate-600">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Joined</th>
                        @if($currentUser->isAdmin())
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-slate-700">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($user->isAdmin())
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">Admin</span>
                                @elseif($user->isModerator())
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300">Moderator</span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-slate-700 dark:text-gray-300">User</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">{{ $user->created_at->format('M d, Y') }}</td>
                            @if($currentUser->isAdmin())
                                <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                                    @if($user->id !== $currentUser->id)
                                        @if(!$user->isAdmin())
                                            <form action="{{ route('staff.users.toggle-role', $user->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                @if($user->isModerator())
                                                    <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 font-medium">Remove Moderator</button>
                                                @else
                                                    <button type="submit" class="text-emerald-600 hover:text-emerald-800 dark:text-emerald-400 dark:hover:text-emerald-300 font-medium">Make Moderator</button>
                                                @endif
                                            </form>
                                        @endif
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $currentUser->isAdmin() ? 5 : 4 }}" class="px-6 py-4 text-center text-gray-600 dark:text-gray-400">No users found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-slate-700">
                {{ $users->links() }}
            </div>
        @endif
    </div>

    <!-- Skill Posts Management (Visible to Moderators & Admins) -->
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-800 dark:text-white">Recent Skill Posts</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-slate-700 border-b border-gray-200 dark:border-slate-600">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Posted By</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-slate-700">
                    @forelse($recentPosts as $post)
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                <a href="{{ route('skill-posts.show', $post) }}" class="hover:text-emerald-600 dark:hover:text-emerald-400 hover:underline">
                                    {{ Str::limit($post->title, 40) }}
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">{{ $post->category }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">{{ $post->user->name ?? 'Unknown' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">{{ $post->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                                <form action="{{ route('skill-posts.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 font-medium">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-600 dark:text-gray-400">No recent posts found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
