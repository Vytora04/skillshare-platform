<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SkillBridge')</title>
    @vite('resources/css/app.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/SkillBridge Logo.png') }}" type="image/png">
</head>
<body class="antialiased text-slate-900 bg-slate-50 dark:bg-slate-950 dark:text-slate-200 min-h-screen flex flex-col">
    <nav class="bg-white border-b border-slate-200 py-4 dark:bg-slate-900 dark:border-slate-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-4">

            {{-- Left Side: Logo & Links --}}
            <div class="flex gap-6 items-center">
                <a href="{{ url('/') }}" class="flex items-center gap-2">
                    <img src="{{ asset('images/SkillBridge Logo.png') }}" alt="SkillBridge Logo" class="h-8 w-auto">
                    <span class="text-2xl font-bold text-teal-600 dark:text-teal-500">SkillBridge</span>
                </a>
                <a href="{{ route('projects.index') }}" class="text-gray-700 hover:text-teal-600 dark:text-gray-300 dark:hover:text-white">Projects</a>
                <a href="{{ route('skill-posts.index') }}" class="text-gray-700 hover:text-teal-600 dark:text-gray-300 dark:hover:text-white">Skill Posts</a>
                <a href="{{ route('about') }}" class="text-gray-700 hover:text-teal-600 dark:text-gray-300 dark:hover:text-white">About</a>
            
                @auth
                    <a href="{{ route('invitations.index') }}" class="text-gray-700 hover:text-teal-600 dark:text-gray-300 dark:hover:text-white">Invitations</a>
                @endauth
            
                {{-- Staff Panel Link (visible to admins and moderators) --}}
                @auth
                    @if(Auth::user()->isStaff())
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-teal-600 dark:text-gray-300 dark:hover:text-white font-semibold">Staff Panel</a>
                    @endif
                @endauth
            </div>

            {{-- Right Side: Authentication Logic --}}
            <div class="flex items-center gap-4">
                @auth
                    {{-- STATE 1: User is Logged In --}}
                    <a href="{{ route('profile.show') }}" class="text-gray-700 hover:text-teal-600 dark:text-gray-300 dark:hover:text-white font-medium">
                        {{ Auth::user()->name }}
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700 dark:hover:text-red-400 font-semibold ml-4">
                            Log Out
                        </button>
                    </form>

                @else
                    {{-- STATE 2: User is NOT Logged In (Show the nice buttons here) --}}
                    <a href="{{ route('login') }}" class="border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:border-teal-600 hover:text-teal-600 dark:border-gray-600 dark:text-gray-300 dark:hover:border-teal-500 dark:hover:text-teal-500 transition">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}" class="bg-teal-600 text-white px-4 py-2 rounded-lg hover:bg-teal-700 transition">
                        Sign Up
                    </a>
                @endauth
            </div>

        </div>
    </nav>

    <main class="{{ $fullWidth ?? false ? '' : 'py-8' }} flex-grow">
        @if($fullWidth ?? false)
            @yield('content')
        @else
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        @endif
    </main>

    @include('layouts.footer')

    {{-- Floating action button: quick access to create a skill post --}}
    @auth
        <a href="{{ route('skill-posts.create') }}" aria-label="Create skill post"
           class="fixed bottom-6 right-6 z-50 bg-green-600 hover:bg-green-700 text-white rounded-full p-4 shadow-lg flex items-center justify-center transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
        </a>
    @else
        <a href="{{ route('register') }}" aria-label="Sign up to create a post"
           class="fixed bottom-6 right-6 z-50 bg-teal-600 hover:bg-teal-700 text-white rounded-full p-4 shadow-lg flex items-center justify-center transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
        </a>
    @endauth

    <script>
        // Fallback logout via fetch to avoid unexpected form submission issues
        (function(){
            const logoutForm = document.querySelector('form[action="{{ route('logout') }}"][method="POST"]');
            if (!logoutForm) return;

            logoutForm.addEventListener('submit', function(e){
                // Let the normal form submit proceed if JS wants to; instead prevent and use fetch
                e.preventDefault();

                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch('{{ route('logout') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({})
                }).then(resp => {
                    // redirect to home after logout
                    window.location = '/';
                }).catch(err => {
                    // if fetch fails, fallback to normal form submit
                    logoutForm.submit();
                });
            });
        })();
    </script>

</body>
</html>
