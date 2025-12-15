@extends('layouts.app')

@section('title', 'Skill Posts - SkillBridge')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 py-10">
        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Skill Posts</h1>
            <p class="text-gray-600 mt-1">
                Browse <span class="font-semibold">“I Offer”</span> and <span class="font-semibold">“I Need”</span> opportunities for social impact.
            </p>
        </div>

        {{-- Search form --}}
        <form action="{{ route('skill-posts.index') }}" method="GET" class="mb-6">
            <div class="flex gap-2">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search by title, skill, or keyword..."
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                <button
                    type="submit"
                    class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition"
                >
                    Search
                </button>
            </div>
        </form>

        {{-- Empty state --}}
        @if($skillPosts->count() === 0)
            <div class="rounded-xl border border-dashed border-gray-300 bg-white p-8 text-center">
                <p class="text-gray-500">No posts found yet. Ask your teammate to help you seed more sample data later 😊</p>
            </div>
        @else
            {{-- List of posts --}}
            <div class="space-y-4">
                @foreach($skillPosts as $post)
                    <a
                        href="{{ route('skill-posts.show', $post->id) }}"
                        class="block rounded-xl border border-gray-200 bg-white px-5 py-4 shadow-sm hover:shadow-md hover:border-blue-400 transition"
                    >
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">
                                    {{ $post->title }}
                                </h2>
                                <p class="mt-1 text-sm text-gray-600">
                                    @if($post->skills)
                                        <span class="font-medium text-gray-700">Skills:</span>
                                        {{ $post->skills }}
                                    @else
                                        <span class="text-gray-400 italic">No skills specified</span>
                                    @endif
                                </p>
                                @if($post->location)
                                    <p class="mt-1 text-xs text-gray-500">
                                        <span class="font-medium text-gray-700">Location:</span>
                                        {{ $post->location }}
                                    </p>
                                @endif
                            </div>

                            <span class="inline-flex shrink-0 items-center rounded-full px-3 py-1 text-xs font-semibold
                                {{ $post->type === 'offer'
                                    ? 'bg-green-100 text-green-800'
                                    : 'bg-indigo-100 text-indigo-800' }}">
                                {{ strtoupper($post->type) }}
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $skillPosts->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
