@extends('layouts.auth')

@section('title', 'Verify Email - SkillBridge')

@section('form-content')
<div class="glass-box px-8 py-8 relative w-full max-w-[400px] mx-auto" style="min-height: 400px;">
    
    <div>
        <div class="mb-6 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-teal-100 text-teal-600 mb-4">
                <i class='bx bx-envelope text-3xl'></i>
            </div>
            <h2 class="text-2xl font-bold form-title mb-2 leading-tight">Verify Email</h2>
        </div>

        <p class="text-center text-slate-500 mb-8 text-sm leading-relaxed">
            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-6 bg-teal-100 border border-teal-400 text-teal-700 px-4 py-3 rounded-lg text-sm flex items-center gap-2">
                <i class='bx bx-check-circle text-xl'></i>
                <span>A new verification link has been sent to your email address.</span>
            </div>
        @endif

        <div class="space-y-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn-submit shadow-lg hover:shadow-teal-500/30">
                    Resend Verification Email
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="text-center">
                @csrf
                <button type="submit" class="text-sm font-medium text-slate-500 hover:text-red-500 transition flex items-center justify-center gap-1 mx-auto">
                    <i class='bx bx-log-out'></i> Log Out
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
