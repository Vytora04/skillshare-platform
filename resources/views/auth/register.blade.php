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
    
    <form action="{{ url('/register') }}" method="POST">
        @csrf
        
        <div class="input-box">
            <i class='bx bxs-user'></i>
            <input type="text" name="name" placeholder="Full Name" required>
        </div>
        
        <div class="input-box">
            <i class='bx bxs-envelope'></i>
            <input type="email" name="email" placeholder="Email" required>
        </div>
        
        <div class="input-box">
            <i class='bx bxs-lock-alt'></i>
            <input type="password" name="password" placeholder="Password" required>
        </div>
        
        <div class="input-box">
            <i class='bx bxs-lock-alt'></i>
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
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