@extends('layouts.app', ['fullWidth' => true])

@section('title', 'Skill Posts - SkillBridge')

@section('content')
<!-- Hero Section -->
<div class="relative bg-teal-900 overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-teal-900 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-teal-900 via-teal-900/40"></div>
    </div>
    <div class="relative max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8 text-center text-white">
        <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl">
            Skill <span class="text-teal-400">Exchange</span>
        </h1>
        <p class="mt-4 text-xl text-teal-100 max-w-3xl mx-auto">
            Connect with talented individuals offering their skills or find the help you need for your social impact journey.
        </p>
        
        <div class="mt-8 flex justify-center">
             <a href="{{ route('skill-posts.create') }}" class="px-8 py-3 bg-teal-500 text-white font-bold rounded-lg hover:bg-teal-400 transition shadow-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Post a Skill
            </a>
        </div>

        <!-- Search & Filter Bar (Floating) -->
        <form action="{{ route('skill-posts.index') }}" method="GET" class="mt-12 max-w-4xl mx-auto bg-white dark:bg-slate-800 rounded-xl p-2 shadow-lg flex flex-col md:flex-row gap-2">
            <!-- Persist Hidden Params -->
            <input type="hidden" name="sort" value="{{ $sortBy }}">
            <input type="hidden" name="per_page" value="{{ $perPage }}">

            <div class="flex-grow">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </div>
                    <input type="text" name="search" id="skillSearchInput" value="{{ $search }}" class="block w-full pl-10 pr-10 py-3 border-0 bg-transparent text-gray-900 dark:text-white placeholder-gray-500 focus:ring-0 sm:text-sm" placeholder="Search by skill, name, or keyword...">
                    
                    <!-- Clear Button -->
                    <button type="button" id="clearSkillSearch" class="absolute inset-y-0 right-0 pr-3 flex items-center {{ empty($search) ? 'hidden' : '' }}">
                        <svg class="h-5 w-5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const input = document.getElementById('skillSearchInput');
                            const clearBtn = document.getElementById('clearSkillSearch');
                            
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
            </div>
            
            <div class="flex gap-2">
                 <select name="type" class="block w-full sm:w-40 pl-3 pr-10 py-3 text-base border-l border-gray-200 dark:border-slate-700 bg-transparent text-gray-900 dark:text-white focus:outline-none focus:ring-0 sm:text-sm dark:bg-slate-800">
                    <option class="text-gray-900 dark:text-white dark:bg-slate-800" {{ $selectedType == 'All Types' ? 'selected' : '' }}>All Types</option>
                    <option class="text-gray-900 dark:text-white dark:bg-slate-800" {{ $selectedType == 'Offer' ? 'selected' : '' }}>Offer</option>
                    <option class="text-gray-900 dark:text-white dark:bg-slate-800" {{ $selectedType == 'Need' ? 'selected' : '' }}>Need</option>
                </select>

                <select name="category" class="block w-full sm:w-56 pl-3 pr-10 py-3 text-base border-l border-gray-200 dark:border-slate-700 bg-transparent text-gray-900 dark:text-white focus:outline-none focus:ring-0 sm:text-sm dark:bg-slate-800">
                    <option class="text-gray-900 dark:text-white dark:bg-slate-800" {{ $selectedCategory == 'All Categories' ? 'selected' : '' }}>All Categories</option>
                    <option class="text-gray-900 dark:text-white dark:bg-slate-800" {{ $selectedCategory == 'Design' ? 'selected' : '' }}>Design</option>
                    <option class="text-gray-900 dark:text-white dark:bg-slate-800" {{ $selectedCategory == 'Development' ? 'selected' : '' }}>Development</option>
                    <option class="text-gray-900 dark:text-white dark:bg-slate-800" {{ $selectedCategory == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                    <option class="text-gray-900 dark:text-white dark:bg-slate-800" {{ $selectedCategory == 'Writing' ? 'selected' : '' }}>Writing</option>
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

        {{-- Results Info & Sorting --}}
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 pb-4 border-b border-gray-200 dark:border-slate-800">
            <p class="text-slate-600 dark:text-slate-400 font-medium mb-4 md:mb-0">
                Showing <span class="font-bold text-slate-900 dark:text-white">{{ $skillPosts->firstItem() ?? 0 }}-{{ $skillPosts->lastItem() ?? 0 }}</span> of <span class="font-bold text-slate-900 dark:text-white">{{ $skillPosts->total() }}</span> posts
            </p>
            
            <form id="sortForm" method="GET" class="flex flex-wrap items-center gap-4">
                <input type="hidden" name="search" value="{{ $search }}">
                <input type="hidden" name="type" value="{{ $selectedType }}">
                <input type="hidden" name="category" value="{{ $selectedCategory }}">

                <div class="flex items-center gap-2">
                    <label class="text-sm text-slate-600 dark:text-slate-400">Items per page:</label>
                    <select name="per_page" onchange="this.form.submit()" class="bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-700 rounded-lg text-sm px-3 py-2 text-slate-700 dark:text-slate-300 focus:ring-teal-500">
                        <option value="3" {{ $perPage == 3 ? 'selected' : '' }}>3</option>
                        <option value="6" {{ $perPage == 6 ? 'selected' : '' }}>6</option>
                        <option value="9" {{ $perPage == 9 ? 'selected' : '' }}>9</option>
                        <option value="12" {{ $perPage == 12 ? 'selected' : '' }}>12</option>
                    </select>
                </div>

                <div class="w-px h-6 bg-gray-300 dark:bg-slate-700 mx-2 hidden md:block"></div>

                <select name="sort" onchange="this.form.submit()" class="bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-700 rounded-lg text-sm px-3 py-2 text-slate-700 dark:text-slate-300 focus:ring-teal-500">
                    <option value="newest" {{ $sortBy == 'newest' ? 'selected' : '' }}>Sort by: Newest</option>
                    <option value="relevance" {{ $sortBy == 'relevance' ? 'selected' : '' }}>Sort by: Relevance</option>
                </select>
            </form>
        </div>

        {{-- Grid Layout --}}
        @if($skillPosts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($skillPosts as $post)
                    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 dark:border-slate-800 overflow-hidden flex flex-col h-full group">
                        <div class="p-6 flex-grow">
                            {{-- Header --}}
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $post['user_avatar'] }}" alt="{{ $post['user_name'] }}" class="w-10 h-10 rounded-full border-2 border-white dark:border-slate-700 shadow-sm">
                                    <div>
                                        <h3 class="text-sm font-bold text-slate-900 dark:text-white group-hover:text-teal-600 transition">{{ $post['user_name'] }}</h3>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">{{ $post['location'] }}</p>
                                    </div>
                                </div>
                                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ $post['type'] === 'Offer' ? 'bg-teal-100 text-teal-800 dark:bg-teal-900/50 dark:text-teal-300' : 'bg-purple-100 text-purple-800 dark:bg-purple-900/50 dark:text-purple-300' }}">
                                    {{ $post['type'] }}
                                </span>
                            </div>

                            {{-- Title & Desc --}}
                            <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-2 group-hover:text-teal-600 transition-colors">
                                <a href="#">{{ $post['title'] }}</a>
                            </h2>
                            <p class="text-slate-600 dark:text-slate-400 text-sm mb-4 line-clamp-3">
                                {{ $post['description'] }}
                            </p>

                            {{-- Metadata --}}
                            <div class="flex flex-wrap gap-2">
                                <span class="bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-xs px-2 py-1 rounded border border-slate-200 dark:border-slate-700">
                                    {{ $post['category'] }}
                                </span>
                            </div>
                        </div>

                        {{-- Footer Action --}}
                        <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-100 dark:border-slate-800 flex justify-between items-center text-sm">
                            <div class="flex items-center text-slate-500 dark:text-slate-400">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $post['posted_ago'] }}
                                </span>
                            </div>
                            
                            @if(isset($post['is_verified']) && $post['is_verified'])
                                <span class="flex items-center text-xs font-medium text-teal-600 dark:text-teal-400" title="Verified User">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    Verified
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-12">
                {{ $skillPosts->links() }}
            </div>
        @else
            <div class="text-center py-24 bg-white dark:bg-slate-800 rounded-2xl border border-dashed border-slate-300 dark:border-slate-700">
                <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-slate-900 dark:text-white">No skill posts found</h3>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Try adjusting your search or filters.</p>
                <div class="mt-6">
                    <a href="{{ route('skill-posts.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                        Clear All Filters
                    </a>
                </div>
            </div>
        @endif
        
    </div>
</div>
@endsection
