<?php 

namespace App\Http\Controllers;

use App\Notifications\BlogNotification;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Like;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleLike($id)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $blog = Blog::findOrFail($id);
        $user = Auth::user();

        $like = Like::where('blog_id', $id)->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            $blog->likes()->create(['user_id' => $user->id]);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'count' => $blog->likes()->count()
        ]);
    }


    // notifications 


// public function likeBlog(Request $request)
// {
//     $blog = Blog::findOrFail($request->blog_id);
//     $user = Auth::user();

//     // Check if user already liked the blog
//     if ($blog->likes()->where('user_id', $user->id)->exists()) {
//         return response()->json(['status' => 'already_liked']);
//     }

//     $blog->likes()->create(['user_id' => $user->id]);

//     // Send notification to the blog owner
//     if ($blog->user_id !== $user->id) {
//         $blog->user->notify(new BlogNotification(
//             "{$user->name} liked your blog: {$blog->title}",
//             route('blogs.show', $blog->slug)
//         ));
//     }

//     return response()->json(['status' => 'liked']);
// }

}
