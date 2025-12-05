@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Success Message Alert --}}
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">You are logged in as {{ Auth::user()->email }}.</span>
        </div>

        {{-- Main Dashboard Content --}}
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-bold mb-4">Welcome to your Dashboard!</h2>
                <p>You are now logged in. This is where you will eventually manage your projects and settings.</p>
            </div>
        </div>

    </div>
</div>
@endsection
