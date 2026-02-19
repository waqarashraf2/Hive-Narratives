@extends('layouts.app')
@section('title', $pageTitle ?: 'All Articles - ' . config('app.name'))
@section('meta-description', $metaDescription ?: 'Browse all articles categorized by topics. Find the latest content on various subjects.')
@section('meta-keywords', $metaKeywords ?: 'articles, blog posts, categories, latest content')
@section('content')
<div class="w-full max-w-5xl mx-auto px-0" style="margin-top: 100px;">

    <!-- Page Heading -->
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">All Articles</h1>
        <p class="text-gray-600">Browse our collection of articles organized by categories</p>
    </div>

    <!-- Display Categories -->
    <div class="bg-white p-0 mb-6 rounded-lg shadow-sm relative">
        <h2 class="text-xl font-semibold text-gray-800 mb-3">Categories</h2>
        <div class="relative">
            <!--<button id="scroll-left" class="absolute left-0 top-1/2 transform -translate-y-1/2 z-10 bg-white p-2 rounded-full shadow-md hover:bg-gray-100 focus:outline-none">-->
            <!--    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">-->
            <!--        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />-->
            <!--    </svg>-->
            <!--</button>-->
            <div id="categories-container" class="flex overflow-x-auto scroll-smooth space-x-2 py-2 px-8 hide-scrollbar">
                @foreach ($categories as $category)
                    <a href="{{ route('blogs.all', ['category' => urlencode($category)]) }}" 
                       class="flex-shrink-0 px-4 py-2 text-sm bg-purple-600 text-white rounded-full hover:bg-purple-700 transition whitespace-nowrap">
                        {{ ucfirst($category) }}
                    </a>
                @endforeach
            </div>
            <!--<button id="scroll-right" class="absolute right-0 top-1/2 transform -translate-y-1/2 z-10 bg-white p-2 rounded-full shadow-md hover:bg-gray-100 focus:outline-none">-->
            <!--    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">-->
            <!--        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />-->
            <!--    </svg>-->
            <!--</button>-->
        </div>
    </div>

    <!-- Search Bar -->
    <div class="mb-6 bg-white p-0 rounded-lg shadow-sm">
        <h2 class="text-xl font-semibold text-gray-800 mb-3">Search Articles</h2>
        <form action="{{ route('blogs.all') }}" method="GET">
            <input type="text" name="search" value="{{ request('search') }}" 
                   class="w-full p-1 border rounded-lg focus:ring focus:ring-blue-300" 
                   placeholder="Search articles...">
        </form>
    </div>

    <!-- Blog List -->
    <div id="blog-list">
        @include('blogs.partials.blogs')
    </div>

    <!-- Loading Spinner -->
    <div id="loading" class="text-center my-4 hidden">
        <div class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-purple-600 mb-2"></div>
        <p class="text-gray-500">Loading more articles...</p>
    </div>

</div>

@endsection

@push('styles')
<style>
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}
.hide-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Infinite scroll functionality
    let page = 1;
    let isLoading = false;
    let hasMore = true;

    window.addEventListener("scroll", function () {
        if (isLoading || !hasMore) return;

        let scrollPosition = window.scrollY + window.innerHeight;
        let documentHeight = document.documentElement.scrollHeight;

        if (scrollPosition >= documentHeight - 300) { // Near the bottom
            loadMoreBlogs();
        }
    });

    function loadMoreBlogs() {
        isLoading = true;
        document.getElementById('loading').classList.remove('hidden');
        page++;

        let url = new URL("{{ route('blogs.all') }}");
        url.searchParams.append('page', page);
        
        // Preserve existing query parameters
        @if(request('search'))
            url.searchParams.append('search', "{{ request('search') }}");
        @endif
        @if(request('category'))
            url.searchParams.append('category', "{{ request('category') }}");
        @endif

        fetch(url, {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "Accept": "text/html"
            }
        })
        .then(response => response.text())
        .then(data => {
            if (data.trim() !== "") {
                document.getElementById("blog-list").insertAdjacentHTML("beforeend", data);
            } else {
                hasMore = false;
            }
        })
        .catch(error => console.error("Error loading blogs:", error))
        .finally(() => {
            isLoading = false;
            document.getElementById('loading').classList.add('hidden');
        });
    }

    // Category scrolling functionality
    const categoriesContainer = document.getElementById('categories-container');
    const scrollLeftBtn = document.getElementById('scroll-left');
    const scrollRightBtn = document.getElementById('scroll-right');
    
    scrollLeftBtn.addEventListener('click', () => {
        categoriesContainer.scrollBy({ left: -200, behavior: 'smooth' });
    });
    
    scrollRightBtn.addEventListener('click', () => {
        categoriesContainer.scrollBy({ left: 200, behavior: 'smooth' });
    });
    
    // Hide arrows when at the ends
    const checkScrollPosition = () => {
        const { scrollLeft, scrollWidth, clientWidth } = categoriesContainer;
        scrollLeftBtn.style.display = scrollLeft <= 0 ? 'none' : 'block';
        scrollRightBtn.style.display = scrollLeft >= scrollWidth - clientWidth ? 'none' : 'block';
    };
    
    categoriesContainer.addEventListener('scroll', checkScrollPosition);
    window.addEventListener('resize', checkScrollPosition);
    checkScrollPosition(); // Initial check
});
</script>
@endpush