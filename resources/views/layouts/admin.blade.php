<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - HiveNarratives</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">

    <!-- Sidebar -->
    <div class="flex">
        <aside class="w-64 bg-purple-700 text-white min-h-screen p-4">
            <h2 class="text-xl font-semibold mb-4">Admin Panel</h2>
<!-- Sidebar (existing) -->
<nav>
    <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 rounded hover:bg-purple-800">Dashboard</a>
    <a href="{{ route('admin.blogs.index') }}" class="block py-2 px-4 rounded hover:bg-purple-800">Manage Blogs</a>
    <a href="{{ route('admin.categories.index') }}" class="block py-2 px-4 rounded hover:bg-purple-800">Categories</a>
    <a href="{{ route('admin.users.index') }}" class="block py-2 px-4 rounded hover:bg-purple-800">Users</a>
    
    <!-- New Link for Credits -->
    <a href="{{ route('admin.credits.index') }}" class="block py-2 px-4 rounded hover:bg-purple-800">Manage Credits</a>

    <form method="POST" action="{{ route('logout') }}" class="mt-4">
        @csrf
        <button type="submit" class="w-full py-2 px-4 bg-red-600 text-white rounded hover:bg-red-700">Logout</button>
    </form>
</nav>

            
            <!-- Contacts -->
<li class="px-2 py-1 hover:bg-gray-100 rounded">
    <a href="{{ route('admin.contacts.index') }}" class="flex items-center text-gray-700 hover:text-indigo-600">
        <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
        </svg>
        <span>Contact Messages</span>

    </a>
</li>
            
        </aside>

        <!-- Main Content -->
        <div class="flex-1">
            <header class="bg-white shadow p-4 flex justify-between items-center">
                <h1 class="text-xl font-semibold">@yield('title', 'Admin Panel')</h1>
                <span class="text-gray-600">Welcome, {{ auth()->user()->name }}</span>
            </header>

            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
