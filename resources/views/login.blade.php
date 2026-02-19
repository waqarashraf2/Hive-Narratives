@extends('layouts.app')

@section('title', 'Login | HiveNarratives')

@push('meta')
    <meta name="description" content="Login to your HiveNarratives account to continue exploring, sharing, and managing your blog posts. Access your dashboard and connect with the community.">
    <meta name="keywords" content="login, HiveNarratives, blog login, user dashboard, sign in">
@endpush

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 mt">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-4">Login</h1>
        <p class="text-center text-sm text-gray-600 mb-6">
            Access your HiveNarratives account to manage your stories, connect with the community, and explore new content.
        </p>

        @if(session('success'))
            <p class="text-green-600 text-center mb-3">{{ session('success') }}</p>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-4" aria-label="Login Form">
            @csrf

            <!-- Email -->
            <div>
                <label class="block text-gray-700 font-semibold" for="email">Email Address</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    aria-required="true" aria-label="Email Address">
            </div>

            <!-- Password -->
            <div>
                <label class="block text-gray-700 font-semibold" for="password">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    aria-required="true" aria-label="Password">
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition"
                aria-label="Submit Login">
                Login
            </button>
        </form>

        <p class="text-center text-gray-600 mt-4">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Sign Up</a>
        </p>

        <div class="mt-6 text-center text-sm text-gray-500">
            <p>Forgot your password? Use the reset option on the login screen to regain access.</p>
            <p class="mt-2">Need help? <a href="{{ route('contact') }}" class="text-blue-600 hover:underline">Contact our support team</a>.</p>
        </div>
            <div class="mt-4 text-center">
    <a href="{{ route('google.login') }}"
       class="w-full inline-block bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition">
        Login with Google
    </a>
</div>

    </div>
</div>
@endsection
