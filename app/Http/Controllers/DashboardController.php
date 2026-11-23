<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'posts'     => Post::count(),
            'published' => Post::published()->count(),
            'draft'     => Post::where('status', 'draft')->count(),
            'projects'  => Project::count(),
            'images'    => ProjectImage::count(),
            'users'     => User::count(),
        ];

        $latestPosts = Post::latest()->take(5)->get();

        $topProjects = Project::withCount('images')
            ->orderByDesc('images_count')
            ->orderBy('judul')
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'latestPosts', 'topProjects'));
    }
}
