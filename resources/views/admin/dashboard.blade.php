@extends('layouts.app')

@section('title','Admin Dashboard')

@section('content')
<div class="max-w-6xl mx-auto py-12 px-4">
    <div class="mb-8">
        <h1 class="text-3xl font-bold mb-2">Admin Dashboard</h1>
        <p class="text-gray-600">Manage users and site settings</p>
    </div>

    <!-- Stats Section -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-600 text-sm font-semibold uppercase mb-2">Total Users</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $totalUsers }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-600 text-sm font-semibold uppercase mb-2">Admins</h3>
            <p class="text-3xl font-bold text-red-600">{{ $totalAdmins }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-600 text-sm font-semibold uppercase mb-2">Moderators</h3>
            <p class="text-3xl font-bold text-yellow-600">{{ $totalModerators }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-600 text-sm font-semibold uppercase mb-2">Regular Users</h3>
            <p class="text-3xl font-bold text-green-600">{{ $totalRegularUsers }}</p>
        </div>
    </div>

    <!-- Users Management Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold">Users Management</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Joined</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($user->isAdmin())
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Admin</span>
                                @elseif($user->isModerator())
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Moderator</span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">User</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $user->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                                @if($user->id !== $currentUser->id)
                                    <!-- Show role management based on current user -->
                                    @if($currentUser->isModerator())
                                        @if(!$user->isModerator())
                                            <form action="{{ route('admin.users.toggle-role', $user->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                @if($user->isAdmin())
                                                    <button type="submit" class="text-blue-600 hover:text-blue-800 font-medium">Make User</button>
                                                @else
                                                    <button type="submit" class="text-blue-600 hover:text-blue-800 font-medium">Make Moderator</button>
                                                @endif
                                            </form>
                                        @else
                                            <span class="text-gray-500 font-medium">Cannot modify moderators</span>
                                        @endif
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-600">No users found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
