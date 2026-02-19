<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog; // Ensure you have a Blog model

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::latest()->paginate(9); // Load 6 blogs per request
    
        if ($request->ajax()) {
            return view('partials.blogs', compact('blogs'))->render();
        }
    
        return view('home', [
            'title' => 'HiveNarratives - Your Blogging Platform',
            'metaDescription' => 'Discover and share blogs on travel, health, technology, finance, and more.',
            'metaKeywords' => 'multi-niche blog, HiveNarratives, blogging, articles, travel, health, tech, finance',
            'blogs' => $blogs
        ]);
    }
    
}
