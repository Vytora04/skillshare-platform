@extends('layouts.auth')

@section('title', 'Sign Up - SkillBridge')

@section('form-content')
<div class="glass-box px-12 py-12 relative w-full max-w-2xl mx-auto">
    <a href="{{ url('/') }}" class="absolute top-6 left-6 flex items-center gap-1 text-slate-500 hover:text-teal-600 transition group">
        <i class='bx bx-arrow-back text-xl group-hover:-translate-x-1 transition-transform'></i>
        <span class="text-sm font-medium">Back</span>
    </a>

    <div class="mt-4">
        <h2 class="text-3xl font-bold form-title text-center mb-0 leading-tight">Create Account</h2>
        <p class="text-center text-slate-500 mb-0">Join the community of changemakers</p>
        <div class="h-3"></div>

        {{-- Display validation errors --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg text-sm">
                <p class="font-bold mb-1"><i class='bx bx-error-circle'></i> Please fix the following errors:</p>
                <ul class="list-disc list-inside space-y-1 ml-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/register') }}" method="POST" class="" id="registerForm">
            @csrf

            <!-- Role Selection -->
            <div class="mb-[18px] role-wrapper">
                <label class="block text-sm font-medium text-slate-700 mb-3 text-center">I want to...</label>
                <div class="grid grid-cols-2 gap-4">
                    <label class="relative">
                        <input type="radio" name="role" value="seeker" class="role-card-input" {{ old('role') == 'seeker' ? 'checked' : '' }} required>
                        <div class="role-card">
                            <i class='bx bx-search-alt role-icon'></i>
                            <span class="role-title">Find Talent</span>
                        </div>
                    </label>
                    <label class="relative">
                        <input type="radio" name="role" value="provider" class="role-card-input" {{ old('role') == 'seeker' ? '' : 'checked' }}>
                        <div class="role-card">
                            <i class='bx bx-bulb role-icon'></i>
                            <span class="role-title">Offer Skills</span>
                        </div>
                    </label>
                </div>
                @error('role')
                    <span class="text-red-500 text-xs mt-1 block text-center">{{ $message }}</span>
                @enderror
            </div>

            <!-- Name -->
            <div class="input-group">
                <input type="text" name="name" id="name" class="input-field" placeholder=" " value="{{ old('name') }}" required>
                <label for="name" class="floating-label">Full Name</label>
                <i class='bx bx-user input-icon'></i>
                @error('name')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div class="input-group">
                <input type="email" name="email" id="email" class="input-field" placeholder=" " value="{{ old('email') }}" required>
                <label for="email" class="floating-label">Email Address</label>
                <i class='bx bx-envelope input-icon'></i>
                <div id="emailFeedback" class="text-xs mt-1 hidden"></div>
                @error('email')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="input-group">
                <input type="password" name="password" id="password" class="input-field" placeholder=" " required>
                <label for="password" class="floating-label">Password</label>
                <i class='bx bx-lock-alt input-icon'></i>
                <i class='bx bx-show absolute right-4 top-[25px] transform -translate-y-1/2 text-gray-400 cursor-pointer hover:text-teal-600 transition-colors text-xl toggle-password' data-target="password"></i>
                
                <!-- Strength Meter -->
                <div class="strength-meter" id="strengthMeter">
                    <div class="strength-bar" id="strengthBar"></div>
                </div>
                <div id="passwordFeedback" class="text-xs mt-1 text-slate-500">Min 8 chars, numbers & symbols recommended</div>
                
                @error('password')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="input-group">
                <input type="password" name="password_confirmation" id="password_confirmation" class="input-field" placeholder=" " required>
                <label for="password_confirmation" class="floating-label">Confirm Password</label>
                <i class='bx bx-lock-check input-icon'></i>
                <i class='bx bx-show absolute right-4 top-[25px] transform -translate-y-1/2 text-gray-400 cursor-pointer hover:text-teal-600 transition-colors text-xl toggle-password' data-target="password_confirmation"></i>
                <div id="matchFeedback" class="text-xs mt-1 hidden"></div>
            </div>

            <div class="remember-forgot justify-start gap-2 mt-2">
                <div class="flex items-center gap-3">
                    <input type="checkbox" id="terms" required checked class="w-4 h-4 text-teal-600 bg-gray-100 border-gray-300 rounded focus:ring-teal-500 focus:ring-2">
                    <label for="terms" class="text-sm text-slate-600">I agree to the <a href="{{ route('legal') }}#terms" target="_blank">Terms</a> & <a href="{{ route('legal') }}#privacy" target="_blank">Privacy</a></label>
                </div>
            </div>

            <button type="submit" class="btn-submit shadow-lg hover:shadow-teal-500/30">
                Create Account
            </button>

            <div class="logreg-link">
                <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle Password
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

        // Email Validation
        const emailInput = document.getElementById('email');
        const emailFeedback = document.getElementById('emailFeedback');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        emailInput.addEventListener('input', function() {
            const val = this.value;
            if(val.length > 0) {
                if(emailRegex.test(val)) {
                    emailFeedback.textContent = 'Valid email format';
                    emailFeedback.className = 'text-xs mt-1 text-green-600 block';
                } else {
                    emailFeedback.textContent = 'Invalid email format';
                    emailFeedback.className = 'text-xs mt-1 text-red-500 block';
                }
            } else {
                emailFeedback.classList.add('hidden');
            }
        });

        // Password Strength
        const passwordInput = document.getElementById('password');
        const strengthMeter = document.getElementById('strengthMeter');
        const strengthBar = document.getElementById('strengthBar');
        const passwordFeedback = document.getElementById('passwordFeedback');

        passwordInput.addEventListener('input', function() {
            const val = this.value;
            strengthMeter.style.display = val.length > 0 ? 'block' : 'none';
            
            let strength = 0;
            if(val.length >= 8) strength += 1;
            if(val.match(/[0-9]+/)) strength += 1;
            if(val.match(/[a-z]+/)) strength += 1; // has lowercase
            if(val.match(/[A-Z]+/)) strength += 1; // has uppercase
            if(val.match(/[$@#&!]+/)) strength += 1;

            let width = '0%';
            let color = '#e2e8f0';
            let text = 'Min 8 chars, numbers & symbols recommended';

            switch(strength) {
                case 0:
                case 1: width = '20%'; color = '#ef4444'; text = 'Weak'; break;
                case 2: width = '40%'; color = '#f97316'; text = 'Fair'; break;
                case 3: width = '60%'; color = '#eab308'; text = 'Good'; break;
                case 4: width = '80%'; color = '#84cc16'; text = 'Strong'; break;
                case 5: width = '100%'; color = '#22c55e'; text = 'Very Strong'; break;
            }

            strengthBar.style.width = width;
            strengthBar.style.backgroundColor = color;
            passwordFeedback.textContent = text;
            passwordFeedback.style.color = strength < 2 ? '#ef4444' : (strength < 4 ? '#eab308' : '#22c55e');
        });

        // Password Match
        const confirmInput = document.getElementById('password_confirmation');
        const matchFeedback = document.getElementById('matchFeedback');

        function checkMatch() {
            if(confirmInput.value.length > 0) {
                if(passwordInput.value === confirmInput.value) {
                    matchFeedback.textContent = 'Passwords match';
                    matchFeedback.className = 'text-xs mt-1 text-green-600 block';
                } else {
                    matchFeedback.textContent = 'Passwords do not match';
                    matchFeedback.className = 'text-xs mt-1 text-red-500 block';
                }
            } else {
                matchFeedback.classList.add('hidden');
            }
        }

        passwordInput.addEventListener('input', checkMatch);
        confirmInput.addEventListener('input', checkMatch);
    });
</script>
@endsection
