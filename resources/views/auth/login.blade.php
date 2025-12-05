@extends('layouts.auth')

@section('title', 'Sign In - SkillShare')

@section('form-content')
<div class="glass-box px-20 relative">
    <a href="{{ url('/') }}" style="position: absolute; top: 35px; left: 35px;" class="flex items-center gap-1 text-gray-600 hover:text-gray-900 transition">
        <i class='bx bx-arrow-back text-xl'></i>
        <span class="text-sm font-medium">Back</span>
    </a>
    <div style="padding-top: 80px; padding-bottom: 80px;">
    <h2 class="text-4xl font-bold form-title text-center mb-10">Sign In</h2>

    <form action="{{ route('login') }}" method="POST">
        @csrf
        
        <div class="input-box">
            <i class='bx bxs-envelope'></i>
            <input type="email" name="email" placeholder="Email" required>
        </div>

        <div class="input-box">
            <i class='bx bxs-lock-alt'></i>
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <div class="remember-forgot">
            <label>
                <input type="checkbox" name="remember">
                Remember me
            </label>
            <a href="#">Forgot password?</a>
        </div>

        <button type="submit" class="btn-submit">
            Sign In
        </button>

        <div class="logreg-link">
            <p>Don't have an account? <a href="{{ route('register') }}">Sign up</a></p>
        </div>
        </div>
    </div>
</div>
@endsection
