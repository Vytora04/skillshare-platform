<?php

namespace App\Http\Controllers;

use App\Models\SkillPost;
use Illuminate\Http\Request;

class SkillPostController extends Controller
{
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
}
