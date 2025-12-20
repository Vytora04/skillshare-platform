@extends('layouts.app', ['fullWidth' => true])

@section('title', 'Projects - SkillBridge')

@section('content')
<!-- Hero Section -->
<div class="relative bg-teal-900 overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-teal-900 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-teal-900 via-teal-900/40"></div>
    </div>
    <div class="relative max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8 text-center text-white">
        <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl">
            Explore Impact Projects
        </h1>
        <p class="mt-4 text-xl text-teal-100 max-w-3xl mx-auto">
            Discover opportunities to contribute your skills to meaningful social impact initiatives.
        </p>
        
        <!-- Search & Filter Bar -->
        <form action="{{ route('projects.index') }}" method="GET" class="mt-10 max-w-4xl mx-auto bg-white dark:bg-slate-800 rounded-xl p-2 shadow-lg flex flex-col md:flex-row gap-2">
            <!-- Persist other params -->
            <input type="hidden" name="sort" value="{{ $sortBy }}">
            <input type="hidden" name="per_page" value="{{ $perPage }}">

            <div class="flex-grow">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="search" id="projectSearchInput" value="{{ $search }}" class="block w-full pl-10 pr-10 py-3 border-0 bg-transparent text-gray-900 dark:text-white placeholder-gray-500 focus:ring-0 sm:text-sm" placeholder="Search by title, keyword, or NGO...">
                    
                    <!-- Clear Button -->
                    <button type="button" id="clearProjectSearch" class="absolute inset-y-0 right-0 pr-3 flex items-center {{ empty($search) ? 'hidden' : '' }}">
                        <svg class="h-5 w-5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const input = document.getElementById('projectSearchInput');
                        const clearBtn = document.getElementById('clearProjectSearch');
                        
                        function toggleClearBtn() {
                            if (input.value.length > 0) {
                                clearBtn.classList.remove('hidden');
                            } else {
                                clearBtn.classList.add('hidden');
                            }
                        }

                        input.addEventListener('input', toggleClearBtn);
                        
                        clearBtn.addEventListener('click', function() {
                            input.value = '';
                            toggleClearBtn();
                            input.focus();
                        });
                    });
                </script>
            </div>
            <div class="flex gap-2">
                <select name="category" class="block w-full sm:w-56 pl-3 pr-10 py-3 text-base border-l border-gray-200 dark:border-slate-700 bg-transparent text-gray-900 dark:text-white focus:outline-none focus:ring-0 sm:text-sm dark:bg-slate-800">
                    <option class="text-gray-900 dark:text-white dark:bg-slate-800" {{ $selectedCategory == 'All Categories' ? 'selected' : '' }}>All Categories</option>
                    <option class="text-gray-900 dark:text-white dark:bg-slate-800" {{ $selectedCategory == 'Education' ? 'selected' : '' }}>Education</option>
                    <option class="text-gray-900 dark:text-white dark:bg-slate-800" {{ $selectedCategory == 'Environment' ? 'selected' : '' }}>Environment</option>
                    <option class="text-gray-900 dark:text-white dark:bg-slate-800" {{ $selectedCategory == 'Health' ? 'selected' : '' }}>Health</option>
                    <option class="text-gray-900 dark:text-white dark:bg-slate-800" {{ $selectedCategory == 'Technology' ? 'selected' : '' }}>Technology</option>
                    <option class="text-gray-900 dark:text-white dark:bg-slate-800" {{ $selectedCategory == 'Community' ? 'selected' : '' }}>Community</option>
                </select>
                <select name="location" class="block w-full pl-3 pr-10 py-3 text-base border-l border-gray-200 dark:border-slate-700 bg-transparent text-gray-900 dark:text-white focus:outline-none focus:ring-0 sm:text-sm dark:bg-slate-800">
                    <option class="text-gray-900 dark:text-white dark:bg-slate-800" {{ $selectedLocation == 'Location' ? 'selected' : '' }}>Location</option>
                    <option class="text-gray-900 dark:text-white dark:bg-slate-800" {{ $selectedLocation == 'Remote' ? 'selected' : '' }}>Remote</option>
                    <option class="text-gray-900 dark:text-white dark:bg-slate-800" {{ $selectedLocation == 'On-Site' ? 'selected' : '' }}>On-Site</option>
                    <option class="text-gray-900 dark:text-white dark:bg-slate-800" {{ $selectedLocation == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                </select>
                <button type="submit" class="bg-teal-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-teal-700 transition shadow-md">
                    Search
                </button>
            </div>
        </form>
    </div>
</div>

<div class="bg-slate-50 dark:bg-slate-950 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Featured/Urgent Row (Clickable) -->
        <div class="mb-12">
            <div class="flex items-center justify-between mb-6">
                 <h2 class="text-2xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <span class="relative flex h-3 w-3">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                    </span>
                    Urgent Opportunities
                </h2>
                <a href="{{ route('projects.index', ['urgent' => 1, 'sort' => 'deadline']) }}" class="text-teal-600 dark:text-teal-400 text-sm font-semibold hover:underline">View All Urgent &rarr;</a>
            </div>
            
            <!-- Link directly to a project show page to verify click works -->
            <a href="{{ route('projects.show', 999) }}" class="block group relative rounded-2xl bg-gradient-to-r from-teal-500 to-emerald-600 overflow-hidden shadow-xl hover:shadow-2xl transition-shadow duration-300">
                 <div class="absolute top-0 right-0 opacity-10 transform translate-x-1/3 -translate-y-1/3">
                    <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" /></svg>
                 </div>
                 <div class="relative p-8 sm:p-10 flex flex-col md:flex-row items-center gap-8">
                     <div class="bg-white p-4 rounded-xl shadow-lg transform -rotate-2 group-hover:rotate-0 transition-transform duration-300">
                         <img src="https://ui-avatars.com/api/?name=Red+Cross&background=EE1C25&color=fff&size=128" class="w-16 h-16 rounded-full mx-auto mb-2">
                         <p class="text-xs font-bold text-center text-slate-900">RedCross Response</p>
                     </div>
                     <div class="flex-1 text-center md:text-left text-white">
                         <div class="flex items-center justify-center md:justify-start gap-3 mb-2">
                             <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">URGENT</span>
                             <span class="text-teal-100 text-sm">Disaster Relief</span>
                         </div>
                         <h3 class="text-2xl font-bold mb-2 group-hover:text-teal-50 transition">Emergency Logistics Coordinator Needed</h3>
                         <p class="text-teal-50 mb-6 max-w-2xl">Help coordinate volunteer efforts for the recent flood relief program. Requires organization skills and availability for the next 2 weeks.</p>
                         <span class="inline-block bg-white text-teal-700 px-6 py-2.5 rounded-lg font-bold shadow group-hover:bg-teal-50 transition">Apply Now</span>
                     </div>
                 </div>
            </a>
        </div>

        <!-- Filters & Sort (Secondary) & Per Page -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 pb-4 border-b border-gray-200 dark:border-slate-800">
             <div class="mb-4 md:mb-0">
                 <p class="text-slate-600 dark:text-slate-400 font-medium">
                    Showing <span class="text-slate-900 dark:text-white font-bold">{{ $projects->firstItem() ?? 0 }}-{{ $projects->lastItem() ?? 0 }}</span> of <span class="text-slate-900 dark:text-white font-bold">{{ $projects->total() }}</span> available projects
                </p>
             </div>
             
             <!-- Unified Form for Sort & Per Page -->
             <form method="GET" action="{{ route('projects.index') }}" class="flex flex-wrap gap-4 items-center">
                 <!-- Persist Search Params -->
                 <input type="hidden" name="search" value="{{ $search }}">
                 <input type="hidden" name="category" value="{{ $selectedCategory }}">
                 <input type="hidden" name="location" value="{{ $selectedLocation }}">
                 
                 <div class="flex items-center gap-2">
                     <label for="per_page" class="text-sm text-slate-600 dark:text-slate-400">Items per page:</label>
                     <select name="per_page" id="per_page" onchange="this.form.submit()" class="bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-700 rounded-lg text-sm px-3 py-2 text-slate-700 dark:text-slate-300 focus:ring-teal-500 focus:border-teal-500">
                         <option value="3" {{ $perPage == 3 ? 'selected' : '' }}>3</option>
                         <option value="6" {{ $perPage == 6 ? 'selected' : '' }}>6</option>
                         <option value="9" {{ $perPage == 9 ? 'selected' : '' }}>9</option>
                     </select>
                 </div>

                 <div class="w-px h-6 bg-gray-300 dark:bg-slate-700 mx-2"></div>

                 <select name="sort" onchange="this.form.submit()" class="bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-700 rounded-lg text-sm px-3 py-2 text-slate-700 dark:text-slate-300">
                     <option value="newest" {{ ($sortBy ?? 'newest') == 'newest' ? 'selected' : '' }}>Sort by: Newest</option>
                     <option value="relevance" {{ ($sortBy ?? 'newest') == 'relevance' ? 'selected' : '' }}>Sort by: Relevance</option>
                     <option value="deadline" {{ ($sortBy ?? 'newest') == 'deadline' ? 'selected' : '' }}>Sort by: Deadline</option>
                 </select>
             </form>
        </div>

        <!-- Project Grid (Loop) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($projects as $project)
            <!-- Card {{ $project['id'] }} -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm hover:shadow-xl transition duration-300 border border-slate-100 dark:border-slate-800 overflow-hidden group flex flex-col">
                <div class="p-6 flex-grow">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center gap-3">
                            <!-- Using UI Avatars for dynamic colorful logos -->
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($project['ngo']) }}&background=random&color=fff" class="w-10 h-10 rounded-full">
                            <div>
                                <h4 class="text-sm font-bold text-slate-900 dark:text-white group-hover:text-teal-600 transition">{{ $project['ngo'] }}</h4>
                                <p class="text-xs text-slate-500">{{ $project['location'] }}</p>
                            </div>
                        </div>
                        <span class="bg-teal-100 text-teal-800 text-xs font-bold px-2 py-1 rounded">SDG {{ $project['sdg'] }}</span>
                    </div>
                    
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2 group-hover:text-teal-600 transition">
                        <a href="#">{{ $project['title'] }}</a>
                    </h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm line-clamp-3 mb-4">
                        {{ $project['description'] }}
                    </p>
                    
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach($project['tags'] as $tag)
                         <span class="bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-xs px-2 py-1 rounded border border-slate-200 dark:border-slate-700">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
                
                <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-100 dark:border-slate-800 flex justify-between items-center text-sm">
                    <div class="flex flex-col text-slate-500 dark:text-slate-400">
                        <span class="flex items-center gap-1"><svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> {{ $project['hours'] }}</span>
                        <span class="flex items-center gap-1 mt-0.5"><svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> {{ $project['location'] }}</span>
                    </div>
                    <span class="text-teal-600 font-semibold text-xs">{{ $project['deadline'] }}</span>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Pagination Links -->
        <div class="mt-12">
             {{ $projects->links() }}
        </div>

    </div>
</div>
@endsection