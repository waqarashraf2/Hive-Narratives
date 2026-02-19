@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-2xl font-bold">{{ $blog->title }}</h2>
    <p class="text-gray-500">Posted on {{ $blog->created_at->format('M d, Y') }}</p>
    
    <div class="mt-4 bg-white p-4 rounded shadow">
        <p class="text-gray-700">{{ $blog->content }}</p>
    </div>

    <a href="{{ route('blogs.index') }}" class="text-blue-500 hover:underline mt-4 inline-block">Back to My Blogs</a>
</div>
@endsection
