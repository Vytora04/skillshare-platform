@extends('layouts.app')

@section('title', 'About Us - SkillBridge')

@section('content')
<div class="bg-white dark:bg-slate-900">
    
    <!-- Hero Section -->
    <div class="relative bg-slate-900 overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-r from-teal-900/90 to-slate-900/90 mix-blend-multiply"></div>
            <!-- Decorative background pattern -->
            <svg class="absolute bottom-0 right-0 transform translate-x-1/2 translate-y-1/2 opacity-20" width="404" height="404" fill="none" viewBox="0 0 404 404" aria-hidden="true">
                <defs>
                    <pattern id="85737c0e-0916-41d7-917f-596dc7edfa27" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                        <rect x="0" y="0" width="4" height="4" class="text-teal-500" fill="currentColor" />
                    </pattern>
                </defs>
                <rect width="404" height="404" fill="url(#85737c0e-0916-41d7-917f-596dc7edfa27)" />
            </svg>
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
                Empowering Change Through <span class="text-teal-400">Connection</span>
            </h1>
            <p class="mt-6 text-xl text-slate-300 max-w-3xl mx-auto">
                SkillBridge connects passionate volunteers with non-profits and community organizations to solve real-world problems and drive social impact.
            </p>
        </div>
    </div>

    <!-- Our Mission Section -->
    <div class="py-16 bg-white dark:bg-slate-900 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-center">
                <div>
                    <h2 class="text-base font-semibold text-teal-600 dark:text-teal-400 tracking-wide uppercase">Our Mission</h2>
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-4xl">
                        Bridging the Skills Gap
                    </p>
                    <p class="mt-4 text-lg text-slate-500 dark:text-slate-400">
                        We believe that everyone has a skill that can change the world. Our mission is to democratize access to professional expertise for organizations that are working to make our planet a better place. By facilitating meaningful connections, we accelerate progress towards the Sustainable Development Goals (SDGs).
                    </p>
                    <div class="mt-8 flex gap-4">
                        <div class="flex items-center gap-2 text-slate-700 dark:text-slate-300">
                            <svg class="h-6 w-6 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Verified NGOs</span>
                        </div>
                        <div class="flex items-center gap-2 text-slate-700 dark:text-slate-300">
                             <svg class="h-6 w-6 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Skilled Volunteers</span>
                        </div>
                    </div>
                </div>
                <div class="mt-12 lg:mt-0 relative">
                    <div class="absolute inset-0 bg-teal-200 rounded-3xl transform rotate-3 scale-105 opacity-20"></div>
                     <!-- Placeholder for an "About Us" image -->
                    <div class="relative bg-slate-800 rounded-3xl overflow-hidden shadow-xl aspect-video flex items-center justify-center group">
                        <!-- We use a gradient and icon as a placeholder if no image is provided, 
                             but here we simulate a team/collaboration photo area -->
                        <div class="text-center p-8">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-teal-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <p class="text-slate-400 font-medium">Community Collaboration</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Impact Stats -->
    <div class="bg-teal-700">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:py-16 sm:px-6 lg:px-8 lg:py-20 text-center">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                Our Impact So Far
            </h2>
            <div class="mt-10 grid grid-cols-1 gap-8 sm:grid-cols-3">
                <div>
                    <div class="text-5xl font-extrabold text-teal-200">100+</div>
                    <div class="mt-2 text-lg font-medium text-teal-100">Projects Completed</div>
                </div>
                <div>
                    <div class="text-5xl font-extrabold text-teal-200">10k+</div>
                    <div class="mt-2 text-lg font-medium text-teal-100">Volunteer Hours</div>
                </div>
                <div>
                    <div class="text-5xl font-extrabold text-teal-200">50+</div>
                    <div class="mt-2 text-lg font-medium text-teal-100">NGO Partners</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Section -->
    <div class="py-16 bg-slate-50 dark:bg-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-base font-semibold text-teal-600 dark:text-teal-400 tracking-wide uppercase">The Team</h2>
            <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-4xl">
                Builders & Dreamers
            </p>
            <div class="mt-12 flex flex-wrap justify-center gap-12">
                
                <!-- Fahim (Lead) -->
                <div class="group">
                    <img class="mx-auto h-40 w-40 rounded-full xl:w-56 xl:h-56 object-cover shadow-lg border-4 border-white dark:border-slate-700 group-hover:border-teal-500 transition" src="https://ui-avatars.com/api/?name=Fahim+L&background=0D9488&color=fff&size=256" alt="">
                    <div class="mt-4">
                        <h3 class="text-lg leading-6 font-medium text-slate-900 dark:text-white">Fahimsyach Lokanta</h3>
                        <p class="text-sm text-teal-600 dark:text-teal-400">Team Lead & Full Stack Developer</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Architected the core system and led the development vision.</p>
                    </div>
                </div>

                <!-- Nathanael (Frontend + Hosting) -->
                <div class="group">
                    <img class="mx-auto h-40 w-40 rounded-full xl:w-56 xl:h-56 object-cover shadow-lg border-4 border-white dark:border-slate-700 group-hover:border-teal-500 transition" src="https://ui-avatars.com/api/?name=Nathanael+R&background=random&color=fff&size=256" alt="">
                    <div class="mt-4">
                        <h3 class="text-lg leading-6 font-medium text-slate-900 dark:text-white">Nathanael Reinhart</h3>
                        <p class="text-sm text-teal-600 dark:text-teal-400">Frontend Lead & DevOps</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Crafted the user interface and managed cloud deployment.</p>
                    </div>
                </div>

                <!-- Darren (Backend) -->
                <div class="group">
                    <img class="mx-auto h-40 w-40 rounded-full xl:w-56 xl:h-56 object-cover shadow-lg border-4 border-white dark:border-slate-700 group-hover:border-teal-500 transition" src="https://ui-avatars.com/api/?name=Darren+N&background=random&color=fff&size=256" alt="">
                    <div class="mt-4">
                        <h3 class="text-lg leading-6 font-medium text-slate-900 dark:text-white">Darren Nicholas Suwito</h3>
                        <p class="text-sm text-teal-600 dark:text-teal-400">Backend Specialist</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Optimized database performance and server-side logic.</p>
                    </div>
                </div>

                <!-- Christopher (Documentation/PM) -->
                <div class="group">
                    <img class="mx-auto h-40 w-40 rounded-full xl:w-56 xl:h-56 object-cover shadow-lg border-4 border-white dark:border-slate-700 group-hover:border-teal-500 transition" src="https://ui-avatars.com/api/?name=Christopher+A&background=random&color=fff&size=256" alt="">
                    <div class="mt-4">
                        <h3 class="text-lg leading-6 font-medium text-slate-900 dark:text-white">Christopher Nicholas Alfen</h3>
                        <p class="text-sm text-teal-600 dark:text-teal-400">Project Manager & Strategist</p>
                         <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Oversaw project roadmap, reporting, and presentation strategy.</p>
                    </div>
                </div>

                 <!-- Wilbert (QA - The "lie" role) -->
                 <div class="group">
                    <img class="mx-auto h-40 w-40 rounded-full xl:w-56 xl:h-56 object-cover shadow-lg border-4 border-white dark:border-slate-700 group-hover:border-teal-500 transition" src="https://ui-avatars.com/api/?name=Wilbert+K&background=random&color=fff&size=256" alt="">
                    <div class="mt-4">
                        <h3 class="text-lg leading-6 font-medium text-slate-900 dark:text-white">Wilbert Devoss Kyenil</h3>
                        <p class="text-sm text-teal-600 dark:text-teal-400">QA Specialist & Research</p>
                         <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Ensured application stability and conducted feature research.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
