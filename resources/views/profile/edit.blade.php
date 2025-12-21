@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="bg-gray-50 dark:bg-slate-950 min-h-screen">
    <div class="max-w-2xl mx-auto px-4 py-10">
        {{-- Back Link --}}
        <a href="{{ route('profile.show') }}" class="inline-flex items-center text-sm text-emerald-600 hover:text-emerald-700 dark:text-emerald-400 dark:hover:text-emerald-300 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            Back to Profile
        </a>

        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 p-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Edit Profile</h1>

            {{-- Error Messages --}}
            @if($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PATCH')

                {{-- Avatar Upload --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Profile Picture</label>
                    <div class="flex items-center gap-4">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-20 h-20 rounded-full object-cover">
                        @else
                            <div class="w-20 h-20 rounded-full bg-emerald-600 flex items-center justify-center text-white text-2xl font-bold">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <input type="file" name="avatar" id="avatar" accept="image/*" class="text-sm text-gray-600 dark:text-gray-400">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">JPG, PNG or GIF (max 2MB)</p>
                        </div>
                    </div>
                </div>

                {{-- Name Field --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Name <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        value="{{ old('name', $user->name) }}" 
                        required 
                        class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 dark:bg-slate-900 dark:text-white"
                    >
                </div>

                {{-- Email Field --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email', $user->email) }}" 
                        required 
                        class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 dark:bg-slate-900 dark:text-white"
                    >
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">We'll send a verification email if you change your address.</p>
                </div>

                {{-- Bio Field --}}
                <div>
                    <label for="bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Bio
                    </label>
                    <textarea 
                        name="bio" 
                        id="bio" 
                        rows="4"
                        maxlength="1000"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 dark:bg-slate-900 dark:text-white"
                        placeholder="Tell us about yourself..."
                    >{{ old('bio', $user->bio) }}</textarea>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Maximum 1000 characters</p>
                </div>

                {{-- Skills Field --}}
                <div>
                    <label for="skills" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Skills
                    </label>
                    <input 
                        type="text" 
                        name="skills" 
                        id="skills" 
                        value="{{ old('skills', $user->skills ? implode(', ', $user->skills) : '') }}" 
                        class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 dark:bg-slate-900 dark:text-white"
                        placeholder="e.g. Web Design, Laravel, UI/UX, Project Management"
                    >
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Separate skills with commas</p>
                </div>

                {{-- Portfolio URL --}}
                <div>
                    <label for="portfolio_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Portfolio URL
                    </label>
                    <input 
                        type="url" 
                        name="portfolio_url" 
                        id="portfolio_url" 
                        value="{{ old('portfolio_url', $user->portfolio_url) }}" 
                        class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 dark:bg-slate-900 dark:text-white"
                        placeholder="https://yourportfolio.com"
                    >
                </div>

                {{-- Location --}}
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Location
                    </label>
                    <input 
                        type="text" 
                        name="location" 
                        id="location" 
                        value="{{ old('location', $user->location) }}" 
                        class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 dark:bg-slate-900 dark:text-white"
                        placeholder="e.g. Jakarta, Indonesia or Remote"
                    >
                </div>

                {{-- Availability --}}
                <div>
                    <label for="availability" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Availability
                    </label>
                    <input 
                        type="text" 
                        name="availability" 
                        id="availability" 
                        value="{{ old('availability', $user->availability) }}" 
                        class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 dark:bg-slate-900 dark:text-white"
                        placeholder="e.g. 10 hours/week or Weekends only"
                    >
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('profile.show') }}" 
                       class="px-6 py-2 border border-gray-300 dark:border-slate-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-slate-700 transition">
                        Cancel
                    </a>
                    <button 
                        type="submit" 
                        class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
