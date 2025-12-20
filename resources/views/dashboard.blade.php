@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Welcome Section -->
        <div class="mb-8 flex justify-between items-end">
            <div>
                <h1 class="text-3xl font-bold text-slate-800 dark:text-white">Welcome back, {{ Auth::user()->name }}! 👋</h1>
                <p class="text-slate-600 dark:text-slate-400 mt-2">Here's what's happening with your impact journey.</p>
            </div>
            <a href="{{ route('skill-posts.create') }}" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2.5 rounded-lg font-semibold shadow-lg transition flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                New Post
            </a>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-teal-100 dark:bg-teal-900/50 text-teal-600 dark:text-teal-400 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Active Projects</p>
                        <h3 class="text-2xl font-bold text-slate-800 dark:text-white">3</h3>
                    </div>
                </div>
            </div>
            
            <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Volunteer Hours</p>
                        <h3 class="text-2xl font-bold text-slate-800 dark:text-white">12.5</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-purple-100 dark:bg-purple-900/50 text-purple-600 dark:text-purple-400 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Impact Score</p>
                        <h3 class="text-2xl font-bold text-slate-800 dark:text-white">850</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Matches & Feed -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Smart Matches -->
                <section>
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold text-slate-800 dark:text-white">Recommended for You</h2>
                        <span class="text-xs font-semibold bg-teal-100 text-teal-800 px-2 py-1 rounded">Based on your skills</span>
                    </div>
                    <div class="space-y-4">
                        <!-- Match Card 1 -->
                        <div class="bg-white dark:bg-slate-800 p-5 rounded-lg border border-slate-100 dark:border-slate-700 hover:border-teal-500 transition cursor-pointer group">
                            <div class="flex justify-between items-start">
                                <div>
                                    <span class="text-xs font-bold text-teal-600 dark:text-teal-400 uppercase tracking-wide">Web Development</span>
                                    <h3 class="text-lg font-bold text-slate-800 dark:text-white mt-1 group-hover:text-teal-600 transition">Non-Profit Website Redesign</h3>
                                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-2">Help "Ocean Guardians" build a new landing page to showcase their cleanup efforts.</p>
                                    <div class="flex gap-2 mt-3">
                                        <span class="text-xs bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 px-2 py-1 rounded">Laravel</span>
                                        <span class="text-xs bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 px-2 py-1 rounded">Tailwind</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">Remote</span>
                                    <p class="text-xs text-slate-500 mt-1">5-10 hrs/week</p>
                                </div>
                            </div>
                        </div>

                        <!-- Match Card 2 -->
                        <div class="bg-white dark:bg-slate-800 p-5 rounded-lg border border-slate-100 dark:border-slate-700 hover:border-teal-500 transition cursor-pointer group">
                            <div class="flex justify-between items-start">
                                <div>
                                    <span class="text-xs font-bold text-purple-600 dark:text-purple-400 uppercase tracking-wide">Data Analysis</span>
                                    <h3 class="text-lg font-bold text-slate-800 dark:text-white mt-1 group-hover:text-teal-600 transition">Community Survey Analysis</h3>
                                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-2">Analyze survey data for "Youth Forward" to improve their educational programs.</p>
                                    <div class="flex gap-2 mt-3">
                                        <span class="text-xs bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 px-2 py-1 rounded">Excel</span>
                                        <span class="text-xs bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 px-2 py-1 rounded">Visualization</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">Remote</span>
                                    <p class="text-xs text-slate-500 mt-1">Est. 2 weeks</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Right Column: Sidebar -->
            <div class="space-y-8">
                <!-- Active Project Widget -->
                <div class="bg-teal-900 text-white rounded-xl p-6 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-4 opacity-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg relative z-10">Current Priority</h3>
                    <p class="text-teal-100 text-sm mt-1 relative z-10">Literacy App Development</p>
                    
                    <div class="mt-4 relative z-10">
                        <div class="flex justify-between text-xs mb-1">
                            <span>Progress</span>
                            <span>75%</span>
                        </div>
                        <div class="w-full bg-teal-800 rounded-full h-2">
                            <div class="bg-teal-400 h-2 rounded-full" style="width: 75%"></div>
                        </div>
                    </div>
                    
                    <button class="mt-4 w-full bg-white text-teal-900 py-2 rounded-lg text-sm font-bold hover:bg-teal-50 transition relative z-10">
                        Go to Project Room
                    </button>
                </div>

                <!-- Invites -->
                <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700">
                    <h3 class="font-bold text-slate-800 dark:text-white mb-4">Pending Invitations</h3>
                    <div class="space-y-4">
                         <div class="flex items-start gap-3">
                            <div class="h-10 w-10 bg-slate-200 dark:bg-slate-700 rounded-full flex-shrink-0"></div>
                            <div>
                                <p class="text-sm text-slate-800 dark:text-white"><span class="font-semibold">GreenEarth NGO</span> invited you to a project.</p>
                                <div class="flex gap-2 mt-2">
                                    <button class="text-xs bg-teal-600 text-white px-3 py-1 rounded hover:bg-teal-700">Accept</button>
                                    <button class="text-xs border border-slate-300 dark:border-slate-600 text-slate-600 dark:text-slate-400 px-3 py-1 rounded hover:bg-slate-100 dark:hover:bg-slate-700">Decline</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
