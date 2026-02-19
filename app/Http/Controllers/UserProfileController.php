<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function show($username)
    {
        // Fetch user by username
        $user = User::where('username', $username)->firstOrFail();
    
        // Fetch user blogs
        $blogs = $user->blogs()->latest()->get();
    
        // Dynamic Meta Tags
        $metaTitle = $user->name . " - HiveNarratives";
        $metaDescription = $user->bio ?? "Explore blogs by " . $user->name . " on HiveNarratives.";
        $metaKeywords = str_replace(' ', ', ', $user->bio ?? "blogger, writer, HiveNarratives");
    
        return view('profile.public_profile', [
            'user' => $user,
            'blogs' => $blogs,
            'title' => $metaTitle,
            'metaDescription' => $metaDescription,
            'metaKeywords' => $metaKeywords,
            'author' => $metaTitle
        ]);
    }
    
}
