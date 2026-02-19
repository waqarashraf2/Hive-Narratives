<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HiveNarratives - Multi-Niche Blogging Platform')</title>
    
    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="https://hivenarratives.com/storage/profile_photos/HN_Logo bSS.png">
    <link rel="apple-touch-icon" href="https://hivenarratives.com/storage/profile_photos/HiveNarratives.png">
    <link rel="manifest" href="/site.webmanifest">
<!-- e782b2909c52f3dcc05bc82eaf7f7e9c -->
    <!-- Meta Tags -->
    <meta name="description" content="@yield('meta-description', 'Explore engaging blogs on travel, health, technology, finance, and personal development.')">
    <meta name="keywords" content="@yield('meta-keywords', 'blogging tips, travel blogs, health and wellness, technology trends, finance tips, personal development, productivity hacks, digital nomad lifestyle, tech reviews, healthy living, budget travel, passive income ideas, self-improvement blogs, startup advice, fitness routines, lifestyle inspiration, smart money habits, remote work tips, mental health awareness, trending blog topics')">
    <meta name="author" content="@yield('author', 'HiveNarratives')">
    <meta name="theme-color" content="#7c3aed">

    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="@yield('title', 'HiveNarratives')">
    <meta property="og:description" content="@yield('meta-description', 'Read insightful blogs on various niches.')">
    <meta property="og:image" content="@yield('meta-image', asset('profile_photos/HN.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
<meta name="lh-site-verification" content="b3dff26d8922e172a1a4" />

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'HiveNarratives')">
    <meta name="twitter:description" content="@yield('meta-description', 'Read insightful blogs on various niches.')">
    <meta name="twitter:image" content="@yield('meta-image', asset('profile_photos/HN.jpg'))">
    <meta name="google-site-verification" content="oAKwc1h-8SQaRJ9NuFlhE7ECQA1EzPTsGwgMQlicmNY" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Ads -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1777386434970264" crossorigin="anonymous"></script>

    <!-- Preload Assets -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" as="style">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" as="style">

    <!-- Stylesheets -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1777386434970264"
     crossorigin="anonymous"></script>

    <style>
        :root {
            --primary-color: #7c3aed;
            --primary-hover: #6d28d9;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --bg-primary: #ffffff;
            --bg-secondary: #f9fafb;
            --border-color: #e5e7eb;
        }

        .dark-mode {
            --primary-color: #8b5cf6;
            --primary-hover: #7c3aed;
            --text-primary: #f3f4f6;
            --text-secondary: #d1d5db;
            --bg-primary: #111827;
            --bg-secondary: #1f2937;
            --border-color: #374151;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .nav-item {
            color: var(--text-primary);
            transition: all 0.2s ease;
            position: relative;
        }

        .nav-item:hover {
            color: var(--primary-color);
        }

        .nav-item::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: var(--primary-color);
            transition: width 0.3s ease;
        }

        .nav-item:hover::after {
            width: 100%;
        }

        .dropdown-menu {
            animation: fadeInDown 0.2s ease-out;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .mobile-menu {
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-primary {
            background-color: var(--primary-color);
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .notification-badge {
            font-size: 0.6rem;
            top: -0.5rem;
            right: -0.5rem;
        }

        .avatar-fallback {
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #7c3aed 0%, #4f46e5 100%);
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body class="transition-colors duration-300">
    <!-- Navbar -->
    <nav class="bg-white dark:bg-gray-800 shadow-md fixed w-full top-0 z-50 transition-colors duration-300">
        <div class="container mx-auto flex justify-between items-center py-3 px-6">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center">
                <img width="120px" src="{{ asset('storage/profile_photos/HiveNarratives.png') }}" alt="HiveNarratives" class="h-10">
            </a>
            
            <!-- Desktop Navigation -->
            <div class="hidden md:flex space-x-8 items-center">
                <a href="{{ url('/') }}" class="nav-item">Home</a>
                <a href="{{ route('blogs.all') }}" class="nav-item">Categories</a>
                <a href="{{ route('about') }}" class="nav-item">About</a>
                <a href="{{ route('contact') }}" class="nav-item">Contact</a>
                <a href="{{ route('privacy') }}" class="nav-item">Privacy</a>
                <a href="{{ route('services.index') }}" class="nav-item">Services</a>
                @auth
                    <!-- Notifications -->
                    <div class="relative">
                        <button id="notificationButton" class="text-gray-700 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-400 relative">
                            <i class="fas fa-bell text-xl"></i>
                            @if(Auth::user()->unreadNotifications->count() > 0)
                                <span class="notification-badge absolute bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center">
                                    {{ Auth::user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </button>
                        <div id="notificationDropdown" class="hidden absolute right-0 mt-2 w-72 bg-white dark:bg-gray-700 rounded-lg shadow-xl z-50 overflow-hidden">
                            <div class="p-3 border-b border-gray-200 dark:border-gray-600">
                                <h3 class="font-semibold text-gray-800 dark:text-white">Notifications</h3>
                            </div>

                        </div>
                    </div>
                @endauth

                <!-- User Dropdown -->
                <div class="relative ml-4">
                    @auth
                        <button id="userDropdown" class="flex items-center focus:outline-none">
                            @if(Auth::user()->profile_photo)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" class="w-8 h-8 rounded-full object-cover border-2 border-purple-200">
                            @else
                                <div class="w-8 h-8 rounded-full border-2 border-purple-200 avatar-fallback">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <span class="ml-2 text-gray-700 dark:text-gray-300 hidden md:inline">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down ml-1 text-xs text-gray-500 dark:text-gray-400"></i>
                        </button>
                        <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 rounded-lg shadow-lg py-1 z-50">
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">Dashboard</a>
                            <a href="{{ route('profile') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">Profile</a>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">Settings</a>
                            <div class="border-t border-gray-200 dark:border-gray-600 my-1"></div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-red-500 hover:bg-gray-100 dark:hover:bg-gray-600">Logout</button>
                            </form>
                        </div>
                    @else
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-400">Login</a>
                            <a href="{{ route('register') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg btn-primary">Sign Up</a>
                        </div>
                    @endauth
                </div>

                <!-- Dark Mode Toggle -->
                <button id="darkModeToggle" class="ml-4 p-2 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600">
                    <i class="fas fa-moon dark:hidden"></i>
                    <i class="fas fa-sun hidden dark:block"></i>
                </button>
            </div>

            <!-- Mobile Menu Button -->
            <div class="flex items-center md:hidden space-x-4">
                @auth
                    <button id="notificationButtonMobile" class="text-gray-700 dark:text-gray-300 relative">
                        <i class="fas fa-bell text-xl"></i>
                        @if(Auth::user()->unreadNotifications->count() > 0)
                            <span class="notification-badge absolute top-0 right-0 bg-red-500 text-white rounded-full w-4 h-4 flex items-center justify-center text-xs">
                                {{ Auth::user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </button>
                @endauth
                <button id="mobileMenuButton" class="text-gray-700 dark:text-gray-300 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden fixed inset-0 z-40 bg-white dark:bg-gray-800 mt-16 pt-4 pb-6 px-6 overflow-y-auto mobile-menu">
        <div class="flex flex-col space-y-4">
            <a href="{{ url('/') }}" class="nav-item py-2 border-b border-gray-200 dark:border-gray-700">Home</a>
            <a href="{{ route('blogs.all') }}" class="nav-item py-2 border-b border-gray-200 dark:border-gray-700">Categories</a>
            <a href="{{ route('about') }}" class="nav-item py-2 border-b border-gray-200 dark:border-gray-700">About</a>
                                <a href="{{ route('services.index') }}" class="nav-item">Services</a>
            <a href="{{ route('contact') }}" class="nav-item py-2 border-b border-gray-200 dark:border-gray-700">Contact</a>
            <a href="{{ route('privacy') }}" class="nav-item py-2 border-b border-gray-200 dark:border-gray-700">Privacy</a>
            

            @auth
                <div class="pt-4">
                    <div class="flex items-center space-x-3 mb-4">
                        @if(Auth::user()->profile_photo)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" class="w-10 h-10 rounded-full object-cover border-2 border-purple-200">
                        @else
                            <div class="w-10 h-10 rounded-full border-2 border-purple-200 avatar-fallback">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <p class="font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">@ {{ Auth::user()->username }}</p>
                        </div>
                    </div>
                    
                    <a href="{{ route('dashboard') }}" class="block py-2 text-gray-700 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-400">Dashboard</a>
                    <a href="{{ route('profile') }}" class="block py-2 text-gray-700 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-400">Profile</a>
                    <a href="{{ route('profile.edit') }}" class="block py-2 text-gray-700 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-400">Settings</a>
                        Notifications
                        @if(Auth::user()->unreadNotifications->count() > 0)
                            <span class="ml-2 px-2 py-0.5 bg-red-500 text-white text-xs rounded-full">
                                {{ Auth::user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="w-full text-left py-2 text-red-500">Logout</button>
                    </form>
                </div>
            @else
                <div class="pt-4 flex flex-col space-y-3">
                    <a href="{{ route('login') }}" class="text-center py-2 text-purple-600 dark:text-purple-400 border border-purple-600 dark:border-purple-400 rounded-lg">Login</a>
                    <a href="{{ route('register') }}" class="text-center py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg btn-primary">Sign Up</a>
                </div>
            @endauth

            <!-- Dark Mode Toggle Mobile -->
            <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                <button id="darkModeToggleMobile" class="flex items-center space-x-2 text-gray-700 dark:text-gray-300">
                    <i class="fas fa-moon dark:hidden"></i>
                    <i class="fas fa-sun hidden dark:block"></i>
                    <span>Dark Mode</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <main class="container mx-auto mt-20 px-2 pb-10">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white dark:bg-gray-800 text-center py-6 shadow-inner mt-10">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <a href="{{ url('/') }}" class="inline-block">
                        <img width="120px" src="{{ asset('storage/profile_photos/HiveNarratives.png') }}" alt="HiveNarratives" class="h-8 dark:filter dark:brightness-0 dark:invert">
                    </a>
                    <p class="text-gray-600 dark:text-gray-400 text-sm mt-2">Your multi-niche blogging platform</p>
                </div>
                
                <div class="flex flex-wrap justify-center gap-6 mb-4 md:mb-0">
                    <a href="{{ route('about') }}" class="text-gray-600 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400">About</a>
                    <a href="{{ route('blogs.all') }}" class="text-gray-600 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400">Blogs</a>
                    <a href="{{ route('contact') }}" class="text-gray-600 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400">Contact</a>
                                        <a href="{{ route('services.index') }}" class="nav-item">Services</a>
                    <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400">Privacy Policy</a>
                    <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400">Terms</a>
                </div>
                
    <div class="flex flex-wrap gap-6 text-purple-700 text-2xl">
        <a href="https://www.tiktok.com/@hivenarratives?is_from_webapp=1&sender_device=pc" target="_blank" aria-label="TikTok" class="hover:text-purple-500">
            <i class="fab fa-tiktok"></i>
        </a>
        <a href="https://www.facebook.com/profile.php?id=61575091527442" target="_blank" aria-label="Facebook" class="hover:text-purple-500">
            <i class="fab fa-facebook"></i>
        </a>
        <a href="https://x.com/HiveNarratives" target="_blank" aria-label="Twitter" class="hover:text-purple-500">
            
        </a>
        <a href="https://www.instagram.com/hivenarratives/" target="_blank" aria-label="Instagram" class="hover:text-purple-500">
            <i class="fab fa-instagram"></i>
        </a>
        <a href="https://www.linkedin.com/in/hive-narratives-811238360/" target="_blank" aria-label="LinkedIn" class="hover:text-purple-500">
            <i class="fab fa-linkedin"></i>
        </a>
    </div>
            </div>
            
            <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                <p class="text-gray-500 dark:text-gray-400 text-sm">&copy; {{ date('Y') }} HiveNarratives. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Dark Mode Toggle
        function toggleDarkMode() {
            const html = document.documentElement;
            const isDark = html.classList.contains('dark-mode');
            
            if (isDark) {
                html.classList.remove('dark-mode');
                localStorage.setItem('darkMode', 'disabled');
            } else {
                html.classList.add('dark-mode');
                localStorage.setItem('darkMode', 'enabled');
            }
        }

        // Initialize dark mode
        function initDarkMode() {
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const storedMode = localStorage.getItem('darkMode');
            
            if (storedMode === 'enabled' || (storedMode === null && prefersDark)) {
                document.documentElement.classList.add('dark-mode');
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', () => {
            initDarkMode();
            
            // Set up event listeners
            document.getElementById('darkModeToggle')?.addEventListener('click', toggleDarkMode);
            document.getElementById('darkModeToggleMobile')?.addEventListener('click', toggleDarkMode);
            
            // User dropdown
            document.getElementById('userDropdown')?.addEventListener('click', (e) => {
                e.stopPropagation();
                document.getElementById('dropdownMenu').classList.toggle('hidden');
            });
            
            // Notification dropdown
            document.getElementById('notificationButton')?.addEventListener('click', (e) => {
                e.stopPropagation();
                document.getElementById('notificationDropdown').classList.toggle('hidden');
            });
            
            // Mobile menu toggle
            document.getElementById('mobileMenuButton')?.addEventListener('click', () => {
                document.getElementById('mobileMenu').classList.toggle('hidden');
            });
            
            // Close dropdowns when clicking outside
            document.addEventListener('click', () => {
                document.getElementById('dropdownMenu')?.classList.add('hidden');
                document.getElementById('notificationDropdown')?.classList.add('hidden');
            });
            
            // Mark notifications as read when dropdown is opened
            document.getElementById('notificationButton')?.addEventListener('click', function() {
                if (!document.getElementById('notificationDropdown').classList.contains('hidden')) {
                    $.ajax({
                        url: "{{ route('notifications.read') }}",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function() {
                            // Update badge count
                            const badge = document.querySelector('.notification-badge');
                            if (badge) badge.remove();
                        }
                    });
                }
            });
            
            // Mobile notification click
 
        });

        // Listen for system color scheme changes
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
            if (localStorage.getItem('darkMode') === null) {
                if (e.matches) {
                    document.documentElement.classList.add('dark-mode');
                } else {
                    document.documentElement.classList.remove('dark-mode');
                }
            }
        });
    </script>
    
    @yield('scripts')
</body>
</html>