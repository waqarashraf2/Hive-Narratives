@extends('layouts.app')

@section('title', 'HiveNarratives Tips & Stories for Smarter Living')

@section('meta_description', 'Explore real-life stories, practical advice, and smart insights on tech, travel, wellness, finance, and everyday life—made for curious minds in Pakistan and around the world.')

@section('meta-keywords', 'real stories, tech in Pakistan, travel tips, wellness advice, personal growth, digital lifestyle, startup guides, money management, mindful living, productivity hacks, health and fitness, self-care, career advice, creative thinking, emotional well-being, Pakistani lifestyle, smart finance, daily inspiration, youth motivation')



@section('content')

<!-- Hero Section -->

<header class="bg-gray-100 text-center py-10">
    
<center>
<h1 class="text-2xl font-bold text-purple-700">
    HiveNarratives: Real Stories & Tips on Tech, Travel, Wellness, Finance & Life
</h1>

<p class="text-lg text-gray-600 mt-4">
    We’re here to inform, inspire, and connect everyday readers with meaningful content across the topics they care about most.
</p>

</center>


    <div class="mt-6">
        @auth
            <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-6 py-2 rounded">Go to Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="bg-green-600 text-white px-6 py-2 rounded">Login</a>
            <a href="{{ route('register') }}" class="bg-purple-600 text-white px-6 py-2 rounded ml-2">Register</a>
        @endauth
    </div>
</header>
    

<!-- Browse by Category Section -->
<section class="container mx-auto mt-10 p-0">
    <h2 class="text-2xl font-semibold text-gray-700">Browse by Category</h2>
    <div class="flex flex-wrap gap-3 mt-4">
        @php
            $allCategories = [];
            foreach ($blogs as $blog) {
                foreach (json_decode($blog->categories, true) as $category) {
                    $allCategories[$category] = $category;
                }
            }
        @endphp

        @foreach ($allCategories as $category)
            <a href="{{ route('blogs.all', ['category' => urlencode($category)]) }}" 
               class="bg-purple-600 text-white px-2 py-2 rounded hover:bg-purple-700 transition" style="font-size: smaller;">
                {{ $category }}
            </a>
        @endforeach
    </div>
</section>

<!-- Latest Articles Section -->
<section class="container mx-auto mt-10 p-0">
    <h2 class="text-2xl font-semibold text-gray-700">Latest Articles</h2>

    <div id="blog-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
        @include('partials.blogs')
    </div>

    <div id="loading-message" class="text-center mt-6 hidden">
        <p class="text-gray-500">Loading more blogs...</p>
    </div>
</section>



<!-- Infinite Scroll for Lazy Loading -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    let page = 2;
    let loading = false;

    window.addEventListener("scroll", function () {
        let scrollableHeight = document.documentElement.scrollHeight - window.innerHeight;
        let scrolled = window.scrollY;

        if (scrolled >= scrollableHeight - 100 && !loading) {
            loading = true;
            document.getElementById("loading-message").classList.remove("hidden");

            fetch(`?page=${page}`, {
                headers: { "X-Requested-With": "XMLHttpRequest" }
            })
            .then(response => response.text())
            .then(data => {
                if (data.trim() === "") {
                    window.removeEventListener("scroll", arguments.callee);
                } else {
                    document.getElementById("blog-container").insertAdjacentHTML("beforeend", data);
                    page++;
                }
                document.getElementById("loading-message").classList.add("hidden");
                loading = false;
            })
            .catch(error => {
                console.error(error);
                loading = false;
            });
        }
    });
});
</script>

@endsection
