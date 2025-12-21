@extends('layouts.auth')

@section('title', 'Forgot Password - SkillBridge')

@section('form-content')
<div class="glass-box px-8 py-6 relative w-full max-w-[400px] mx-auto" style="min-height: 400px;">
    {{-- Back Button --}}
    <a href="{{ route('login') }}" class="absolute top-6 left-6 flex items-center gap-1 text-slate-500 hover:text-teal-600 transition group">
        <i class='bx bx-arrow-back text-xl group-hover:-translate-x-1 transition-transform'></i>
        <span class="text-sm font-medium">Back</span>
    </a>

    <div>
        <h2 class="text-2xl font-bold form-title text-center mb-3 leading-tight">Forgot Password?</h2>
        <p class="block text-center text-slate-500 mb-2 text-sm mx-auto leading-relaxed">
            Enter your email and we'll send you a <br> link to reset your password.
        </p>
        <div class="h-6"></div>

        {{-- Success Message --}}
        @if (session('status'))
            <div class="mb-6 bg-teal-100 border border-teal-400 text-teal-700 px-4 py-3 rounded-lg text-sm flex items-center gap-2">
                <i class='bx bx-check-circle text-xl'></i>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        {{-- Error Message --}}
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email -->
            <div class="input-group mb-6">
                <input type="email" name="email" id="email" class="input-field" placeholder=" " value="{{ old('email') }}" required autofocus>
                <label for="email" class="floating-label">Email Address</label>
                <i class='bx bx-envelope input-icon'></i>
            </div>

            <button type="submit" class="btn-submit shadow-lg hover:shadow-teal-500/30">
                Send Reset Link
            </button>
        </form>
    </div>
</div>
@endsection
