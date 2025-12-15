@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Organization Verification</h1>

        @if($existingVerification)
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Current Verification Status</h2>
                
                <div class="space-y-3">
                    <div>
                        <span class="font-semibold">Organization:</span> {{ $existingVerification->organization_name }}
                    </div>
                    <div>
                        <span class="font-semibold">Status:</span>
                        @if($existingVerification->status === 'pending')
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">Pending Review</span>
                        @elseif($existingVerification->status === 'approved')
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">✓ Verified</span>
                        @else
                            <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm">Rejected</span>
                        @endif
                    </div>
                    <div>
                        <span class="font-semibold">Submitted:</span> {{ $existingVerification->submitted_at->format('M d, Y') }}
                    </div>
                    @if($existingVerification->status === 'rejected' && $existingVerification->admin_notes)
                        <div class="bg-red-50 p-4 rounded">
                            <span class="font-semibold text-red-800">Admin Notes:</span>
                            <p class="text-red-700 mt-1">{{ $existingVerification->admin_notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            @if($existingVerification->status === 'approved')
                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <p class="text-green-800">🎉 Your organization is verified! A verified badge will appear on your profile.</p>
                </div>
            @elseif($existingVerification->status === 'pending')
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <p class="text-yellow-800">⏳ Your verification request is pending admin review. You'll be notified once reviewed.</p>
                </div>
            @endif

            @if($existingVerification->status === 'rejected')
                <p class="text-gray-600 mb-4">Your previous verification was rejected. You can submit a new request below.</p>
            @endif
        @endif

        @if(!$existingVerification || $existingVerification->status === 'rejected')
            <div class="bg-white rounded-lg shadow p-6">
                <form action="{{ route('org_verification.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="organization_name" class="block text-gray-700 font-semibold mb-2">Organization Name *</label>
                        <input type="text" id="organization_name" name="organization_name" value="{{ old('organization_name') }}" 
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        @error('organization_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="organization_description" class="block text-gray-700 font-semibold mb-2">Organization Description</label>
                        <textarea id="organization_description" name="organization_description" rows="4" 
                                  class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('organization_description') }}</textarea>
                        @error('organization_description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="document" class="block text-gray-700 font-semibold mb-2">Verification Document *</label>
                        <p class="text-sm text-gray-600 mb-2">Upload official documentation (business license, registration certificate, etc.). Max 5MB. Accepted: PDF, JPG, PNG</p>
                        <input type="file" id="document" name="document" accept=".pdf,.jpg,.jpeg,.png" 
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        @error('document')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold">
                        Submit Verification Request
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>
@endsection
