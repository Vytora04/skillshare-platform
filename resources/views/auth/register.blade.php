@extends('layouts.auth')

@section('title', 'Sign Up - SkillShare')

@section('form-content')
<div class="glass-box px-20 relative">
    <a href="{{ url('/') }}" style="position: absolute; top: 35px; left: 35px;" class="flex items-center gap-1 text-gray-600 hover:text-gray-900 transition">
        <i class='bx bx-arrow-back text-xl'></i>
        <span class="text-sm font-medium">Back</span>
    </a>
    <div style="padding-top: 80px; padding-bottom: 80px;">
    <h2 class="text-4xl font-bold form-title text-center mb-10">Sign Up</h2>
    
    {{-- Display validation errors --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            <p class="font-semibold mb-2">Please fix the following errors:</p>
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ url('/register') }}" method="POST" class="space-y-4">
        @csrf
        
        <div>
            <div class="input-box">
                <i class='bx bxs-user'></i>
                <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required>
            </div>
            @error('name')
                <span class="text-red-500 text-xs mt-1 block ml-2">{{ $message }}</span>
            @enderror
        </div>
        
        <div>
            <div class="input-box">
                <i class='bx bxs-envelope'></i>
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            </div>
            @error('email')
                <span class="text-red-500 text-xs mt-1 block ml-2">{{ $message }}</span>
            @enderror
        </div>
        
        <div>
            <div class="input-box">
                <i class='bx bxs-lock-alt'></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <span class="text-gray-500 text-xs mt-1 block ml-2">Minimum 6 characters</span>
            @error('password')
                <span class="text-red-500 text-xs mt-1 block ml-2">{{ $message }}</span>
            @enderror
        </div>
        
        <div>
            <div class="input-box">
                <i class='bx bxs-lock-alt'></i>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
            </div>
            @error('password_confirmation')
                <span class="text-red-500 text-xs mt-1 block ml-2">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="remember-forgot" style="justify-content: flex-start;">
            <label>
                <input type="checkbox" required>
                I agree to the terms & conditions
            </label>
        </div>
        
        <button type="submit" class="btn-submit">
            Sign Up
        </button>
        
        <div class="logreg-link">
            <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
        </div>
        </div>
    </div>
</div>
@endsection