@extends('layouts.app')

@section('title', 'Project Room - Literacy App Development')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Project Header -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 mb-8 shadow-sm border border-slate-200 dark:border-slate-700">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="px-3 py-1 text-xs font-semibold bg-blue-100 text-blue-700 rounded-full dark:bg-blue-900 dark:text-blue-300">In Progress</span>
                        <span class="text-slate-500 dark:text-slate-400 text-sm">Started Oct 24, 2025</span>
                    </div>
                    <h1 class="text-3xl font-bold text-slate-800 dark:text-white">Literacy App Development</h1>
                    <p class="text-slate-600 dark:text-slate-400 mt-2 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd" />
                        </svg>
                        GreenEarth NGO
                    </p>
                </div>
                
                <div class="w-full md:w-64">
                    <div class="flex justify-between text-sm mb-2">
                        <span class="font-semibold text-slate-700 dark:text-slate-300">Project Progress</span>
                        <span class="font-bold text-teal-600 dark:text-teal-400">75%</span>
                    </div>
                    <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-3">
                        <div class="bg-teal-500 h-3 rounded-full transition-all duration-500" style="width: 75%"></div>
                    </div>
                    <p class="text-xs text-slate-500 mt-2 text-right">3 of 4 Milestones Completed</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column (Tasks & Timeline) -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Navigation Tabs -->
                <div class="border-b border-slate-200 dark:border-slate-700">
                    <nav class="-mb-px flex space-x-8">
                        <a href="#" class="border-teal-500 text-teal-600 dark:text-teal-400 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Tasks & Milestones
                        </a>
                        <a href="#" class="border-transparent text-slate-500 dark:text-slate-400 hover:text-slate-700 hover:border-slate-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            files
                        </a>
                        <a href="#" class="border-transparent text-slate-500 dark:text-slate-400 hover:text-slate-700 hover:border-slate-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Discussions
                        </a>
                    </nav>
                </div>

                <!-- Milestone: Design Phase (Completed) -->
                <div class="opacity-75">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="bg-green-100 dark:bg-green-900 p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-200 line-through">Phase 1: UI/UX Design</h3>
                        <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">Completed</span>
                    </div>
                </div>

                <!-- Milestone: Development (Active) -->
                <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-sm border-l-4 border-teal-500">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-xl font-bold text-slate-800 dark:text-white">Phase 2: Core Development</h3>
                            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Due: Dec 25, 2025</p>
                        </div>
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">Current Focus</span>
                    </div>

                    <div class="space-y-3">
                        <label class="flex items-center p-3 hover:bg-slate-50 dark:hover:bg-slate-700/50 rounded-lg cursor-pointer transition">
                            <input type="checkbox" checked disabled class="w-5 h-5 text-teal-600 rounded border-gray-300 focus:ring-teal-500 bg-gray-100">
                            <span class="ml-3 text-slate-500 line-through">Setup Laravel Environment</span>
                        </label>
                        
                        <label class="flex items-center p-3 hover:bg-slate-50 dark:hover:bg-slate-700/50 rounded-lg cursor-pointer transition">
                            <input type="checkbox" checked disabled class="w-5 h-5 text-teal-600 rounded border-gray-300 focus:ring-teal-500 bg-gray-100">
                            <span class="ml-3 text-slate-500 line-through">Database Migration & Models</span>
                        </label>

                        <label class="flex items-center p-3 bg-teal-50 dark:bg-teal-900/20 border border-teal-100 dark:border-teal-800 rounded-lg cursor-pointer transition">
                            <input type="checkbox" class="w-5 h-5 text-teal-600 rounded border-gray-300 focus:ring-teal-500">
                            <span class="ml-3 text-slate-800 dark:text-white font-medium">Implement User Authentication</span>
                            <div class="ml-auto flex items-center">
                                <img src="https://ui-avatars.com/api/?name=Fahim&background=0D9488&color=fff" class="w-6 h-6 rounded-full" title="Assigned to You">
                            </div>
                        </label>

                        <label class="flex items-center p-3 hover:bg-slate-50 dark:hover:bg-slate-700/50 rounded-lg cursor-pointer transition">
                            <input type="checkbox" class="w-5 h-5 text-teal-600 rounded border-gray-300 focus:ring-teal-500">
                            <span class="ml-3 text-slate-700 dark:text-slate-300">API Documentation</span>
                        </label>
                    </div>
                </div>

                <!-- Milestone: Testing (Future) -->
                <div class="opacity-60">
                     <div class="flex items-center gap-4 mt-6">
                        <div class="bg-slate-100 dark:bg-slate-700 p-2 rounded-full border border-slate-300 dark:border-slate-600">
                             <div class="w-6 h-6 flex items-center justify-center font-bold text-slate-500">3</div>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-200">Phase 3: Testing & QA</h3>
                    </div>
                </div>

            </div>

            <!-- Right Column (Team & Chat) -->
            <div class="space-y-8">
                
                <!-- Team Members Card -->
                <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-sm border border-slate-200 dark:border-slate-700">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-slate-800 dark:text-white">Team Members</h3>
                        <button class="text-teal-600 text-sm hover:underline">Invite</button>
                    </div>
                    
                    <div class="space-y-4">
                        <!-- Member 1 -->
                        <div class="flex items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name=Admin&background=random" class="w-10 h-10 rounded-full">
                            <div>
                                <p class="text-sm font-semibold text-slate-800 dark:text-white">Sarah Jenkins</p>
                                <p class="text-xs text-slate-500">Project Lead (NGO)</p>
                            </div>
                        </div>

                         <!-- Member 2 (You) -->
                        <div class="flex items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name=Fahim&background=0D9488&color=fff" class="w-10 h-10 rounded-full border-2 border-teal-500">
                            <div>
                                <p class="text-sm font-semibold text-slate-800 dark:text-white">Fahim Syach (You)</p>
                                <p class="text-xs text-slate-500">Full Stack Developer</p>
                            </div>
                        </div>

                         <!-- Member 3 -->
                        <div class="flex items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name=Darren&background=random" class="w-10 h-10 rounded-full">
                            <div>
                                <p class="text-sm font-semibold text-slate-800 dark:text-white">Darren Nicholas</p>
                                <p class="text-xs text-slate-500">UI/UX Designer</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mini Chat -->
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden flex flex-col h-[400px]">
                    <div class="p-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50">
                        <h3 class="font-bold text-slate-800 dark:text-white">Discussion</h3>
                    </div>
                    
                    <div class="flex-1 p-4 overflow-y-auto space-y-4 bg-slate-50 dark:bg-slate-900/50">
                        <!-- Message Received -->
                        <div class="flex items-start gap-2">
                             <img src="https://ui-avatars.com/api/?name=Sarah&background=random" class="w-6 h-6 rounded-full mt-1">
                             <div class="bg-white dark:bg-slate-700 p-2 rounded-lg rounded-tl-none shadow-sm max-w-[85%]">
                                 <p class="text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Sarah</p>
                                 <p class="text-sm text-slate-600 dark:text-slate-200">Hey guys, the new designs for the dashboard are uploaded!</p>
                             </div>
                        </div>

                        <!-- Message Sent -->
                        <div class="flex items-start gap-2 flex-row-reverse">
                             <img src="https://ui-avatars.com/api/?name=Fahim&background=0D9488&color=fff" class="w-6 h-6 rounded-full mt-1">
                             <div class="bg-teal-600 text-white p-2 rounded-lg rounded-tr-none shadow-sm max-w-[85%]">
                                 <p class="text-sm">Awesome, I'll take a look tonight and update the frontend.</p>
                             </div>
                        </div>
                    </div>

                    <div class="p-3 border-t border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800">
                        <div class="flex gap-2">
                            <input type="text" placeholder="Type a message..." class="flex-1 bg-slate-100 dark:bg-slate-900 border-0 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-teal-500">
                            <button class="bg-teal-600 text-white p-2 rounded-lg hover:bg-teal-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
