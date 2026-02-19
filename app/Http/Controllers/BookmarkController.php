<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function toggleBookmark($blogId)
    {
        $user = Auth::user();
        $bookmark = Bookmark::where('user_id', $user->id)->where('blog_id', $blogId)->first();

        if ($bookmark) {
            $bookmark->delete();
            return response()->json(['bookmarked' => false, 'message' => 'Bookmark removed']);
        } else {
            Bookmark::create(['user_id' => $user->id, 'blog_id' => $blogId]);
            return response()->json(['bookmarked' => true, 'message' => 'Blog bookmarked']);
        }
    }

    public function getUserBookmarks()
    {
        $user = Auth::user();
        $bookmarks = Bookmark::where('user_id', $user->id)->with('blog')->get();
        return response()->json($bookmarks);
    }
}
