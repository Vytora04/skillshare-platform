@extends('layouts.app')

@section('title', 'SkillShare for Social Impact')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-20">
    <div class="max-w-6xl mx-auto text-center px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Empowering Partnerships through Shared Skills</h1>
        <p class="text-lg md:text-xl mb-8 text-blue-100">
            Connect with changemakers, NGOs, and volunteers to collaborate on social-impact projects that matter.
        </p>
        <div class="flex justify-center gap-4">
            <a href="{{ route('register') }}" 
               class="bg-white text-blue-700 font-semibold px-6 py-3 rounded-lg shadow hover:bg-blue-100 transition">
               Get Started
            </a>
            <a href="{{ route('projects.index') }}" 
               class="border border-white text-white px-6 py-3 rounded-lg hover:bg-white hover:text-blue-700 transition">
               Explore Opportunities
            </a>
            <a href="{{ route('skill-posts.index') }}" class="btn btn-primary mt-3">
                Browse Skill Posts
            </a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-12">How SkillShare Works</h2>
        <div class="grid md:grid-cols-3 gap-10">
            <div class="bg-white p-8 rounded-2xl shadow hover:shadow-lg transition">
                <div class="text-blue-600 mb-4 text-5xl">🧑‍💼</div>
                <h3 class="text-xl font-semibold mb-2">Create Your Profile</h3>
                <p class="text-gray-600">Sign up as a skill provider or seeker. Showcase your expertise or describe the help you need.</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow hover:shadow-lg transition">
                <div class="text-blue-600 mb-4 text-5xl">🤝</div>
                <h3 class="text-xl font-semibold mb-2">Find a Match</h3>
                <p class="text-gray-600">Discover partners based on shared skills, goals, or SDG focus areas. Build collaborations effortlessly.</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow hover:shadow-lg transition">
                <div class="text-blue-600 mb-4 text-5xl">🌍</div>
                <h3 class="text-xl font-semibold mb-2">Create Impact</h3>
                <p class="text-gray-600">Work together on meaningful projects, share outcomes, and inspire others through your achievements.</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto text-center px-4">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Ready to Start Making an Impact?</h2>
        <p class="text-lg text-gray-600 mb-8">
            Whether you want to offer your skills or find help for your project, SkillShare makes collaboration easy and meaningful.
        </p>
        <a href="{{ route('register') }}" 
           class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold shadow hover:bg-blue-700 transition">
           Join the Community
        </a>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-900 text-gray-400 py-8">
    <div class="max-w-6xl mx-auto px-4 text-center">
        <p>&copy; {{ date('Y') }} SkillShare for Social Impact. All rights reserved.</p>
        <p class="text-sm text-gray-500 mt-2">Built with Laravel ❤️ to support SDG 17 – Partnerships for the Goals.</p>
    </div>
</footer>
@endsection