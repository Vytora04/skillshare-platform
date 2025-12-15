@extends('layouts.app')

@section('title', $skillPost->title . ' - SkillBridge')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 py-10">

        {{-- Back link --}}
        <a href="{{ route('skill-posts.index') }}" class="inline-flex items-center text-sm text-blue-600 hover:text-blue-700 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            Back to Skill Posts
        </a>

        {{-- Card --}}
        <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-200">
            <div class="flex items-start justify-between gap-4 mb-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        {{ $skillPost->title }}
                    </h1>
                    <p class="mt-1 text-sm text-gray-500">
                        Posted {{ $skillPost->created_at->diffForHumans() }}
                    </p>
                </div>

                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold
                    {{ $skillPost->type === 'offer'
                        ? 'bg-green-100 text-green-800'
                        : 'bg-indigo-100 text-indigo-800' }}">
                    {{ strtoupper($skillPost->type) }}
                </span>
            </div>

            {{-- Tags --}}
            @if($skillPost->tags->count() > 0)
                <div class="mb-4">
                    <h3 class="text-sm font-semibold text-gray-800 mb-2">Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($skillPost->tags as $tag)
                            <a href="{{ route('skill-posts.index', ['tag' => $tag->id]) }}" 
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 hover:bg-blue-200">
                                {{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="space-y-2 text-sm text-gray-700">
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

            <div class="mt-5 border-t border-gray-200 pt-4">
                <h2 class="text-sm font-semibold text-gray-800 mb-2">Description</h2>
                <p class="text-sm text-gray-700 leading-relaxed">
                    {{ $skillPost->description }}
                </p>
            </div>

            {{-- Invite/Apply Actions --}}
            @auth
                @if($skillPost->user_id !== Auth::id())
                    <div class="mt-6 pt-4 border-t border-gray-200">
                        <h3 class="text-sm font-semibold text-gray-800 mb-3">Interested?</h3>
                        <form action="{{ route('invitations.store', $skillPost) }}" method="POST" class="space-y-3">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{ $skillPost->user_id }}">
                            <input type="hidden" name="type" value="apply">
                            
                            <div>
                                <label class="block text-sm text-gray-700 mb-1">Optional Message</label>
                                <textarea name="message" rows="3" 
                                    class="w-full border rounded px-3 py-2 text-sm"
                                    placeholder="Introduce yourself or explain why you're interested..."></textarea>
                            </div>
                            
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">
                                {{ $skillPost->type === 'offer' ? 'Request This Skill' : 'Offer To Help' }}
                            </button>
                        </form>
                    </div>
                @endif
            @else
                <div class="mt-6 pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-600">
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700">Login</a> 
                        or 
                        <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700">register</a> 
                        to respond to this post.
                    </p>
                </div>
            @endauth
        </div>

        {{-- Recommendations --}}
        @if($recommendations->count() > 0)
            <div class="mt-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Recommended Matches</h2>
                <p class="text-sm text-gray-600 mb-4">
                    Based on matching tags, here are some {{ $skillPost->type === 'offer' ? 'needs' : 'offers' }} you might be interested in:
                </p>
                <div class="space-y-3">
                    @foreach($recommendations as $rec)
                        <a href="{{ route('skill-posts.show', $rec->id) }}"
                            class="block rounded-lg border border-gray-200 bg-white px-4 py-3 hover:shadow-md hover:border-blue-400 transition">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900">{{ $rec->title }}</h3>
                                    <p class="text-xs text-gray-500 mt-1">
                                        Posted by {{ $rec->user->name }} • {{ $rec->created_at->diffForHumans() }}
                                    </p>
                                    @if($rec->tags->count() > 0)
                                        <div class="mt-2 flex flex-wrap gap-1">
                                            @foreach($rec->tags as $tag)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                    {{ $tag->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-semibold
                                    {{ $rec->type === 'offer' ? 'bg-green-100 text-green-800' : 'bg-indigo-100 text-indigo-800' }}">
                                    {{ strtoupper($rec->type) }}
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
