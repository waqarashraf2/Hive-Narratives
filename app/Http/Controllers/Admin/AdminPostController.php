<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Str;

class AdminPostController extends Controller
{
    
    
public function index()
{
    
       // Get blogs from last 24 hours
    $recentBlogsCount = Blog::where('created_at', '>=', now()->subDay())->count();
   
    // Get all blogs with their counts
    $blogs = Blog::withCount(['views', 'likes', 'comments'])
                ->with(['user'])
                ->latest()
                ->get();
    
    // Get most viewed blogs (handle case where no views exist)
    $mostViewed = Blog::withCount('views')
                    ->having('views_count', '>', 0)
                    ->orderBy('views_count', 'desc')
                    ->take(5)
                    ->get();
    
    // Get most liked blogs (handle case where no likes exist)
    $mostLiked = Blog::withCount('likes')
                    ->having('likes_count', '>', 0)
                    ->orderBy('likes_count', 'desc')
                    ->take(5)
                    ->get();
    
   // Get top 10 authors by blog count
    $topAuthors = User::withCount('blogs')
                    ->orderBy('blogs_count', 'desc')
                    ->take(10)
                    ->get();
    
    // Existing code...
    
    return view('admin.blogs.index', [
        'blogs' => $blogs,
        'mostViewed' => $mostViewed,
        'mostLiked' => $mostLiked,
        'recentBlogsCount' => $recentBlogsCount,
        'topAuthors' => $topAuthors // Add this to the view data
    ]);
}
    

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'categories' => 'required|json',
            'featured_image' => 'nullable|image|max:2048',
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->content = $request->content;
        $blog->categories = $request->categories;
        $blog->status = $request->status;

        if ($request->hasFile('featured_image')) {
            $blog->featured_image = $request->file('featured_image')->store('blogs', 'public');
        }

        $blog->save();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'categories' => 'required|string',
            'status' => 'required|in:draft,published',
        ]);
    
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
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
    }
}
