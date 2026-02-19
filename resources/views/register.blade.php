@extends('layouts.app')

@section('title', 'Create an Account | HiveNarratives')

@push('meta')
    <meta name="description" content="Register a new account on HiveNarratives to share and explore stories across various categories like travel, health, tech, and lifestyle.">
    <meta name="keywords" content="register, create account, HiveNarratives, blogging platform, user signup">
    <meta property="og:title" content="Create an Account | HiveNarratives">
    <meta property="og:description" content="Join HiveNarratives to start sharing and reading amazing stories.">
    <meta property="og:url" content="{{ url()->current() }}">
@endpush

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-10 px-2">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-4" itemscope itemtype="https://schema.org/RegisterAction">
        <h1 class="text-2xl font-bold text-center text-purple-700 mb-2" itemprop="name">Create Your HiveNarratives Account</h1>
        <p class="text-center text-sm text-gray-600 mb-6" itemprop="description">
            Join the community of storytellers, thinkers, and creators.
        </p>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" aria-label="Register Form">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium">Full Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-400"
                    required aria-required="true" aria-label="Full Name">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-400"
                    required aria-required="true" aria-label="Email Address">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-400"
                    required aria-required="true" aria-label="Password">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700 font-medium">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-400"
                    required aria-required="true" aria-label="Confirm Password">
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full bg-purple-600 text-white py-2 px-4 rounded-lg font-medium hover:bg-purple-700 transition"
                aria-label="Submit Registration">
                Register
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-6">
            Already have an account?
            <a href="{{ route('login') }}" class="text-purple-600 hover:underline">Login here</a>.
        </p>
    </div>
</div>
@endsection
