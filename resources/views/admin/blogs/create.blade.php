@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold text-purple-700">Create Blog</h1>

    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf
        <div>
            <label class="block font-semibold">Title</label>
            <input type="text" name="title" class="w-full border p-2 rounded" required>
        </div>
        <div class="mt-3">
            <label class="block font-semibold">Content</label>
            <textarea name="content" class="w-full border p-2 rounded" required></textarea>
        </div>
        <div class="mt-3">
            <label class="block font-semibold">Categories (JSON Format)</label>
            <input type="text" name="categories" class="w-full border p-2 rounded" placeholder='["Technology", "Health"]' required>
        </div>
        <div class="mt-3">
            <label class="block font-semibold">Featured Image</label>
            <input type="file" name="featured_image" class="w-full border p-2 rounded">
        </div>
        <div class="mt-3">
            <label class="block font-semibold">Status</label>
            <select name="status" class="w-full border p-2 rounded">
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>
        </div>
        <div class="mt-4">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded">Save Blog</button>
        </div>
    </form>
</div>
@endsection
