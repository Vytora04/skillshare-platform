<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SkillShare')</title>
    @vite('resources/css/app.css')
</head>
<body class="antialiased text-gray-900">
    <nav class="bg-white shadow py-4">
        <div class="max-w-6xl mx-auto flex justify-between items-center px-4">
            <a href="{{ url('/') }}" class="text-2xl font-bold text-blue-600">SkillShare</a>
            <div class="flex gap-4">
                <a href="{{ route('projects.index') }}" class="text-gray-700 hover:text-blue-600">Projects</a>
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Login</a>
                <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Register</a>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
</body>
</html>
