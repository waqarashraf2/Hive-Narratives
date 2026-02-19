@foreach ($blogs as $blog)
<div class="p-0 bg-white rounded blog-card mb-4">
    <a href="{{ route('blogs.details', ['slug' => $blog->slug]) }}">
        @if($blog->featured_image && file_exists(public_path('storage/' . $blog->featured_image)))
            <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full h-40 object-cover">
        @else
            <!-- Optional: Show placeholder if image doesn't exist -->
            <div class="w-full h-40 bg-gray-200 flex items-center justify-center">
                <span class="text-gray-500">No Image</span>
            </div>
        @endif
        
        <h4 class="text-lg font-semibold text-gray-800 hover:text-purple-600 mt-3">{{ $blog->title }}</h4>
        <div class="text-gray-500 text-sm mt">
            <a href="{{ route('profile.show', $blog->user->username) }}">
                Published on {{ $blog->created_at->format('F d, Y') }} by <strong>{{ $blog->user->name }}</strong>
            </a>
        </div>
    </a>
    <p class="text-gray-600 text-sm mt-2">{{ Str::limit(strip_tags($blog->content), 200) }}</p>
    <div class="mt-2">
        <a href="{{ route('blogs.details', ['slug' => $blog->slug]) }}" class="text-blue-500 text-sm">Read more</a>
    </div>
</div>
@endforeach