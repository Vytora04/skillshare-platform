<?php

namespace App\Http\Controllers;

use App\Models\OrgVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrgVerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the verification form
     */
    public function create()
    {
        $user = Auth::user();
        
        // Only org reps can verify
        if (!$user->hasRole('org_rep')) {
            return redirect()->route('dashboard')->with('error', 'Only organization representatives can submit verification.');
        }

        // Check if already submitted
        $existingVerification = $user->orgVerification;
        
        return view('org_verification.create', compact('existingVerification'));
    }

    /**
     * Submit verification request
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        if (!$user->hasRole('org_rep')) {
            return redirect()->route('dashboard')->with('error', 'Only organization representatives can submit verification.');
        }

        $validated = $request->validate([
            'organization_name' => 'required|string|max:255',
            'organization_description' => 'nullable|string|max:1000',
            'document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120', // 5MB max
        ]);

        // Store document
        $path = $request->file('document')->store('org_verification_documents', 'public');
        $extension = $request->file('document')->getClientOriginalExtension();

        // Delete existing verification if any
        if ($user->orgVerification) {
            Storage::disk('public')->delete($user->orgVerification->document_path);
            $user->orgVerification->delete();
        }

        // Create new verification request
        OrgVerification::create([
            'user_id' => $user->id,
            'organization_name' => $validated['organization_name'],
            'organization_description' => $validated['organization_description'],
            'document_path' => $path,
            'document_type' => $extension,
            'status' => 'pending',
            'submitted_at' => now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Verification request submitted successfully!');
    }

    /**
     * Admin: List all verification requests
     */
    public function index()
    {
        $this->authorize('viewAny', OrgVerification::class);

        $verifications = OrgVerification::with(['user', 'reviewer'])
            ->latest()
            ->paginate(20);

        return view('admin.org_verifications.index', compact('verifications'));
    }

    /**
     * Admin: Approve verification
     */
    public function approve(OrgVerification $verification)
    {
        $this->authorize('update', $verification);

        $verification->update([
            'status' => 'approved',
            'reviewed_at' => now(),
            'reviewed_by' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Organization verified successfully!');
    }

    /**
     * Admin: Reject verification
     */
    public function reject(Request $request, OrgVerification $verification)
    {
        $this->authorize('update', $verification);

        $validated = $request->validate([
            'admin_notes' => 'required|string|max:500',
        ]);

        $verification->update([
            'status' => 'rejected',
            'reviewed_at' => now(),
            'reviewed_by' => Auth::id(),
            'admin_notes' => $validated['admin_notes'],
        ]);

        return redirect()->back()->with('success', 'Verification rejected.');
    }
}
