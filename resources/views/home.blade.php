@extends('layouts.app', ['fullWidth' => true])

@section('title', 'SkillBridge - Where Skills Meet Purpose')

@section('content')
<!-- New Hero Section -->
<section class="bg-white dark:bg-slate-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-12 py-16 lg:py-24 items-center">
        <div class="text-center lg:text-left">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                Where <span class="text-teal-500">Skills</span> Meet <span class="text-teal-500">Purpose</span>
            </h1>
            <p class="mt-6 text-lg text-gray-600 dark:text-slate-300">
                A community for professionals, students, and NGOs to collaborate on projects that drive meaningful social change.
            </p>
            <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                <a href="{{ route('register') }}"
                   class="inline-block bg-teal-600 text-white font-semibold px-8 py-3 rounded-lg shadow-lg hover:bg-teal-700 transition-transform transform hover:-translate-y-1">
                   Offer My Skills
                </a>
                <a href="{{ route('skill-posts.index') }}"
                   class="inline-block bg-slate-200 text-slate-800 font-semibold px-8 py-3 rounded-lg hover:bg-gray-300 transition">
                   Find a Partner
                </a>
            </div>
        </div>
        <div class="hidden lg:block bg-teal-50 p-8 rounded-2xl">
            <div class="w-full h-80 bg-teal-200 rounded-lg flex items-center justify-center">
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.356a1.76 1.76 0 013.417-.592V5.882z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 5.882V19.24a1.76 1.76 0 003.417.592l2.147-6.356a1.76 1.76 0 00-3.417-.592V5.882z" />
                </svg>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="bg-slate-50 dark:bg-slate-800 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <h3 class="text-3xl font-bold text-teal-600">150+</h3>
                <p class="mt-1 text-slate-600 dark:text-slate-400">Projects Launched</p>
            </div>
            <div>
                <h3 class="text-3xl font-bold text-teal-600">300+</h3>
                <p class="mt-1 text-slate-600 dark:text-slate-400">Volunteers Engaged</p>
            </div>
            <div>
                <h3 class="text-3xl font-bold text-teal-600">20+</h3>
                <p class="mt-1 text-slate-600 dark:text-slate-400">Organizations Partnered</p>
            </div>
             <div>
                <h3 class="text-3xl font-bold text-teal-600">12</h3>
                <p class="mt-1 text-slate-600 dark:text-slate-400">SDGs Supported</p>
            </div>
        </div>
    </div>
</section>

<!-- How it Works (Zig-Zag) -->
<section class="bg-white dark:bg-slate-950 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white">A Simple Path to Impact</h2>
            <p class="mt-4 text-lg text-gray-600 dark:text-slate-300">Three steps to successful collaboration.</p>
        </div>

        <!-- Step 1 -->
        <div class="grid lg:grid-cols-2 gap-12 items-center mb-16">
            <div class="bg-white dark:bg-slate-800 rounded-lg p-8">
                 <div class="w-full h-64 bg-slate-100 dark:bg-slate-700 rounded-lg flex items-center text-slate-400">Placeholder Image</div>
            </div>
            <div>
                <span class="inline-block bg-teal-100 text-teal-800 text-xs font-semibold px-3 py-1 rounded-full mb-3">Step 1</span>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white">Post Your Skill or Need</h3>
                <p class="mt-4 text-gray-600 dark:text-slate-400">Create a detailed listing for the skills you can offer or the expertise you need for your project. Be clear about your goals and expectations.</p>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="grid lg:grid-cols-2 gap-12 items-center mb-16">
            <div class="order-last lg:order-first">
                <span class="inline-block bg-teal-100 text-teal-800 text-xs font-semibold px-3 py-1 rounded-full mb-3">Step 2</span>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white">Discover & Connect</h3>
                <p class="mt-4 text-gray-600 dark:text-slate-400">Our platform helps you find the right match based on skills and shared values. Send an invitation to start a conversation.</p>
            </div>
             <div class="bg-white dark:bg-slate-800 rounded-lg p-8">
                 <div class="w-full h-64 bg-slate-100 dark:bg-slate-700 rounded-lg flex items-center text-slate-400">Placeholder Image</div>
            </div>
        </div>
        
        <!-- Step 3 -->
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="bg-white dark:bg-slate-800 rounded-lg p-8">
                 <div class="w-full h-64 bg-slate-100 dark:bg-slate-700 rounded-lg flex items-center text-slate-400">Placeholder Image</div>
            </div>
            <div>
                <span class="inline-block bg-teal-100 text-teal-800 text-xs font-semibold px-3 py-1 rounded-full mb-3">Step 3</span>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white">Collaborate & Achieve</h3>
                <p class="mt-4 text-gray-600 dark:text-slate-400">Use our dedicated project rooms to manage tasks, share files, and bring your project to life. Track your impact and build your portfolio.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="bg-teal-600 text-white py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-12">Trusted by Changemakers</h2>
        <div class="relative">
            <blockquote class="text-2xl font-semibold italic">
                <p>"SkillBridge was the missing piece for our project. We found a talented web developer in just a few days who helped us relaunch our non-profit's website."</p>
            </blockquote>
            <cite class="mt-6 block font-medium text-teal-100">
                - Jane Doe, Director at GreenFuture Initiative
            </cite>
        </div>
    </div>
</section>

<!-- Final CTA Section -->
<section class="bg-white dark:bg-slate-950 py-20">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white">Ready to Make a Difference?</h2>
        <p class="mt-4 text-lg text-gray-600 dark:text-slate-300">
            Join a growing network of purpose-driven individuals and organizations.
        </p>
        <div class="mt-8">
            <a href="{{ route('register') }}"
               class="inline-block bg-teal-600 text-white font-semibold px-10 py-4 rounded-lg shadow-lg hover:bg-teal-700 transition-transform transform hover:-translate-y-1">
               Join The Community
            </a>
        </div>
    </div>
</section>

<!-- Footer -->
<!-- Footer -->

@endsection