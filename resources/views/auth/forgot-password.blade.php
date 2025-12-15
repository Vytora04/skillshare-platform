@extends('layouts.auth')

@section('title', 'Forgot Password - SkillBridge')

@section('content')
<div class="w-full max-w-md">
    <div class="bg-white rounded-2xl shadow-xl p-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Forgot Password?</h2>
        <p class="text-gray-600 mb-6">
            No problem. Just let us know your email address and we will email you a password reset link.
        </p>

        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="you@example.com"
                >
            </div>

            <button 
                type="submit" 
                class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                Email Password Reset Link
            </button>

            <div class="text-center">
                <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:text-blue-700">
                    Back to Login
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
