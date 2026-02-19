@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Edit Blog</h2>

    <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-bold">Title</label>
            <input type="text" name="title" value="{{ old('title', $blog->title) }}" class="w-full p-2 border rounded">
        </div>



        <div class="mb-4">
            <label class="block text-gray-700 font-bold">Content</label>
        
            <!-- Textarea for storing Quill's content (will be automatically updated) -->
            <textarea name="content" style="display: none" id="hiddenContent" class="w-full p-2 border rounded min-h-[200px]">{!! old('content', $blog->content) !!}</textarea>
        
            <!-- Quill Editor Container -->
            <div id="editor" class="w-full p-2 border rounded bg-white min-h-[200px]"></div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold">Featured Image</label>
        
            @if($blog->featured_image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="Current Featured Image" class="h-32 rounded shadow">
                </div>
            @endif
        
            <input type="file" name="featured_image" class="w-full p-2 border rounded">
        </div>
        
        
        <!-- Include Quill.js Styles & Script -->
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
        
        <script>
        document.addEventListener("DOMContentLoaded", function () {
            var quill = new Quill("#editor", {
                theme: "snow",
                placeholder: "Write your blog content here...",
                modules: {
                    toolbar: [
                        [{ header: [1, 2, false] }],
                        ["bold", "italic", "underline"],
                        [{ list: "ordered" }, { list: "bullet" }],
                        ["link", "image"],
                    ],
                },
            });
        
            let textarea = document.querySelector("#hiddenContent");
        
            // ✅ Load existing content from Laravel into Quill
            quill.root.innerHTML = textarea.value;
        
            // ✅ Sync Quill's content with textarea in real-time
            quill.on("text-change", function () {
                textarea.value = quill.root.innerHTML;
            });
        
            // ✅ Ensure the latest content is stored before form submission
            document.querySelector("form").addEventListener("submit", function () {
                textarea.value = quill.root.innerHTML;
            });
        });
        </script>
        
        
        
        

        

        <div class="mb-4">
            <label class="block text-gray-700 font-bold">Categories</label>
            <select name="categories[]" id="categories" class="w-full p-2 border rounded select2" multiple>
                @php
                    $categoriesList = ['Technology', 'Health', 'Finance', 'Travel', 'Personal Development', 'Islamic Content', 'Motivational', 'Quotes'];
                    $selectedCategories = is_array($blog->categories) ? $blog->categories : json_decode($blog->categories, true);
                @endphp
        
                @foreach($categoriesList as $category)
                    <option value="{{ $category }}" {{ in_array($category, $selectedCategories ?? []) ? 'selected' : '' }}>
                        {{ $category }}
                    </option>
                @endforeach
            </select>
        </div>
        <script>
            $(document).ready(function() {
                $('#categories').select2({
                    tags: true,
                    placeholder: "Select categories...",
                    allowClear: true
                });
            });
        </script>
                
        
        

        <div class="mb-4">
            <label class="block text-gray-700 font-bold">Status</label>
            <select name="status" class="w-full p-2 border rounded">
                <option value="draft" {{ $blog->status == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ $blog->status == 'published' ? 'selected' : '' }}>Published</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Blog</button>
        <a href="{{ route('blogs.index') }}" class="text-gray-600 ml-4">Cancel</a>
    </form>
</div>





@endsection
