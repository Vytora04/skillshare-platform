<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display all projects for the current user.
     */
    public function index()
    {
        $user = Auth::user();
        
        $projects = Project::with(['creator', 'members'])
            ->where(function ($q) use ($user) {
                $q->where('creator_id', $user->id)
                  ->orWhereHas('members', function ($q) use ($user) {
                      $q->where('users.id', $user->id);
                  });
            })
            ->latest()
            ->get();

        return view('projects.index', compact('projects'));
    }

    /**
     * Create a project from an accepted invitation.
     */
    public function createFromInvitation(Invitation $invitation)
    {
        $user = Auth::user();

        // Verify invitation is accepted
        if (!$invitation->isAccepted()) {
            return back()->with('error', 'Only accepted invitations can create projects.');
        }

        // Check if project already exists
        $existingProject = Project::where('skill_post_id', $invitation->skillPost->id)
            ->whereHas('members', function ($q) use ($invitation) {
                $q->where('users.id', $invitation->sender_id)
                  ->orWhere('users.id', $invitation->receiver_id);
            })
            ->first();

        if ($existingProject) {
            return redirect()->route('projects.show', $existingProject)->with('info', 'Project already exists for this collaboration.');
        }

        // Create project
        $project = Project::create([
            'skill_post_id' => $invitation->skillPost->id,
            'creator_id' => $user->id,
            'title' => $invitation->skillPost->title,
            'description' => $invitation->skillPost->description,
            'status' => 'active',
        ]);

        // Add both parties as members
        $project->members()->attach($invitation->sender_id, ['role' => 'member']);
        $project->members()->attach($invitation->receiver_id, ['role' => 'member']);

        return redirect()->route('projects.show', $project)->with('success', 'Project created successfully!');
    }

    /**
     * Show project details.
     */
    public function show(Project $project)
    {
        $user = Auth::user();

        // Check access
        if ($project->creator_id !== $user->id && !$project->members->contains($user->id)) {
            abort(403, 'Unauthorized access to this project.');
        }

        $project->load(['milestones.tasks', 'tasks' => function ($q) {
            $q->whereNull('milestone_id');
        }, 'members']);

        return view('projects.show', compact('project'));
    }

    /**
     * Toggle task completion.
     */
    public function toggleTask(Project $project, Task $task)
    {
        $user = Auth::user();

        // Check access
        if ($project->creator_id !== $user->id && !$project->members->contains($user->id)) {
            abort(403);
        }

        $task->update(['is_completed' => !$task->is_completed]);

        return back()->with('success', 'Task updated!');
    }

    /**
     * Add a new task.
     */
    public function storeTask(Request $project, Project $project)
    {
        $user = Auth::user();

        // Check access
        if ($project->creator_id !== $user->id && !$project->members->contains($user->id)) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'milestone_id' => 'nullable|exists:milestones,id',
        ]);

        $validated['project_id'] = $project->id;

        Task::create($validated);

        return back()->with('success', 'Task added!');
    }
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
