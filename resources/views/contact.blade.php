@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    
    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            <button onclick="this.parentElement.style.display='none'" class="absolute top-0 right-0 px-4 py-3">
                <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    @endif

    {{-- Error Messages --}}
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">Please fix the following issues:</span>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1 class="text-3xl md:text-4xl font-bold mb-6 text-center text-purple-700">Contact Us</h1>

    <div class="bg-white shadow-md rounded-lg p-6 space-y-6">
        <p class="text-lg leading-relaxed">
            We'd love to hear from you! Whether you have questions, suggestions, or need assistance, feel free to reach out to us. Our team is always here to help.
        </p>

        <div>
            <h2 class="text-xl font-semibold mb-2 text-purple-700">📧 Email</h2>
            <p>
                For general inquiries or support, you can email us at: 
                <a href="mailto:mail@hivenarratives.com" class="text-blue-600 underline">mail@hivenarratives.com</a>
            </p>
        </div>

        <div>
            <h2 class="text-xl font-semibold mb-2 text-purple-700">📱 Social Media</h2>
            <ul class="list-disc pl-6 space-y-1">
                <li>Facebook: <a href="https://www.facebook.com/profile.php?id=61575091527442" class="text-blue-600 underline" target="_blank">@Facebook</a></li>
                <li>X: <a href="https://x.com/HiveNarratives" class="text-blue-600 underline" target="_blank">@HiveNarratives</a></li>
                <li>Instagram: <a href="https://www.instagram.com/hivenarratives/" class="text-blue-600 underline" target="_blank">@hivenarratives</a></li>
                <li>LinkedIn: <a href="https://www.linkedin.com/in/hive-narratives-811238360/" class="text-blue-600 underline" target="_blank">@hivenarratives</a></li>
            </ul>
        </div>

        <div>
            <h2 class="text-xl font-semibold mb-2 text-purple-700">💬 We Value Your Feedback!</h2>
            <p>
                Your feedback is important to us. If you have any suggestions on how we can improve our website or services, please don't hesitate to let us know. We're committed to providing the best experience possible.
            </p>
        </div>

        <p class="mt-6 text-lg font-medium text-center">
            Thank you for visiting <strong>Write For Us</strong>. We look forward to hearing from you!
        </p>
    </div>

    {{-- Contact Form --}}
    <div class="bg-white shadow-md rounded-lg p-6 mt-10">
        <h2 class="text-2xl font-bold mb-4 text-purple-700 text-center">Send Us a Message</h2>

        <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Your Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Your Email *</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="subject" class="block text-sm font-medium text-gray-700">Subject *</label>
                <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 @error('subject') border-red-500 @enderror">
                @error('subject')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="message" class="block text-sm font-medium text-gray-700">Message *</label>
                <textarea id="message" name="message" rows="5" required 
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                @error('message')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="bg-purple-700 text-white px-6 py-3 rounded-lg hover:bg-purple-800 transition font-medium">
                    Send Message
                </button>
            </div>
        </form>
    </div>
</div>
@endsection