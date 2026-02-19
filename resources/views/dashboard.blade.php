@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex justify-center items-center">
    <div class="w-full max-w-4xl p-6 bg-white shadow-lg rounded-lg">

        <!-- Welcome Message -->
        <div class="text-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Welcome, {{ $user->name }}</h2>

            @if(Auth::check())
                <p class="text-gray-600 mt-2 flex justify-center items-center gap-2">
                    <i class="fas fa-user text-purple-600"></i>
                    Username: <strong class="text-purple-600">{{ Auth::user()->username }}</strong>
                </p>
            @endif

            <p class="text-gray-600 mt-1 flex justify-center items-center gap-2">
                <i class="fas fa-user-tag text-blue-600"></i>
                Role: <span class="font-semibold text-blue-600">{{ ucfirst($user->role) }}</span>
            </p>
        </div>

        <!-- Dashboard Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Create Blog -->
            <a href="{{ route('blogs.create') }}" 
               class="bg-purple-700 text-white p-4 rounded-lg shadow-md text-center hover:bg-purple-800 transition">
                <div class="flex flex-col items-center">
                    <i class="fas fa-pen-nib text-3xl mb-2"></i>
                    <h3 class="text-lg font-semibold">Create New Blog</h3>
                    <p class="text-sm opacity-80 mt-1">Share your thoughts and insights</p>
                </div>
            </a>

            <!-- View Blogs -->
            <a href="{{ route('blogs.index') }}" 
               class="bg-blue-600 text-white p-4 rounded-lg shadow-md text-center hover:bg-blue-700 transition">
                <div class="flex flex-col items-center">
                    <i class="fas fa-folder-open text-3xl mb-2"></i>
                    <h3 class="text-lg font-semibold">View My Blogs</h3>
                    <p class="text-sm opacity-80 mt-1">Manage and edit your published blogs</p>
                </div>
            </a>

        </div>

        <!-- Logout Button -->
        <form action="{{ route('logout') }}" method="POST" class="mt-6 text-center">
            @csrf
            <button type="submit" 
                    class="bg-red-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-red-600 transition flex items-center justify-center gap-2 mx-auto">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </button>
        </form>
    </div>
</div>
@endsection
