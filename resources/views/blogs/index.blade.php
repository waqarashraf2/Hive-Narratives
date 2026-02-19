@extends('layouts.app')

@section('content')
<div class="container mx-auto p-0" style="margin-top:100px;">
    <h1 class="text-2xl font-bold text-gray-700 mb-4 mt-3">My Blogs</h1>

    @if($blogs->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($blogs as $blog)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    @if($blog->featured_image)
                        <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="Blog Image" class="w-full h-48 object-cover">
                    @else
                        <img src="{{ asset('images/default-blog.jpg') }}" alt="Default Image" class="w-full h-48 object-cover">
                    @endif

                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $blog->title }}</h3>
                        <p class="text-gray-600 mt-2">{{ Str::limit(strip_tags($blog->content), 100) }}</p>

                        <div class="flex justify-between items-center mt-4">
                            <span class="px-3 py-1 text-sm font-semibold rounded 
                                {{ $blog->status == 'published' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">
                                {{ ucfirst($blog->status) }}
                            </span>

                            <!--<a href="{{ route('blogs.details', $blog->id) }}" class="text-blue-500 hover:underline">Read More</a>-->
                        </div>
                    </div>

                    <div class="flex justify-between p-4 border-t">
                        <a href="{{ route('blogs.edit', $blog->id) }}" class="text-yellow-500 hover:text-yellow-700">✏️ Edit</a>
                        
                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">🗑️ Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500">You haven't posted any blogs yet.</p>
    @endif
</div>
@endsection
