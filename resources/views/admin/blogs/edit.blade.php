@extends('layouts.admin')

@section('content')
<div class="container mx-auto mt-10">
    <h2 class="text-2xl font-semibold text-gray-700">Edit Blog</h2>

    <div class="mt-4 bg-white shadow-md rounded p-4">
        <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700">Title</label>
                <input type="text" name="title" value="{{ $blog->title }}" class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Content</label>
                <textarea name="content" class="w-full p-2 border rounded">{{ $blog->content }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Categories (comma separated)</label>
                <input type="text" name="categories" value="{{ implode(', ', json_decode($blog->categories, true)) }}" class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Status</label>
                <select name="status" class="w-full p-2 border rounded">
                    <option value="draft" {{ $blog->status == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ $blog->status == 'published' ? 'selected' : '' }}>Published</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">Update Blog</button>
        </form>
    </div>
</div>
@endsection
