<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('dashboard.admin', ['recentUsers' => collect(), 'recentActivities' => collect()]);
    }

    public function create()
    {
        return redirect()->route('admin.blog.index')->with('success', 'Blog creation flow is ready for implementation.');
    }

    public function store(Request $request)
    {
        return back()->with('success', 'Blog creation flow is ready for implementation.');
    }

    public function show(BlogPost $blog)
    {
        return redirect()->route('admin.blog.index');
    }

    public function edit(BlogPost $blog)
    {
        return redirect()->route('admin.blog.index')->with('success', 'Blog editing flow is ready for implementation.');
    }

    public function update(Request $request, BlogPost $blog)
    {
        return back()->with('success', 'Blog update flow is ready for implementation.');
    }

    public function destroy(BlogPost $blog)
    {
        return back()->with('success', 'Blog delete flow is ready for implementation.');
    }

    public function publish(BlogPost $post)
    {
        $post->update(['is_published' => true, 'published_at' => now()]);

        return back()->with('success', 'Blog post published.');
    }
}
