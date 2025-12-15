@extends('layouts.app')

@section('title', 'Create Skill Post')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-4">
    <h1 class="text-2xl font-bold mb-6">Create a Skill Post</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('skill-posts.store') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700">Title</label>
            <input name="title" value="{{ old('title') }}" required class="mt-1 block w-full border rounded px-3 py-2" />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Type</label>
            <select name="type" required class="mt-1 block w-full border rounded px-3 py-2">
                <option value="offer" {{ old('type')=='offer'? 'selected':'' }}>I Offer</option>
                <option value="need" {{ old('type')=='need'? 'selected':'' }}>I Need</option>
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Skills (comma separated)</label>
                <input name="skills" value="{{ old('skills') }}" class="mt-1 block w-full border rounded px-3 py-2" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Location</label>
                <input name="location" value="{{ old('location') }}" class="mt-1 block w-full border rounded px-3 py-2" />
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Time Commitment</label>
            <input name="time_commitment" value="{{ old('time_commitment') }}" class="mt-1 block w-full border rounded px-3 py-2" />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Tags</label>
            <div class="mt-2 space-y-2">
                <div class="flex flex-wrap gap-2">
                    @foreach($tags as $tag)
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" 
                                {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-1 text-sm">{{ $tag->name }}</span>
                        </label>
                    @endforeach
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Or create new tags (comma-separated)</label>
                    <input name="new_tags" value="{{ old('new_tags') }}" 
                        placeholder="e.g. Web Development, Design, Marketing"
                        class="block w-full border rounded px-3 py-2 text-sm" />
                </div>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" rows="6" required class="mt-1 block w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">Create Post</button>
        </div>
    </form>
</div>
@endsection
