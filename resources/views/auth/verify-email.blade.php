@extends('layouts.auth')

@section('title', 'Verify Email - SkillBridge')

@section('content')
<div class="w-full max-w-md">
    <div class="bg-white rounded-2xl shadow-xl p-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Verify Your Email</h2>
        <p class="text-gray-600 mb-6">
            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?
        </p>

        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-4">
            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button 
                    type="submit" 
                    class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    Resend Verification Email
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button 
                    type="submit" 
                    class="w-full border border-gray-300 text-gray-700 py-3 rounded-lg font-semibold hover:bg-gray-50 transition">
                    Log Out
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
