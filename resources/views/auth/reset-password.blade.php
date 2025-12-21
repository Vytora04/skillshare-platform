@extends('layouts.auth')

@section('title', 'Reset Password - SkillBridge')

@section('form-content')
<div class="glass-box px-8 py-8 relative w-full max-w-[400px] mx-auto" style="min-height: 500px;">
    {{-- Back Button --}}
    <a href="{{ route('login') }}" class="absolute top-6 left-6 flex items-center gap-1 text-slate-500 hover:text-teal-600 transition group">
        <i class='bx bx-arrow-back text-xl group-hover:-translate-x-1 transition-transform'></i>
        <span class="text-sm font-medium">Back</span>
    </a>

    <div>
        <h2 class="text-2xl font-bold form-title text-center mb-6 leading-tight">Reset Password</h2>
        
        @if ($errors->any())
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Email (Read-Only) -->
            <div class="input-group mb-6">
                <input type="email" name="email" id="email" class="input-field bg-slate-50/50" value="{{ $email ?? old('email') }}" readonly required>
                <label for="email" class="floating-label">Email Address</label>
                <i class='bx bx-envelope input-icon'></i>
            </div>

            <!-- New Password -->
            <div class="input-group mb-6">
                <input type="password" name="password" id="password" class="input-field" placeholder=" " required autofocus>
                <label for="password" class="floating-label">New Password</label>
                <i class='bx bx-lock-alt input-icon'></i>
                <i class='bx bx-show absolute right-4 top-[25px] transform -translate-y-1/2 text-gray-400 cursor-pointer hover:text-teal-600 transition-colors text-xl toggle-password' data-target="password"></i>
            </div>

            <!-- Confirm Password -->
            <div class="input-group mb-8">
                <input type="password" name="password_confirmation" id="password_confirmation" class="input-field" placeholder=" " required>
                <label for="password_confirmation" class="floating-label">Confirm Password</label>
                <i class='bx bx-check-shield input-icon'></i>
                <i class='bx bx-show absolute right-4 top-[25px] transform -translate-y-1/2 text-gray-400 cursor-pointer hover:text-teal-600 transition-colors text-xl toggle-password' data-target="password_confirmation"></i>
            </div>

            <button type="submit" class="btn-submit shadow-lg hover:shadow-teal-500/30">
                Reset Password
            </button>
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
