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
        </div>
    </div>
</div>
@endsection
