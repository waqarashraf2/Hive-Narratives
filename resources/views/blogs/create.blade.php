@extends('layouts.app')

@section('content')


{{-- Credit Purchase Banner - Always visible at the top --}}
<div style="background:linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding:15px; border-radius:8px; margin-bottom:20px; color:white; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap;">
    <div>
        <strong style="font-size:1.2rem;">💰 Need More Credits?</strong>
        <p style="margin:5px 0 0 0; opacity:0.9;">Get 10 credits for just $X - Publish 5 articles!</p>
    </div>
    <a href="{{ route('credits.purchase') }}" style="background:white; color:#764ba2; padding:10px 25px; border-radius:25px; text-decoration:none; font-weight:bold; box-shadow:0 4px 6px rgba(0,0,0,0.1); transition:transform 0.2s;" 
       onmouseover="this.style.transform='scale(1.05)'" 
       onmouseout="this.style.transform='scale(1)'">
        ⚡ Purchase Credits Now
    </a>
</div>
{{-- Add this success message section --}}
@if(session('success'))
    <div style="background:#d1fae5; border:1px solid #10b981; padding:12px; border-radius:6px; margin-bottom:15px;" class="alert alert-success">
        <strong>✅ Success!</strong><br>
        {{ session('success') }}
    </div>
@endif

{{-- Also add error message display if needed --}}
@if(session('error'))
    <div style="background:#fee2e2; border:1px solid #ef4444; padding:12px; border-radius:6px; margin-bottom:15px;" class="alert alert-danger">
        <strong>❌ Error!</strong><br>
        {{ session('error') }}
    </div>
@endif

{{-- Add validation errors display --}}
@if($errors->any())
    <div style="background:#fee2e2; border:1px solid #ef4444; padding:12px; border-radius:6px; margin-bottom:15px;">
        <strong>❌ Please fix the following errors:</strong>
        <ul class="mt-2 mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if($availableCredits > 0)
    <div style="background:#ecfdf5; border:1px solid #10b981; padding:12px; border-radius:6px; margin-bottom:15px;">
        <strong>📢 Credit Information:</strong><br>
        You currently have <strong>{{ $availableCredits }}</strong> credits in your account.<br>
        1 article requires <strong>{{ $costPerArticle }}</strong> credits.<br>
        You can publish <strong>{{ $publishableArticles }}</strong> more article(s).
    </div>
@else
    <div style="background:#fef2f2; border:1px solid #ef4444; padding:12px; border-radius:6px; margin-bottom:15px;">
        <strong>⚠ No Credits Available</strong><br>
        You currently have 0 credits. Please purchase credits to publish articles.
        <br>
        <a href="{{ route('credits.purchase') }}" style="color:#dc2626; text-decoration:underline;">
            Purchase Credits
        </a>
    </div>
@endif

<div class="container mx-auto max-w-4xl px-6 py-8 bg-white rounded-2xl shadow-lg mt-10">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">📝 Create a New Blog</h2>

    <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" class="form-control w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Content</label>
            
            <!-- Hidden textarea -->
            <textarea name="content" id="hiddenContent" style="display:none;">{{ old('content') }}</textarea>

            <!-- Quill editor -->
            <div id="editor" class="w-full p-3 border rounded-lg bg-white min-h-[200px] shadow-sm"></div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Featured Image</label>
            <input type="file" name="featured_image" class="form-control w-full">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Select Categories</label>
            <select name="categories[]" multiple required class="form-control w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="API">API</option>
                <option value="Artificial Intelligence">Artificial Intelligence</option>
                <option value="Artist">Artist</option>
                <option value="Beauty">Beauty</option>
                <option value="Blog">Blog</option>
                <option value="Business">Business</option>
                <option value="Digital Marketing">Digital Marketing</option>
                <option value="E-commerce">E-commerce</option>
                <option value="Education">Education</option>
                <option value="Fashion">Fashion</option>
                <option value="Finance">Finance</option>
                <option value="Fitness">Fitness</option>
                <option value="General">General</option>
                <option value="Health">Health</option>
                <option value="History">History</option>
                <option value="Islamic Content">Islamic Content</option>
                <option value="Law & justice">Law & justice</option>
                <option value="Legal">Legal</option>
                <option value="Life style">Life style</option>
                <option value="Marketing">Marketing</option>
                <option value="Medical">Medical</option>
                <option value="Model">Model</option>
                <option value="Motivational">Motivational</option>
                <option value="Music">Music</option>
                <option value="News">News</option>
                <option value="Personal Development">Personal Development</option>
                <option value="Photography">Photography</option>
                <option value="Quotes">Quotes</option>
                <option value="Shayari">Shayari</option>
                <option value="Sports">Sports</option>
                <option value="Technology">Technology</option>
                <option value="Tips & Tricks">Tips & Tricks</option>
                <option value="Travel">Travel</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
            <select name="status" class="form-control w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
            </select>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-md shadow-md transition duration-200">
                🚀 Publish Blog
            </button>
        </div>
    </form>
</div>

<!-- Quill Editor Scripts -->
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
        quill.root.innerHTML = textarea.value;

        quill.on("text-change", function () {
            textarea.value = quill.root.innerHTML;
        });

        document.querySelector("form").addEventListener("submit", function () {
            textarea.value = quill.root.innerHTML;
        });
    });
</script>

{{-- Add auto-hide for success messages after 5 seconds --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Auto-hide success messages after 5 seconds
        const successAlert = document.querySelector('.alert-success');
        if (successAlert) {
            setTimeout(function() {
                successAlert.style.transition = 'opacity 0.5s ease';
                successAlert.style.opacity = '0';
                setTimeout(function() {
                    successAlert.style.display = 'none';
                }, 500);
            }, 5000);
        }
    });
</script>
@endsection