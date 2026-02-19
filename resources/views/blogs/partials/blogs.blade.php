<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    @foreach ($blogs as $blog)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
            {{-- Blog Image --}}
            @if ($blog->featured_image)
                <a href="{{ route('blogs.details', $blog->slug) }}" aria-label="Read {{ $blog->title }}">
                    <img loading="lazy"
                         src="{{ asset('storage/' . $blog->featured_image) }}"
                         class="w-full h-64 object-cover"
                         alt="{{ $blog->title }}"
                         width="400"
                         height="256">
                </a>
            @endif

            {{-- Blog Content --}}
            <div class="p-6">
                {{-- Category --}}
                @if($blog->category)
                <span class="inline-block px-3 py-1 text-xs font-semibold text-purple-600 bg-purple-100 rounded-full mb-2">
                    {{ ucfirst($blog->category) }}
                </span>
                @endif

                {{-- Title --}}
                <h2 class="text-xl font-semibold text-gray-800 mb-2 hover:text-blue-600">
                    <a href="{{ route('blogs.details', $blog->slug) }}" class="hover:underline">
                        {{ $blog->title }}
                    </a>
                </h2>

                {{-- Author & Date --}}
                <div class="flex items-center text-sm text-gray-500 mb-3">
                    <a href="{{ route('profile.show', $blog->user->username) }}" class="hover:underline flex items-center">
                        @if($blog->user->profile_photo)
                            <img src="{{ asset('storage/' . $blog->user->profile_photo) }}" 
                                 class="w-6 h-6 rounded-full mr-2" 
                                 alt="{{ $blog->user->name }}">
                        @endif
                        <span class="font-medium text-gray-700">{{ $blog->user->name }}</span>
                        <span class="mx-2">•</span>
                        <time datetime="{{ $blog->created_at->toIso8601String() }}">
                            {{ $blog->created_at->format('F d, Y') }}
                        </time>
                    </a>
                </div>

                {{-- Content Snippet --}}
                <p class="text-gray-600 mb-4 leading-relaxed">
                    {{ Str::limit(strip_tags($blog->content), 250) }}
                </p>

                {{-- Read More --}}
                <div class="flex justify-between items-center">
                    <a href="{{ route('blogs.details', $blog->slug) }}" 
                       class="text-purple-600 hover:text-purple-800 font-medium text-sm hover:underline">
                        Read more →
                    </a>
                    <span class="text-xs text-gray-400">
                        {{ $blog->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>
        </div>
    @endforeach
</div>

@if($blogs->isEmpty())
<div class="bg-white rounded-lg shadow p-8 text-center">
    <h3 class="text-lg font-medium text-gray-700 mb-2">No articles found</h3>
    <p class="text-gray-500">Try adjusting your search or filter to find what you're looking for.</p>
</div>
@endif