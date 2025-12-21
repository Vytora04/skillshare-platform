@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="bg-gray-50 dark:bg-slate-950 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 py-10">
        {{-- Success Message --}}
        @if(session('success'))
            <div class="mb-6 bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Profile Header --}}
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6 mb-6">
            <div class="flex items-start justify-between">
                <div class="flex items-start gap-4">
                    {{-- Avatar --}}
                    <div class="flex-shrink-0">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-full object-cover border-4 border-emerald-100 dark:border-emerald-900">
                        @else
                            <div class="w-24 h-24 rounded-full bg-emerald-600 flex items-center justify-center text-white text-3xl font-bold">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    
                    {{-- User Info --}}
                    <div>
                        <h1 class="text-3xl font-bold text-slate-900 dark:text-white flex items-center">
                            {{ $user->name }}
                            @if($user->isVerifiedOrg())
                                <span class="ml-2" title="Verified Organization">
                                    <svg class="h-6 w-6 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                            @endif
                        </h1>
                        <p class="text-slate-600 dark:text-slate-400 mt-1">{{ $user->email }}</p>
                        @if($user->location)
                            <p class="text-slate-600 dark:text-slate-400 mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                </svg>
                                {{ $user->location }}
                            </p>
                        @endif
                        @if($user->availability)
                            <p class="text-slate-600 dark:text-slate-400 mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                </svg>
                                {{ $user->availability }}
                            </p>
                        @endif
                        <div class="mt-2 flex flex-wrap gap-2">
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-semibold
                                {{ $user->isAdmin() ? 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-300' : 
                                   ($user->isModerator() ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-300' : 'bg-slate-100 text-slate-800 dark:bg-slate-700 dark:text-slate-300') }}">
                                {{ $user->getRole() }}
                            </span>
                            @if($user->isProvider())
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300">
                                    Provider
                                </span>
                            @endif
                            @if($user->isSeeker())
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-semibold bg-teal-100 text-teal-800 dark:bg-teal-900/40 dark:text-teal-300">
                                    Seeker
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('profile.edit') }}" 
                       class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Edit Profile
                    </a>
                    <a href="{{ route('profile.password.edit') }}" 
                       class="inline-flex items-center px-4 py-2 bg-slate-600 text-white rounded-lg hover:bg-slate-700 dark:bg-slate-700 dark:hover:bg-slate-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                        Change Password
                    </a>
                </div>
            </div>
        </div>

        {{-- Bio Section --}}
        @if($user->bio)
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6 mb-6">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">About</h2>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $user->bio }}</p>
            </div>
        @endif

        {{-- Skills Section --}}
        @if($user->skills && count($user->skills) > 0)
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6 mb-6">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Skills</h2>
                <div class="flex flex-wrap gap-2">
                    @foreach($user->skills as $skill)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-50 text-emerald-700 border border-emerald-200 dark:bg-emerald-900/20 dark:text-emerald-300 dark:border-emerald-800">
                            {{ $skill }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Profile Information --}}
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6 mb-6">
            <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-4">Contact & Links</h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Name</label>
                    <p class="mt-1 text-slate-900 dark:text-white">{{ $user->name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Email</label>
                    <p class="mt-1 text-slate-900 dark:text-white">{{ $user->email }}</p>
                </div>
                @if($user->portfolio_url)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Portfolio</label>
                        <p class="mt-1">
                            <a href="{{ $user->portfolio_url }}" target="_blank" class="text-emerald-600 hover:text-emerald-700 dark:text-emerald-400 dark:hover:text-emerald-300 underline">
                                {{ $user->portfolio_url }}
                            </a>
                        </p>
                    </div>
                @endif
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Member Since</label>
                    <p class="mt-1 text-slate-900 dark:text-white">{{ $user->created_at->format('F j, Y') }}</p>
                </div>
            </div>
        </div>

        {{-- Account Statistics --}}
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6">
            <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-4">Account Statistics</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-emerald-50 dark:bg-emerald-900/20 p-4 rounded-lg">
                    <p class="text-sm text-slate-600 dark:text-slate-400">Posts Created</p>
                    <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">{{ $user->skillPosts()->count() ?? 0 }}</p>
                </div>
                <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                    <p class="text-sm text-slate-600 dark:text-slate-400">Active Projects</p>
                    <p class="text-2xl font-bold text-green-600 dark:text-green-400">0</p>
                </div>
                <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg">
                    <p class="text-sm text-slate-600 dark:text-slate-400">Completed Projects</p>
                    <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">0</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
