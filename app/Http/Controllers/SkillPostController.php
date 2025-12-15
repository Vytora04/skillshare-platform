<?php

namespace App\Http\Controllers;

use App\Models\SkillPost;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SkillPostController extends Controller
{
    public function __construct()
    {
        // Require authentication for create/store/delete actions
        $this->middleware('auth')->only(['create', 'store', 'delete']);
    }
    
    // List + search
    public function index(Request $request)
    {
        $query = SkillPost::with(['tags', 'user']);

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('skills', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by tag
        if ($tagId = $request->input('tag')) {
            $query->whereHas('tags', function (Builder $q) use ($tagId) {
                $q->where('tags.id', $tagId);
            });
        }

        // Filter by type
        if ($type = $request->input('type')) {
            $query->where('type', $type);
        }

        $skillPosts = $query->latest()->paginate(10);
        $tags = Tag::orderBy('name')->get();

        return view('skill_posts.index', compact('skillPosts', 'search', 'tags'));
    }

    // Detail
    public function show(SkillPost $skillPost)
    {
        $skillPost->load(['tags', 'user']);
        
        // Get recommendations if user is authenticated
        $recommendations = Auth::check() ? $this->getRecommendations($skillPost) : collect();
        
        return view('skill_posts.show', compact('skillPost', 'recommendations'));
    }

    // Show the create form (authenticated)
    public function create()
    {
        $tags = Tag::orderBy('name')->get();
        return view('skill_posts.create', compact('tags'));
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
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'new_tags' => 'nullable|string',
        ]);

        $data['user_id'] = Auth::id();
        $post = SkillPost::create($data);

        // Attach existing tags
        if (!empty($data['tags'])) {
            $post->tags()->attach($data['tags']);
        }

        // Create and attach new tags
        if (!empty($data['new_tags'])) {
            $newTags = array_map('trim', explode(',', $data['new_tags']));
            foreach ($newTags as $tagName) {
                if (!empty($tagName)) {
                    $tag = Tag::firstOrCreate(
                        ['slug' => Str::slug($tagName)],
                        ['name' => $tagName]
                    );
                    $post->tags()->attach($tag->id);
                }
            }
        }

        return redirect()->route('skill-posts.show', $post->id)->with('success', 'Skill post created successfully.');
    }

    /**
     * Delete a skill post (admins and moderators can delete any post).
     */
    public function destroy(SkillPost $skillPost)
    {
        $user = Auth::user();

        // Check if user is staff (admin or moderator)
        if (!$user->isStaff()) {
            abort(403, 'Unauthorized. Only admins and moderators can delete posts.');
        }

        $title = $skillPost->title;
        $skillPost->delete();

        return redirect()->route('skill-posts.index')->with('success', "Post \"$title\" has been deleted.");
    }

    /**
     * Get recommended posts based on tag matching.
     */
    private function getRecommendations(SkillPost $currentPost)
    {
        $tagIds = $currentPost->tags->pluck('id');
        
        if ($tagIds->isEmpty()) {
            return collect();
        }

        // Get posts with matching tags, opposite type, exclude current post
        $oppositeType = $currentPost->type === 'offer' ? 'need' : 'offer';
        
        return SkillPost::with(['tags', 'user'])
            ->where('type', $oppositeType)
            ->where('id', '!=', $currentPost->id)
            ->whereHas('tags', function (Builder $q) use ($tagIds) {
                $q->whereIn('tags.id', $tagIds);
            })
            ->withCount(['tags' => function (Builder $q) use ($tagIds) {
                $q->whereIn('tags.id', $tagIds);
            }])
            ->orderByDesc('tags_count')
            ->limit(5)
            ->get();
    }
}
