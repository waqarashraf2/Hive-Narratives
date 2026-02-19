@extends('layouts.app')

{{-- Max ~60 characters --}}
@section('title', Str::limit($title, 60, ''))

{{-- Max ~160 characters --}}
@section('meta-description', Str::limit($metaDescription, 160, ''))

{{-- Ideally max 10–15 well-targeted keywords --}}
@section('meta-keywords', Str::limit($metaKeywords, 255, ''))

{{-- Proper image path --}}
@section('meta-image', asset('storage/' . $blog->featured_image))


@section('content')
<div class="container mx-auto mt-10 flex flex-col p-0 md:flex-row gap-6 p-0" >
    
    <!-- Left Sidebar (Related Blogs) -->
<div class="container mx-auto mt-10 flex gap-6 p-0">
    

<!-- Sidebar for Related Blogs -->
<div class="w-1/4 bg-white p- rounded-lg shadow-md hidden md:block">
    @if($latestBlogs->count() > 0)
        <h3 class="text-lg font-semibold mb-4 border-b pb-2">Latest Blogs</h3>
        <ul class="space-y-4">
            @foreach($latestBlogs as $latest)
                <li class="flex items-center space-x-4 border-b pb-3 last:border-none">
                    <!-- Blog Image -->
                    <a href="{{ route('blogs.details', ['slug' => $latest->slug]) }}" class="w-1/3 flex-shrink-0">
                        <img loading="lazy" src="{{ asset('storage/' . $latest->featured_image) }}" 
                             alt="{{ $latest->title }}" 
                             class="w-full h-16 object-cover rounded-lg shadow">
                    </a>

                    <!-- Blog Content -->
                    <div class="w-2/3">
                        <a href="{{ route('blogs.details', ['slug' => $latest->slug]) }}" 
                           class="text-sm font-medium text-gray-800 hover:text-blue-600 transition">
                            {{ Str::limit($latest->title, 60) }}
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>

    


    <!-- Main Blog Content -->
    <div class="w-full md:w-2/3  p-0">
<h1 class="text-2xl font-bold text-purple-700">
    {{ Str::limit(strip_tags($blog->title), 70, '') }}
</h1>


<div class="text-gray-500 text-sm mt-2 p-0">
    @if($blog->user) {{-- Check if user exists --}}
        <a href="{{ route('profile.show', $blog->user->username) }}">
            Published on {{ $blog->created_at->format('F d, Y') }} by 
            <strong>{{ $blog->user->name }}</strong>
        </a>
    @else
        Published on {{ $blog->created_at->format('F d, Y') }}
    @endif
</div>

@if($blog->featured_image && file_exists(public_path('storage/' . $blog->featured_image)))
    <img src="{{ asset('storage/' . $blog->featured_image) }}" 
         alt="{{ $blog->title }}" 
         class="w-full object-cover rounded mt-4">
@else
    {{-- Optional placeholder --}}
    <div class="w-full h-48 bg-gray-100 rounded mt-4 flex items-center justify-center">
        <span class="text-gray-400">No Image Available</span>
    </div>
@endif

<div class="mt-6 text-gray-700 leading-relaxed">
    {!! $blog->content !!}
</div>

@if($blog->categories && !empty(json_decode($blog->categories, true)))
    <div class="mt-6">
        <strong class="text-gray-800">Categories:</strong>
        <span class="text-blue-500">
            {{ implode(', ', json_decode($blog->categories, true)) }}
        </span>
    </div>
@endif

        <!--<p class="text-gray-600">Views: {{ $blog->views()->distinct('ip_address')->count() }}</p>-->



<!-- Like, Comment, Bookmark, and Share Section -->
<div class="flex items-center gap-6 mt-4" style="justify-content: space-between">

    <!-- Like Button -->
    <button id="like-btn" class="flex items-center text-gray-600 hover:text-purple-600 transition duration-200">
        <i id="like-icon" class="text-xl fa{{ $blog->isLikedByUser() ? 's' : 'r' }} fa-heart mr-1"></i>
        <span id="like-text">{{ $blog->isLikedByUser() ? 'Unlike' : 'Like' }}</span>
        <!--<span class="ml-1 text-sm text-gray-500">(<span id="like-count">{{ $blog->likes->count() }}</span>)</span>-->
    </button>

    <!-- Comment Button -->
    <button id="comment-btn" class="flex items-center text-gray-600 hover:text-blue-600 transition duration-200">
        <i class="text-xl fas fa-comment mr-1"></i>
        <span></span>
    </button>

    <!-- Bookmark Button -->
    <button id="bookmark-btn" class="flex items-center text-gray-600 hover:text-yellow-500 transition duration-200">
        @auth
            <i id="bookmark-icon" class="text-xl fa{{ auth()->user()->hasBookmarked($blog->id) ? 's' : 'r' }} fa-bookmark mr-1"></i>
            <span id="bookmark-text">{{ auth()->user()->hasBookmarked($blog->id) ? '' : '' }}</span>
        @else
            <i id="bookmark-icon" class="text-xl far fa-bookmark mr-1"></i>
            <span>Bookmark</span>
        @endauth
    </button>

    <!-- Share Button -->
    <button id="share-btn" class="flex items-center text-gray-600 hover:text-green-600 transition duration-200">
        <i class="text-xl fas fa-share-alt mr-1"></i>
        <span></span>
    </button>

</div>






<!-- Share Modal -->
<div id="share-modal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h3 class="text-lg font-bold">Share this article</h3>
        <div class="flex gap-4 mt-2">
            <a id="share-whatsapp" href="#" target="_blank" class="text-green-500">WhatsApp</a>
            <a id="share-facebook" href="#" target="_blank" class="text-blue-700">Facebook</a>
            <a id="share-twitter" href="#" target="_blank" class="text-blue-400">Twitter</a>
            <a id="share-linkedin" href="#" target="_blank" class="text-blue-600">LinkedIn</a>
        </div>
        <button id="close-share" class="mt-4 px-4 py-2 bg-red-500 text-white rounded-lg">Close</button>
    </div>
</div>

<!-- Comments Section -->
<div class="mt-6">
    <h2 class="text-xl font-bold">Comments</h2>
    <div id="comments-list">
        @foreach($blog->comments as $comment)
            <div class="p-2 bg-gray-100 rounded my-2 flex items-start gap-2">
                <img loading="lazy" src="{{ asset('storage/' . $comment->user->profile_photo) }}" class="w-8 h-8 rounded-full" alt="{{ $comment->user->name }}">
                <div>
                    <strong>{{ $comment->user->name }}</strong>
                    <span class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</span>
                    <p>{{ $comment->content }}</p>
                </div>
            </div>
        @endforeach
    </div>
    
    <!-- Add Comment Form -->
    @auth
        <textarea id="comment-content" class="w-full border rounded p-2 mt-2" placeholder="Write a comment..."></textarea>
        <button id="submit-comment" class="bg-blue-500 text-white px-4 py-2 mt-2 rounded">Comment</button>
    @else
        <p class="text-red-500">You must be logged in to comment.</p>
    @endauth

    </div>
    
    <!-- Sidebar for Related Blogs -->




<!-- JavaScript -->
<script>
    
document.addEventListener("DOMContentLoaded", function () {
    const bookmarkBtn = document.getElementById("bookmark-btn");
    const bookmarkIcon = document.getElementById("bookmark-icon");
    const bookmarkText = document.getElementById("bookmark-text");

    bookmarkBtn.addEventListener("click", function () {
        fetch(`/blogs/{{ $blog->id }}/bookmark`, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                "Content-Type": "application/json",
            },
            body: JSON.stringify({}),
        })
        .then(response => response.json())
        .then(data => {
            if (data.bookmarked) {
                bookmarkIcon.classList.remove("far"); // Unfilled icon
                bookmarkIcon.classList.add("fas");    // Filled icon
                bookmarkText.textContent = "";
            } else {
                bookmarkIcon.classList.remove("fas"); // Filled icon
                bookmarkIcon.classList.add("far");    // Unfilled icon
                bookmarkText.textContent = "";
            }
            // Optionally show message
            alert(data.message);
        })
        .catch(error => {
            console.error("Bookmark Error:", error);
        });
    });
});





document.addEventListener("DOMContentLoaded", function () {
    const likeBtn = document.getElementById("like-btn");
    const likeText = document.getElementById("like-text");
    const likeCount = document.getElementById("like-count");
    const shareBtn = document.getElementById("share-btn");
    const shareModal = document.getElementById("share-modal");
    const closeShare = document.getElementById("close-share");
    
    // Like Button
    likeBtn.addEventListener("click", function () {
        fetch(`/blogs/{{ $blog->id }}/like`, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                "Content-Type": "application/json",
            },
        })
        .then(response => response.json())
        .then(data => {
            likeText.textContent = data.liked ? "Unlike" : "Like";
            likeCount.textContent = data.count;
        });
    });
    
    // Share Button
    shareBtn.addEventListener("click", function () {
        shareModal.classList.remove("hidden");
        
        let url = encodeURIComponent(window.location.href);
        let title = encodeURIComponent("{{ $blog->title }}");
        let image = encodeURIComponent("{{ asset('storage/' . $blog->featured_image) }}");
        
        document.getElementById("share-whatsapp").href = `https://api.whatsapp.com/send?text=${title} ${url}`;
        document.getElementById("share-facebook").href = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
        document.getElementById("share-twitter").href = `https://twitter.com/intent/tweet?url=${url}&text=${title}`;
        document.getElementById("share-linkedin").href = `https://www.linkedin.com/sharing/share-offsite/?url=${url}`;
    });
    
    // Close Share Modal
    closeShare.addEventListener("click", function () {
        shareModal.classList.add("hidden");
    });
});
</script>
    </div>
</div>




<!-- Mobile Related Blogs (Below Main Content) -->
<div class="mt-6 md:hidden p-0">
    @if($latestBlogs->count() > 0)
    <h3 class="text-xl font-semibold mb-4">Latest Articals</h3>
    <ul class="space-y-6">
        @foreach($latestBlogs as $latest)
            <li class=" hover:bg-gray-50 transition duration-200 p-0">
                <a href="{{ route('blogs.details', $latest->slug) }}" class="block">
                    <!-- Blog Image -->
                    <img loading="lazy" src="{{ asset('storage/' . $latest->featured_image) }}" alt="{{ $latest->title }}" class="w-full h-48 object-cover rounded-lg">

                    <!-- Blog Title -->
                    <h4 class="text-lg font-semibold text-gray-800 hover:text-purple-600 mt-3">
                        {{ $latest->title }}
                    </h4>

                    <!-- Publisher & Date -->
                    <div class="text-gray-500 text-sm mt-1">
                        <a href="{{ route('profile.show', $latest->user->username) }}">
                            Published on {{ $latest->created_at->format('F d, Y') }} by <strong>{{ $latest->user->name }}</strong>
                        </a>
                    </div>

                    <!-- Blog Snippet (150 words) -->
                    <p class="text-gray-600 text-sm mt-2">
                        {{ Str::words(strip_tags($latest->content), 150) }}
                    </p>

                    <!-- Read More -->
                    <div class="mt-2">
                        <a href="{{ route('blogs.details', $latest->slug) }}" class="text-blue-500 text-sm">Read more</a>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
    @endif
</div>


<!-- JavaScript -->
<script>

document.addEventListener("DOMContentLoaded", function () {
    const likeBtn = document.getElementById("like-btn");
    const likeText = document.getElementById("like-text");
    const likeCount = document.getElementById("like-count");
    const commentContent = document.getElementById("comment-content");
    const submitComment = document.getElementById("submit-comment");
    const commentsList = document.getElementById("comments-list");

    // Like Button

    

    // Comment System
    if (submitComment) {
        submitComment.addEventListener("click", function () {
            const content = commentContent.value.trim();
            if (content === "") {
                alert("Comment cannot be empty.");
                return;
            }

            fetch(`/blogs/{{ $blog->id }}/comment`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ content: content }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.comment) {
                    const newComment = document.createElement("div");
                    newComment.className = "p-2 bg-gray-100 rounded my-2";
                    newComment.innerHTML = `
                        <strong>${data.comment.user}</strong> 
                        <span class="text-gray-500 text-sm">${data.comment.created_at}</span>
                        <p>${data.comment.content}</p>
                    `;
                    commentsList.prepend(newComment);
                    commentContent.value = "";
                }
            })
            .catch(error => console.log(error));
        });
    }
});

</script>

@endsection
