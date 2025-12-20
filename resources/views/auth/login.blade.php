@extends('layouts.auth')

@section('title', 'Sign In - SkillBridge')

@section('form-content')
@section('form-content')
<div class="glass-box px-12 py-12 relative w-full max-w-2xl mx-auto">
    <a href="{{ url('/') }}" class="absolute top-6 left-6 flex items-center gap-1 text-slate-500 hover:text-teal-600 transition group">
        <i class='bx bx-arrow-back text-xl group-hover:-translate-x-1 transition-transform'></i>
        <span class="text-sm font-medium">Back</span>
    </a>

    <div>
        <h2 class="text-3xl font-bold form-title text-center mb-0 leading-tight">Welcome Back</h2>
        <p class="text-center text-slate-500 mb-0">Sign in to continue your journey</p>
        <div class="h-3"></div>

        <form action="{{ route('login') }}" method="POST" class="">
            @csrf
            
            <!-- Email -->
            <div class="input-group">
                <input type="email" name="email" id="email" class="input-field" placeholder=" " required autofocus>
                <label for="email" class="floating-label">Email Address</label>
                <i class='bx bx-envelope input-icon'></i>
            </div>

            <!-- Password -->
            <div class="input-group">
                <input type="password" name="password" id="password" class="input-field" placeholder=" " required>
                <label for="password" class="floating-label">Password</label>
                <i class='bx bx-lock-alt input-icon'></i>
                <i class='bx bx-show absolute right-4 top-[25px] transform -translate-y-1/2 text-gray-400 cursor-pointer hover:text-teal-600 transition-colors text-xl toggle-password' data-target="password"></i>
            </div>

            <div class="remember-forgot mt-2">
                <div class="flex items-center gap-3">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-teal-600 bg-gray-100 border-gray-300 rounded focus:ring-teal-500 focus:ring-2">
                    <label for="remember" class="text-sm text-slate-600">Remember me</label>
                </div>
                <a href="{{ route('password.request') }}" class="text-sm font-medium text-teal-600 hover:text-teal-500">Forgot password?</a>
            </div>

            <button type="submit" class="btn-submit shadow-lg hover:shadow-teal-500/30">
                Sign In
            </button>

            <div class="logreg-link">
                <p>Don't have an account? <a href="{{ route('register') }}">Sign up</a></p>
            </div>
        </form>
    </div>

    <script>
        document.querySelectorAll('.toggle-password').forEach(icon => {
            icon.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);
                
                if (input.type === 'password') {
                    input.type = 'text';
                    this.classList.remove('bx-show');
                    this.classList.add('bx-hide');
                } else {
                    input.type = 'password';
                    this.classList.remove('bx-hide');
                    this.classList.add('bx-show');
                }
            });
        });
    </script>
</div>
@endsection
