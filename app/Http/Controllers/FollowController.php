<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;
use App\Models\User;
use App\Notifications\BlogNotification;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function toggleFollow(Request $request)
    {
        $userId = $request->user_id;
        $authUser = Auth::user();

        // Check if user is already following
        $existingFollow = Follow::where('follower_id', $authUser->id)->where('following_id', $userId)->first();

        if ($existingFollow) {
            $existingFollow->delete(); // Unfollow
            return response()->json(['status' => 'unfollowed']);
        } else {
            Follow::create([
                'follower_id' => $authUser->id,
                'following_id' => $userId,
            ]);
            return response()->json(['status' => 'followed']);
        }
    }


    // Notifications 


    // public function followUser(Request $request)
    // {
    //     $userToFollow = User::findOrFail($request->user_id);
    //     $follower = Auth::user(); // Get the authenticated user
    
    //     if (!$follower) {
    //         return response()->json(['status' => 'error', 'message' => 'You must be logged in to follow.']);
    //     }
    
    //     if ($follower->id === $userToFollow->id) {
    //         return response()->json(['status' => 'error', 'message' => "You can't follow yourself."]);
    //     }
    
    //     $alreadyFollowing = $follower->following()->where('following_id', $userToFollow->id)->exists();
    
    //     if ($alreadyFollowing) {
    //         $follower->following()->detach($userToFollow->id);
    //         return response()->json(['status' => 'unfollowed']);
    //     } else {
    //         $follower->following()->attach($userToFollow->id);
    //         return response()->json(['status' => 'followed']);
    //     }
    // }
    

}
