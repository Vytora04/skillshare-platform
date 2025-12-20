@extends('layouts.app')

@section('title', $skillPost->title . ' - SkillBridge')

@section('content')
    <div class="max-w-4xl mx-auto">

        {{-- Back link --}}
        <a href="{{ route('skill-posts.index') }}" class="inline-flex items-center text-sm text-teal-600 hover:text-teal-700 dark:text-teal-400 dark:hover:text-teal-300 mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            Back to Skill Posts
        </a>

        {{-- Card --}}
        <div class="rounded-2xl bg-white dark:bg-slate-900 p-6 shadow-sm border border-slate-200 dark:border-slate-800">
            <div class="flex items-start justify-between gap-4 mb-4">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100">
                        {{ $skillPost->title }}
                    </h1>
                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        Posted {{ $skillPost->created_at->diffForHumans() }}
                    </p>
                </div>

                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold
                    {{ $skillPost->type === 'offer'
                        ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300'
                        : 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300' }}">
                    {{ strtoupper($skillPost->type) }}
                </span>
            </div>

            {{-- Tags --}}
            @if($skillPost->tags->count() > 0)
                <div class="mb-4">
                    <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-200 mb-2">Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($skillPost->tags as $tag)
                            <a href="{{ route('skill-posts.index', ['tag' => $tag->id]) }}" 
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700">
                                {{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="space-y-2 text-sm text-slate-700 dark:text-slate-300">
                @if($skillPost->skills)
                    <p><span class="font-semibold">Skills:</span> {{ $skillPost->skills }}</p>
                @endif

                @if($skillPost->location)
                    <p><span class="font-semibold">Location:</span> {{ $skillPost->location }}</p>
                @endif

                @if($skillPost->time_commitment)
                    <p><span class="font-semibold">Time Commitment:</span> {{ $skillPost->time_commitment }}</p>
                @endif
            </div>

            <div class="mt-5 border-t border-slate-200 dark:border-slate-800 pt-4">
                <h2 class="text-sm font-semibold text-slate-800 dark:text-slate-200 mb-2">Description</h2>
                <p class="text-sm text-slate-700 dark:text-slate-300 leading-relaxed">
                    {{ $skillPost->description }}
                </p>
            </div>

            {{-- Invite/Apply Actions --}}
            @auth
                @if($skillPost->user_id !== Auth::id())
                    <div class="mt-6 pt-4 border-t border-slate-200 dark:border-slate-800">
                        <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-200 mb-3">Interested?</h3>
                        <form action="{{ route('invitations.store', $skillPost) }}" method="POST" class="space-y-3">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{ $skillPost->user_id }}">
                            <input type="hidden" name="type" value="apply">
                            
                            <div>
                                <label class="block text-sm text-slate-700 dark:text-slate-300 mb-1">Optional Message</label>
                                <textarea name="message" rows="3" 
                                    class="w-full border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 rounded px-3 py-2 text-sm focus:ring-teal-500 focus:border-teal-500"
                                    placeholder="Introduce yourself or explain why you're interested..."></textarea>
                            </div>
                            
                            <button type="submit" class="bg-teal-600 text-white px-4 py-2 rounded text-sm hover:bg-teal-700 transition">
                                {{ $skillPost->type === 'offer' ? 'Request This Skill' : 'Offer To Help' }}
                            </button>
                        </form>
                    </div>
                @endif
            @else
                <div class="mt-6 pt-4 border-t border-slate-200 dark:border-slate-800">
                    <p class="text-sm text-slate-600 dark:text-slate-400">
                        <a href="{{ route('login') }}" class="text-teal-600 hover:text-teal-700 dark:text-teal-400">Login</a> 
                        or 
                        <a href="{{ route('register') }}" class="text-teal-600 hover:text-teal-700 dark:text-teal-400">register</a> 
                        to respond to this post.
                    </p>
                </div>
            @endauth
        </div>

        {{-- Recommendations --}}
        @if($recommendations->count() > 0)
            <div class="mt-8">
                <h2 class="text-xl font-bold text-slate-900 dark:text-slate-100 mb-4">Recommended Matches</h2>
                <p class="text-sm text-slate-600 dark:text-slate-400 mb-4">
                    Based on matching tags, here are some {{ $skillPost->type === 'offer' ? 'needs' : 'offers' }} you might be interested in:
                </p>
                <div class="space-y-3">
                    @foreach($recommendations as $rec)
                        <a href="{{ route('skill-posts.show', $rec->id) }}"
                            class="block rounded-lg border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 px-4 py-3 hover:shadow-md hover:border-teal-400 dark:hover:border-teal-500 transition">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-slate-900 dark:text-slate-100">{{ $rec->title }}</h3>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                                        Posted by {{ $rec->user->name }} • {{ $rec->created_at->diffForHumans() }}
                                    </p>
                                    @if($rec->tags->count() > 0)
                                        <div class="mt-2 flex flex-wrap gap-1">
                                            @foreach($rec->tags as $tag)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                                                    {{ $tag->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-semibold
                                    {{ $rec->type === 'offer' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300' }}">
                                    {{ strtoupper($rec->type) }}
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
