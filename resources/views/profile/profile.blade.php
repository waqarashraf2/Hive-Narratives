@extends('layouts.app')

@section('content')
<!-- Profile Card -->
<div class="min-h-screen bg-gray-50 flex justify-center px-0 py-8">
    <div class="w-full max-w-3xl space-y-6">
        <!-- Main Profile Card -->
        <div class="bg-white shadow-xl rounded-xl p-6 relative overflow-hidden transition-all duration-300 hover:shadow-2xl">
            <!-- Decorative elements -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-purple-100 rounded-full transform translate-x-16 -translate-y-16 opacity-70"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-blue-100 rounded-full transform -translate-x-12 translate-y-12 opacity-70"></div>
            
            <!-- Profile Picture -->
            <div class="flex flex-col items-center relative z-10">
                <div class="relative group">
                    @if($user->profile_photo)
                        <img src="{{ asset('storage/' . $user->profile_photo) }}" 
                             alt="Profile Photo" 
                             class="w-24 h-24 sm:w-28 sm:h-28 rounded-full object-cover border-4 border-purple-200 shadow-lg transition-all duration-500 group-hover:border-purple-400 group-hover:scale-105">
                    @else
                        <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-full flex items-center justify-center border-4 border-purple-200 shadow-lg bg-gradient-to-br from-purple-400 to-blue-500 text-white text-4xl font-bold transition-all duration-500 group-hover:border-purple-400 group-hover:scale-105">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                    <div class="absolute inset-0 rounded-full opacity-0 group-hover:opacity-100 bg-purple-200 blur-md transition-opacity duration-300"></div>
                </div>

                <!-- Name & Username -->
                <h2 class="text-2xl font-bold text-gray-800 mt-4 animate-fade-in">{{ $user->name }}</h2>
                <p class="text-purple-600 font-medium text-sm bg-purple-50 px-3 py-1 rounded-full mt-1 animate-fade-in">@ {{ $user->username }}</p>

                <!-- Follow Button -->
                @if(Auth::id() !== $user->id)
                    <button id="follow-btn" 
                        class="mt-4 px-6 py-2 text-white font-semibold rounded-full shadow-md transition-all duration-300 transform hover:scale-105 {{ Auth::user()->isFollowing($user->id) ? 'bg-gradient-to-r from-red-500 to-pink-500 hover:shadow-red-200' : 'bg-gradient-to-r from-blue-500 to-purple-500 hover:shadow-blue-200' }}">
                        {{ Auth::user()->isFollowing($user->id) ? 'Unfollow' : 'Follow' }}
                    </button>
                @endif
            </div>

            <!-- Followers & Following -->
            <div class="flex justify-center gap-8 mt-6 animate-fade-in-up">
                <div class="text-center">
                    <p class="text-gray-800 font-bold text-2xl" id="followers-count">{{ $user->followers()->count() }}</p>
                    <p class="text-gray-500 text-sm">Followers</p>
                </div>
                <div class="text-center">
                    <p class="text-gray-800 font-bold text-2xl">{{ $user->following()->count() }}</p>
                    <p class="text-gray-500 text-sm">Following</p>
                </div>
            </div>

            <!-- User Details -->
            <div class="mt-8 text-gray-700 animate-fade-in-up">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach([
                        ['icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 
                         'label' => 'Email:', 
                         'value' => $user->email],
                        
                        ['icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z',
                         'label' => 'Location:', 
                         'value' => $user->location ?? 'Not specified'],
                        
                        ['icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
                         'label' => 'Date of Birth:', 
                         'value' => $user->date_of_birth ? \Carbon\Carbon::parse($user->date_of_birth)->format('M d, Y') : 'Not specified'],
                        
                        ['icon' => 'M12 4v16m8-8H4',
                         'label' => 'Gender:', 
                         'value' => $user->gender ?? 'Not specified'],
                        
                        ['icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
                         'label' => 'Joined:', 
                         'value' => $user->created_at->format('M d, Y')]
                    ] as $item)
                    <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                        <svg class="w-6 h-6 text-purple-500 flex-shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}" />
                        </svg>
                        <div>
                            <p class="font-semibold text-gray-800">{{ $item['label'] }}</p>
                            <p class="text-gray-600">{{ $item['value'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Edit Profile Button (Only for Owner) -->
            @if(Auth::id() == $user->id)
                <div class="mt-8 text-center animate-fade-in-up">
                    <a href="{{ route('profile.edit') }}" 
                       class="inline-flex items-center bg-blue-600 text-white px-6 py-2 rounded-full shadow-md hover:bg-blue-700 transition-all duration-300 transform hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Profile
                    </a>
                </div>
            @endif
        </div>

        <!-- Bookmarked Blogs Section -->
        <div class="bg-white shadow-xl rounded-xl p-6 transition-all duration-300 hover:shadow-2xl">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                </svg>
                Bookmarked Blogs
            </h3>
            
            @if($bookmarks->isEmpty())
                <div class="text-center py-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <p class="text-gray-500 mt-2">No bookmarked blogs yet</p>
                    <a href="{{ route('blogs.index') }}" class="text-purple-600 hover:underline mt-2 inline-block">Explore blogs</a>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($bookmarks as $bookmark)
                        <a href="{{ route('blogs.details', $bookmark->blog->slug) }}" 
                           class="block p-4 bg-gray-50 border-l-4 border-purple-400 rounded-lg shadow-sm hover:bg-purple-50 transition-all duration-200 transform hover:-translate-y-1 group">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-800 group-hover:text-purple-600 transition-colors">{{ $bookmark->blog->title }}</h4>
                                    <div class="flex items-center mt-2 text-sm text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $bookmark->blog->created_at->format('M d, Y') }}
                                    </div>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-400 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .animate-fade-in {
        animation: fadeIn 0.6s ease-out;
    }
    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes fadeInUp {
        from { 
            opacity: 0;
            transform: translateY(15px);
        }
        to { 
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<!-- jQuery for Follow Button -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#follow-btn').click(function() {
        let userId = {{ $user->id }};
        let button = $(this);

        // Add loading state
        button.html('<svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Processing');
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

                // Animate followers count change
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