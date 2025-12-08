<?php

namespace App\Http\Controllers;

use App\Models\SkillPost;
use Illuminate\Http\Request;

class SkillPostController extends Controller
{
    public function __construct()
    {
        // Require authentication for create/store actions
        $this->middleware('auth')->only(['create', 'store']);
    }
    // List + search
    public function index(Request $request)
    {
        $query = SkillPost::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('skills', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $skillPosts = $query->latest()->paginate(10);

        return view('skill_posts.index', compact('skillPosts', 'search'));
    }

    // Detail
    public function show(SkillPost $skillPost)
    {
        return view('skill_posts.show', compact('skillPost'));
    }

    // Show the create form (authenticated)
    public function create()
    {
        return view('skill_posts.create');
    }

    // Store a new skill post
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:offer,need',
            'skills' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'time_commitment' => 'nullable|string|max:255',
            'description' => 'required|string',
        ]);

        $post = SkillPost::create($data);

        return redirect()->route('skill-posts.show', $post->id)->with('success', 'Skill post created successfully.');
    }
}
