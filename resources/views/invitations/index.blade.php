@extends('layouts.app')

@section('title', 'Invitations')

@section('content')
<div class="max-w-6xl mx-auto py-12 px-4">
    <h1 class="text-2xl font-bold mb-6">Invitations</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
    @endif

    <div class="grid md:grid-cols-2 gap-8">
        {{-- Received Invitations --}}
        <div>
            <h2 class="text-xl font-semibold mb-4">Received ({{ $receivedInvitations->count() }})</h2>
            
            @if($receivedInvitations->isEmpty())
                <p class="text-gray-500">No invitations received yet.</p>
            @else
                <div class="space-y-4">
                    @foreach($receivedInvitations as $invitation)
                        <div class="border rounded-lg p-4 bg-white">
                            <div class="flex items-start justify-between mb-2">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900">
                                        <a href="{{ route('skill-posts.show', $invitation->skillPost->id) }}" class="hover:text-teal-600">
                                            {{ $invitation->skillPost->title }}
                                        </a>
                                    </h3>
                                    <p class="text-sm text-gray-600 mt-1">
                                        From: <span class="font-medium">{{ $invitation->sender->name }}</span>
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $invitation->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-semibold
                                    {{ $invitation->type === 'invite' ? 'bg-purple-100 text-purple-800' : 'bg-teal-100 text-teal-800' }}">
                                    {{ strtoupper($invitation->type) }}
                                </span>
                            </div>

                            @if($invitation->message)
                                <p class="text-sm text-gray-700 mt-2 p-2 bg-gray-50 rounded">
                                    "{{ $invitation->message }}"
                                </p>
                            @endif

                            <div class="mt-3 flex items-center gap-2">
                                @if($invitation->status === 'pending')
                                    <form action="{{ route('invitations.accept', $invitation) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-3 py-1 bg-green-600 text-white text-sm rounded hover:bg-green-700">
                                            Accept
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('invitations.reject', $invitation) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-3 py-1 bg-gray-600 text-white text-sm rounded hover:bg-gray-700">
                                            Reject
                                        </button>
                                    </form>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded text-xs font-semibold
                                        {{ $invitation->status === 'accepted' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ strtoupper($invitation->status) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Sent Invitations --}}
        <div>
            <h2 class="text-xl font-semibold mb-4">Sent ({{ $sentInvitations->count() }})</h2>
            
            @if($sentInvitations->isEmpty())
                <p class="text-gray-500">No invitations sent yet.</p>
            @else
                <div class="space-y-4">
                    @foreach($sentInvitations as $invitation)
                        <div class="border rounded-lg p-4 bg-white">
                            <div class="flex items-start justify-between mb-2">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900">
                                        <a href="{{ route('skill-posts.show', $invitation->skillPost->id) }}" class="hover:text-teal-600">
                                            {{ $invitation->skillPost->title }}
                                        </a>
                                    </h3>
                                    <p class="text-sm text-gray-600 mt-1">
                                        To: <span class="font-medium">{{ $invitation->receiver->name }}</span>
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $invitation->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-semibold
                                    {{ $invitation->type === 'invite' ? 'bg-purple-100 text-purple-800' : 'bg-teal-100 text-teal-800' }}">
                                    {{ strtoupper($invitation->type) }}
                                </span>
                            </div>

                            @if($invitation->message)
                                <p class="text-sm text-gray-700 mt-2 p-2 bg-gray-50 rounded">
                                    "{{ $invitation->message }}"
                                </p>
                            @endif

                            <div class="mt-3 flex items-center gap-2">
                                @if($invitation->status === 'pending')
                                    <span class="inline-flex items-center px-3 py-1 rounded text-xs font-semibold bg-yellow-100 text-yellow-800">
                                        PENDING
                                    </span>
                                    
                                    <form action="{{ route('invitations.cancel', $invitation) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-gray-500 text-white text-sm rounded hover:bg-gray-600">
                                            Cancel
                                        </button>
                                    </form>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded text-xs font-semibold
                                        {{ $invitation->status === 'accepted' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ strtoupper($invitation->status) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
