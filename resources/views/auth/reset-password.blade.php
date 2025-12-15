@extends('layouts.auth')

@section('title', 'Reset Password - SkillBridge')

@section('content')
<div class="w-full max-w-md">
    <div class="bg-white rounded-2xl shadow-xl p-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Reset Password</h2>
        <p class="text-gray-600 mb-6">
            Enter your new password below.
        </p>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    value="{{ $email ?? old('email') }}" 
                    required 
                    autofocus
                    readonly
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none"
                >
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Minimum 6 characters"
                >
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    id="password_confirmation" 
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Confirm your password"
                >
            </div>

            <button 
                type="submit" 
                class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                Reset Password
            </button>
        </form>
    </div>
</div>
@endsection
