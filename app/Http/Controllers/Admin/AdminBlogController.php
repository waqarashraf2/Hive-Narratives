<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdminBlogController extends Controller
{
    public function index()
    {
        // Get paginated blogs (10 per page)
        $blogs = Blog::with('user')->latest()->paginate(10);
        
        // Get most viewed blogs
        $mostViewed = Blog::orderBy('views_count', 'desc')->take(5)->get();
        
        // Get most liked blogs
        $mostLiked = Blog::orderBy('likes_count', 'desc')->take(5)->get();
        
        // Get recent blogs count (last 24 hours)
        $recentBlogsCount = Blog::where('created_at', '>=', Carbon::now()->subDay())->count();
        
        // Get top authors
        $topAuthors = User::withCount('blogs')->orderBy('blogs_count', 'desc')->take(10)->get();

        return view('admin.blogs.index', compact('blogs', 'mostViewed', 'mostLiked', 'recentBlogsCount', 'topAuthors'));
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $blog->update([
            'title' => $request->title,
            'content' => $request->content,
            'categories' => json_encode(explode(',', $request->categories)),
            'status' => $request->status,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully!');
    }

    public function destroy($id)
    {
        Blog::findOrFail($id)->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully!');
    }
}