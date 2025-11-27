@extends('layouts.app')

@section('title', 'Projects - SkillShare')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-green-600 to-blue-600 text-white py-16">
    <div class="max-w-6xl mx-auto text-center px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Explore Impact Projects</h1>
        <p class="text-lg md:text-xl mb-8 text-green-100">
            Discover opportunities to contribute your skills to meaningful social impact initiatives.
        </p>
        <div class="flex justify-center gap-4">
            <a href="{{ route('register') }}" 
               class="bg-white text-green-700 font-semibold px-6 py-3 rounded-lg shadow hover:bg-green-100 transition">
               Start Contributing
            </a>
        </div>
    </div>
</section>

<!-- Projects Grid -->
<section class="py-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Available Projects</h2>
            <div class="flex gap-4">
                <select class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option>All Categories</option>
                    <option>Education</option>
                    <option>Healthcare</option>
                    <option>Environment</option>
                    <option>Technology</option>
                </select>
                <select class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option>All Skills</option>
                    <option>Web Development</option>
                    <option>Design</option>
                    <option>Marketing</option>
                    <option>Project Management</option>
                </select>
            </div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Sample Project 1 -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow p-6">
                <div class="flex items-start justify-between mb-4">
                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Education</span>
                    <span class="text-sm text-gray-500">2 days ago</span>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-gray-800">Digital Literacy Program</h3>
                <p class="text-gray-600 mb-4">Help design and develop an online learning platform for underserved communities to improve digital skills.</p>
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded">Web Development</span>
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded">UI/UX Design</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500">Remote</span>
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Learn More →</a>
                </div>
            </div>

            <!-- Sample Project 2 -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow p-6">
                <div class="flex items-start justify-between mb-4">
                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Environment</span>
                    <span class="text-sm text-gray-500">1 week ago</span>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-gray-800">Climate Action Mobile App</h3>
                <p class="text-gray-600 mb-4">Build a mobile application to help communities track and reduce their carbon footprint.</p>
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded">Mobile Development</span>
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded">Data Analysis</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500">Hybrid</span>
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Learn More →</a>
                </div>
            </div>

            <!-- Sample Project 3 -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow p-6">
                <div class="flex items-start justify-between mb-4">
                    <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded">Healthcare</span>
                    <span class="text-sm text-gray-500">3 days ago</span>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-gray-800">Mental Health Support Platform</h3>
                <p class="text-gray-600 mb-4">Create a platform connecting mental health professionals with communities in need of support.</p>
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded">Full Stack Development</span>
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded">Healthcare Experience</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500">Remote</span>
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Learn More →</a>
                </div>
            </div>
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-12">
            <a href="{{ route('skill-posts.index') }}"
            class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
            Load More Projects
            </a>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Have a Project Idea?</h2>
        <p class="text-lg text-gray-600 mb-8">
            If you're working on a social impact project and need help, share it with our community of skilled volunteers.
        </p>
        <a href="{{ route('register') }}" 
           class="bg-green-600 text-white px-8 py-3 rounded-lg font-semibold shadow hover:bg-green-700 transition">
           Post Your Project
        </a>
    </div>
</section>
@endsection