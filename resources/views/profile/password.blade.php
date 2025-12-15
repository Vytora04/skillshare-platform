@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-2xl mx-auto px-4 py-10">
        {{-- Back Link --}}
        <a href="{{ route('profile.show') }}" class="inline-flex items-center text-sm text-blue-600 hover:text-blue-700 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            Back to Profile
        </a>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Change Password</h1>

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

            <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-6">
                @csrf
                @method('PATCH')

                {{-- Current Password --}}
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">
                        Current Password <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="password" 
                        name="current_password" 
                        id="current_password" 
                        required 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>

                {{-- New Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        New Password <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        required 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                    <p class="mt-1 text-sm text-gray-500">Minimum 6 characters</p>
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                        Confirm New Password <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        id="password_confirmation" 
                        required 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('profile.show') }}" 
                       class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                        Cancel
                    </a>
                    <button 
                        type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Update Password
                    </button>
                </div>
            </form>
        </div>

        {{-- Security Tips --}}
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <h3 class="font-semibold text-blue-900 mb-2">Password Security Tips</h3>
            <ul class="text-sm text-blue-800 space-y-1">
                <li>• Use at least 6 characters (longer is better)</li>
                <li>• Mix uppercase and lowercase letters</li>
                <li>• Include numbers and special characters</li>
                <li>• Don't reuse passwords from other sites</li>
            </ul>
        </div>
    </div>
</div>
@endsection
