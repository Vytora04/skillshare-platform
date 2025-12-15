<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\SkillPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show all invitations for the current user.
     */
    public function index()
    {
        $user = Auth::user();
        
        $receivedInvitations = Invitation::with(['skillPost', 'sender'])
            ->where('receiver_id', $user->id)
            ->latest()
            ->get();
            
        $sentInvitations = Invitation::with(['skillPost', 'receiver'])
            ->where('sender_id', $user->id)
            ->latest()
            ->get();

        return view('invitations.index', compact('receivedInvitations', 'sentInvitations'));
    }

    /**
     * Send an invitation or apply to a post.
     */
    public function store(Request $request, SkillPost $skillPost)
    {
        $validated = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'type' => 'required|in:invite,apply',
            'message' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();

        // Check for duplicate
        $existing = Invitation::where('skill_post_id', $skillPost->id)
            ->where('sender_id', $user->id)
            ->where('receiver_id', $validated['receiver_id'])
            ->first();

        if ($existing) {
            return back()->with('error', 'You have already sent an invitation for this post.');
        }

        Invitation::create([
            'skill_post_id' => $skillPost->id,
            'sender_id' => $user->id,
            'receiver_id' => $validated['receiver_id'],
            'type' => $validated['type'],
            'message' => $validated['message'],
        ]);

        return back()->with('success', 'Invitation sent successfully!');
    }

    /**
     * Accept an invitation.
     */
    public function accept(Invitation $invitation)
    {
        $user = Auth::user();

        if ($invitation->receiver_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        if (!$invitation->isPending()) {
            return back()->with('error', 'This invitation has already been processed.');
        }

        $invitation->update(['status' => 'accepted']);

        return back()->with('success', 'Invitation accepted!');
    }

    /**
     * Reject an invitation.
     */
    public function reject(Invitation $invitation)
    {
        $user = Auth::user();

        if ($invitation->receiver_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        if (!$invitation->isPending()) {
            return back()->with('error', 'This invitation has already been processed.');
        }

        $invitation->update(['status' => 'rejected']);

        return back()->with('success', 'Invitation rejected.');
    }

    /**
     * Cancel a sent invitation.
     */
    public function cancel(Invitation $invitation)
    {
        $user = Auth::user();

        if ($invitation->sender_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        if (!$invitation->isPending()) {
            return back()->with('error', 'Cannot cancel a processed invitation.');
        }

        $invitation->delete();

        return back()->with('success', 'Invitation cancelled.');
    }
}
