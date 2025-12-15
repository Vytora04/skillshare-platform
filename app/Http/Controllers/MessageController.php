<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show all conversations.
     */
    public function index()
    {
        $user = Auth::user();
        
        $conversations = Conversation::with(['user1', 'user2', 'messages' => function ($q) {
            $q->latest()->limit(1);
        }])
        ->where('user1_id', $user->id)
        ->orWhere('user2_id', $user->id)
        ->get();

        return view('messages.index', compact('conversations'));
    }

    /**
     * Show conversation with a specific user.
     */
    public function show(User $user)
    {
        $currentUser = Auth::user();

        if ($user->id === $currentUser->id) {
            return back()->with('error', 'Cannot message yourself.');
        }

        // Find or create conversation
        $conversation = Conversation::where(function ($q) use ($currentUser, $user) {
            $q->where('user1_id', $currentUser->id)->where('user2_id', $user->id);
        })->orWhere(function ($q) use ($currentUser, $user) {
            $q->where('user1_id', $user->id)->where('user2_id', $currentUser->id);
        })->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'user1_id' => min($currentUser->id, $user->id),
                'user2_id' => max($currentUser->id, $user->id),
            ]);
        }

        $messages = $conversation->messages()->oldest()->get();

        // Mark messages as read
        $conversation->messages()
            ->where('sender_id', '!=', $currentUser->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('messages.show', compact('conversation', 'messages', 'user'));
    }

    /**
     * Send a message.
     */
    public function store(Request $request, Conversation $conversation)
    {
        $user = Auth::user();

        // Verify user is part of conversation
        if ($conversation->user1_id !== $user->id && $conversation->user2_id !== $user->id) {
            abort(403);
        }

        $validated = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $user->id,
            'body' => $validated['body'],
        ]);

        return back();
    }
}
