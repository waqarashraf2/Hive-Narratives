@extends('layouts.app')

@section('title', $title)
@section('meta-description', $metaDescription)
@section('meta-keywords', $metaKeywords)
@section('author', $author)

@section('content')
<div class="w-full max-w-4xl mx-auto px-4">
    <!-- Profile Section -->
    <div class="bg-white shadow-lg rounded-xl p-6 text-center transition-all duration-300 hover:shadow-xl">
        <div class="flex flex-col items-center">
            <!-- Avatar with animation and fallback -->
            <div class="relative group">
                @if($user->profile_photo)
                    <img src="{{ asset('storage/' . $user->profile_photo) }}" 
                         class="rounded-full border-4 border-purple-400 shadow-lg w-24 h-24 sm:w-32 sm:h-32 object-cover transition-all duration-500 hover:border-purple-600 hover:scale-105" 
                         alt="Profile Picture">
                @else
                    <div class="rounded-full border-4 border-purple-400 shadow-lg w-24 h-24 sm:w-32 sm:h-32 flex items-center justify-center bg-gradient-to-r from-purple-500 to-pink-500 text-white text-4xl font-bold transition-all duration-500 hover:border-purple-600 hover:scale-105">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
                <div class="absolute -inset-2 rounded-full opacity-0 group-hover:opacity-100 bg-purple-200 blur-md transition-opacity duration-300"></div>
            </div>
            
            <!-- User Info -->
            <div class="mt-4 space-y-1">
                <h2 class="text-xl sm:text-2xl font-bold text-gray-800 animate-fade-in">{{ $user->name }}</h2>
                <p class="text-gray-500 text-sm animate-fade-in">@ {{ $user->username }}</p>
                <p class="text-gray-600 text-sm sm:text-base text-center mt-1 max-w-md mx-auto animate-fade-in">
                    {{ $user->bio ?? 'No bio available' }}
                </p>
            </div>

            <!-- Stats with animation -->
            <div class="flex gap-4 sm:gap-6 mt-4 text-gray-700 text-sm sm:text-base animate-fade-in-up">
                <div class="flex flex-col items-center">
                    <strong id="followers-count" class="text-xl text-purple-600">{{ $user->followers()->count() }}</strong>
                    <span class="text-xs text-gray-500">Followers</span>
                </div>
                <div class="flex flex-col items-center">
                    <strong class="text-xl text-purple-600">{{ $user->following()->count() }}</strong>
                    <span class="text-xs text-gray-500">Following</span>
                </div>
                <div class="flex flex-col items-center">
                    <strong class="text-xl text-purple-600">{{ $blogs->count() }}</strong>
                    <span class="text-xs text-gray-500">Blogs</span>
                </div>
            </div>

            @auth
                @if(Auth::id() !== $user->id)
                    <button id="follow-btn" class="mt-4 px-6 py-2 rounded-full text-white font-medium transition-all duration-300 transform hover:scale-105 shadow-md
                        {{ Auth::user()->isFollowing($user->id) ? 'bg-gradient-to-r from-red-500 to-pink-500 hover:shadow-red-200' : 'bg-gradient-to-r from-blue-500 to-purple-500 hover:shadow-blue-200' }}">
                        {{ Auth::user()->isFollowing($user->id) ? 'Unfollow' : 'Follow' }}
                    </button>
                @endif
            @endauth
        </div>
    </div>

    <!-- Blogs Section -->
    <h3 class="text-xl sm:text-2xl font-bold mt-8 mb-4 text-gray-800 relative inline-block">
        <span>Blogs by {{ $user->name }}</span>
        <span class="absolute bottom-0 left-0 w-full h-1 bg-purple-200 rounded-full animate-scale-x"></span>
    </h3>

    @forelse ($blogs as $blog)
        <div class="bg-white shadow-md rounded-xl p-4 flex gap-4 items-center mb-4 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
            <img src="{{ asset('storage/' . $blog->featured_image) }}" 
                 class="w-20 h-16 sm:w-36 sm:h-24 object-cover rounded-lg shadow-sm transition-all duration-300 hover:scale-105" 
                 alt="{{ $blog->title }}" 
                 onerror="this.src='https://via.placeholder.com/150?text=Blog+Image'">
            
            <div class="flex-1 min-w-0">
                <h4 class="text-sm sm:text-base font-bold truncate">
                    <a href="{{ route('blogs.details', $blog->slug) }}" 
                       class="text-gray-800 hover:text-purple-600 transition-colors duration-200">
                        {{ $blog->title }}
                    </a>
                </h4>
                <p class="text-xs sm:text-sm text-gray-600 mt-1 line-clamp-2">{{ Str::limit(strip_tags($blog->content), 100) }}</p>
                <div class="flex items-center mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <small class="text-gray-500 ml-1">{{ $blog->created_at->format('F d, Y') }}</small>
                </div>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-xl p-8 text-center shadow-sm animate-pulse">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <p class="text-gray-600 mt-2">No blogs published yet.</p>
        </div>
    @endforelse
</div>

<style>
    .animate-fade-in {
        animation: fadeIn 0.6s ease-out;
    }
    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out;
    }
    .animate-scale-x {
        animation: scaleX 1.5s ease-in-out infinite alternate;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes fadeInUp {
        from { 
            opacity: 0;
            transform: translateY(10px);
        }
        to { 
            opacity: 1;
            transform: translateY(0);
        }
    }
    @keyframes scaleX {
        from { transform: scaleX(0.5); }
        to { transform: scaleX(1); }
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#follow-btn').click(function() {
        let userId = {{ $user->id }};
        let button = $(this);

        // Add loading state
        button.html('<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Processing...');
        button.addClass('opacity-75 cursor-not-allowed');

        $.ajax({
            url: "{{ route('follow.toggle') }}",
            method: "POST",
            data: {
                user_id: userId,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.status === 'followed') {
                    button.html('Unfollow').removeClass('bg-gradient-to-r from-blue-500 to-purple-500').addClass('bg-gradient-to-r from-red-500 to-pink-500');
                } else {
                    button.html('Follow').removeClass('bg-gradient-to-r from-red-500 to-pink-500').addClass('bg-gradient-to-r from-blue-500 to-purple-500');
                }

                // Update Followers Count with animation
                $('#followers-count').addClass('text-green-500 scale-110');
                setTimeout(() => {
                    $('#followers-count').removeClass('scale-110');
                }, 300);
                setTimeout(() => {
                    $('#followers-count').removeClass('text-green-500');
                }, 1000);
                $('#followers-count').text(response.followers_count);
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                alert('Something went wrong. Please try again.');
            },
            complete: function() {
                button.removeClass('opacity-75 cursor-not-allowed');
            }
        });
    });
});
</script>
@endsection