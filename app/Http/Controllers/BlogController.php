<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Like;
use App\Models\Comment;
use App\Models\BlogView;
use App\Models\Credit;

class BlogController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        $costPerArticle = 2;

        // ✅ Get user's credits from credits table
        $credit = Credit::firstOrCreate(['user_id' => $user->id], ['credits' => 0]);
        $availableCredits = $credit->credits;

        $publishableArticles = floor($availableCredits / $costPerArticle);

        return view('blogs.create', compact(
            'availableCredits',
            'publishableArticles',
            'costPerArticle'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'categories' => 'required|array',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $user = Auth::user();
        $costPerArticle = 2;

        // ✅ Get credits model for the user
        $credit = Credit::firstOrCreate(['user_id' => $user->id], ['credits' => 0]);

        if ($request->status === 'published' && $credit->credits < $costPerArticle) {
            return redirect()->route('credits.purchase')
                ->with('error', 'You need credits to publish articles. Please purchase credits first. 10 credits = 5 articles (2 credits per article)');
        }

        // Deduct credits atomically only if publishing
        if ($request->status === 'published') {
            $credit->decrement('credits', $costPerArticle);
        }

        $imagePath = null;

        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('storage/blog_images');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);
            $imagePath = 'blog_images/' . $imageName;
        }

        $primaryCategory = Str::slug($request->categories[0]);
        $baseSlug = Str::slug($request->title);
        $fullSlug = "{$primaryCategory}/{$baseSlug}";

        $existingCount = Blog::where('slug', $fullSlug)->count();
        if ($existingCount > 0) {
            $fullSlug .= '-' . Str::random(4);
        }

        Blog::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'slug' => $fullSlug,
            'content' => strip_tags($request->content, '<h1><h2><h3><h4><h5><h6><p><strong><em><u><a><ul><ol><li>'),
            'categories' => json_encode($request->categories),
            'featured_image' => $imagePath,
            'status' => $request->status,
        ]);

        $message = $request->status === 'published'
            ? 'Blog published successfully! 2 credits were deducted from your account.'
            : 'Blog saved as draft successfully!';

        return redirect()->route('blogs.create')->with('success', $message);
    }

    public function index()
    {
        $blogs = Blog::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('blogs.index', compact('blogs'));
    }

    public function home()
    {
        $blogs = Blog::latest()->get(); // Fetch all blog posts
        return view('home', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        if ($blog->user_id !== Auth::id()) {
            abort(403, 'Unauthorized Access');
        }
        return view('blogs.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        if ($blog->user_id !== Auth::id()) {
            return redirect()->route('blogs.index')->with('error', 'Unauthorized access.');
        }

        return view('blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        if ($blog->user_id !== Auth::id()) {
            abort(403, 'Unauthorized Access');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'categories' => 'required|array',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        // Check credits if changing from draft to published
        $user = Auth::user();
        $costPerArticle = 2;

        if ($blog->status === 'draft' && $request->status === 'published') {
            if ($user->credits < $costPerArticle) {
                return redirect()->route('credits.purchase')
                    ->with('error', 'You need credits to publish this article. Please purchase credits first.');
            }
            
            // Deduct credits
            $user->credits -= $costPerArticle;
            $user->save();
        }

        // 🧠 Featured Image Upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($blog->featured_image && file_exists(public_path('storage/' . $blog->featured_image))) {
                unlink(public_path('storage/' . $blog->featured_image));
            }

            $image = $request->file('featured_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('storage/blog_images');

            // Ensure folder exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Move the file to public/storage/blog_images
            $image->move($destinationPath, $imageName);

            // Save image path
            $blog->featured_image = 'blog_images/' . $imageName;
        }

        // 🧠 Update other fields
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title) . '-' . time();
        $blog->content = strip_tags($request->content, '<h1><h2><h3><h4><h5><h6><p><strong><em><u><a><ul><ol><li>');
        $blog->categories = json_encode($request->categories);
        $blog->status = $request->status;

        $blog->save();

        $message = $request->status === 'published' 
            ? 'Blog published successfully!' 
            : 'Blog updated as draft successfully!';
            
        return redirect()->route('blogs.index')->with('success', $message);
    }

    public function destroy(Blog $blog)
    {
        if ($blog->user_id !== Auth::id()) {
            abort(403, 'Unauthorized Access');
        }

        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully!');
    }

    public function show2($slug)
    {
        // Fetch blog with its author
        $blog = Blog::with('user')
            ->where('slug', $slug)
            ->firstOrFail();

        // Generate meta description (first 150 words without HTML)
        $metaDescription = Str::words(strip_tags($blog->content), 150);

        // Get meta keywords from the blog categories
        $metaKeywords = implode(', ', json_decode($blog->categories, true));

        // ✅ Fetch the latest 6 published blogs (excluding the current blog) with user and content
        $latestBlogs = Blog::with('user')
            ->where('id', '!=', $blog->id)
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get(['id', 'title', 'slug', 'featured_image', 'categories', 'user_id', 'content', 'created_at']);

        // Track Blog View (Store every visit)
        $userId = Auth::id();
        $ipAddress = request()->ip();

        // Record a new view every time
        \App\Models\BlogView::create([
            'blog_id' => $blog->id,
            'user_id' => $userId ?? null,
            'ip_address' => $ipAddress
        ]);

        // Count unique visitors based on IP Address
        $uniqueVisitorsCount = \App\Models\BlogView::where('blog_id', $blog->id)
            ->distinct('ip_address')  // Count only unique IP addresses
            ->count();

        // Return view with all data
        return view('blogs.details', [
            'blog' => $blog,
            'title' => $blog->title,
            'metaDescription' => $metaDescription,
            'metaKeywords' => $metaKeywords,
            'latestBlogs' => $latestBlogs,
            'uniqueVisitorsCount' => $uniqueVisitorsCount,  // Pass the unique visitors count to the view
        ]);
    }

    // like button
    public function like(Blog $blog)
    {
        $user = Auth::user();

        // Check if the user already liked this blog
        $like = Like::where('blog_id', $blog->id)->where('user_id', $user->id)->first();

        if ($like) {
            // Unlike (delete the like)
            $like->delete();
            $liked = false;
        } else {
            // Add like
            Like::create([
                'blog_id' => $blog->id,
                'user_id' => $user->id,
            ]);
            $liked = true;
        }

        // Return the total like count
        return response()->json([
            'liked' => $liked,
            'likes' => $blog->likes()->count(),
        ]);
    }

    public function allBlogs(Request $request)
    {
        $query = Blog::where('status', 'published')->latest();

        $pageTitle = 'All Blog Articles | HiveNarratives';
        $metaDescription = 'Explore all blog articles on HiveNarratives, including insights across technology, lifestyle, finance, and more.';
        $metaKeywords = 'blog articles, hive narratives, explore topics';

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category')) {
            $category = urldecode($request->category);

            $query->where(function ($q) use ($category) {
                $q->whereJsonContains('categories', $category)
                  ->orWhere('categories', 'like', '%"'.$category.'"%')
                  ->orWhere('categories', 'like', '%'.$category.'%');
            });

            // ✅ Update meta for category filter
            $pageTitle = ucfirst($category) . ' Articles | HiveNarratives';
            $metaDescription = "Discover the latest articles in the category '{$category}' on HiveNarratives.";
            $metaKeywords = $category . ', ' . $category . ' blogs, hive narratives';
        }

        $blogs = $query->paginate(10);

        // Check if the request is AJAX
        if ($request->ajax()) {
            return view('blogs.partials.blogs', compact('blogs'))->render();
        }

        // Collect all unique categories
        $allCategories = Blog::whereNotNull('categories')->pluck('categories')->toArray();
        $categories = [];

        foreach ($allCategories as $jsonCategories) {
            $decodedCategories = json_decode($jsonCategories, true);
            if (is_array($decodedCategories)) {
                foreach ($decodedCategories as $cat) {
                    $categories[$cat] = $cat;
                }
            }
        }

        // ✅ Pass SEO variables to the view
        return view('blogs.all', compact('blogs', 'categories', 'pageTitle', 'metaDescription', 'metaKeywords'));
    }
}