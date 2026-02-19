@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Message Details</h1>
                <p class="text-gray-600">View and reply to contact message</p>
            </div>
            <a href="{{ route('admin.contacts.index') }}" class="text-indigo-600 hover:text-indigo-900">← Back to messages</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <div class="border-b border-gray-200 pb-4 mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">{{ $contact->subject }}</h2>
                    <div class="flex items-center mt-2 text-sm text-gray-500">
                        <span>{{ $contact->name }} &lt;{{ $contact->email }}&gt;</span>
                        <span class="mx-2">•</span>
                        <span>{{ $contact->created_at->format('M d, Y H:i') }}</span>
                    </div>
                </div>
                <div class="prose max-w-none">
                    {{ $contact->message }}
                </div>
            </div>

            @if(!$contact->is_replied)
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Send Reply</h3>
                <form action="{{ route('admin.contacts.reply', $contact) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="reply_message" class="block text-sm font-medium text-gray-700 mb-2">Your Reply</label>
                        <textarea id="reply_message" name="reply_message" rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors">
                            Send Reply
                        </button>
                    </div>
                </form>
            </div>
            @else
            <div class="bg-green-50 rounded-xl shadow-sm p-6 border border-green-100">
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-green-800 font-medium">You have already replied to this message.</span>
                </div>
            </div>
            @endif
        </div>

        <div>
            <div class="bg-white rounded-xl shadow-sm p-6 sticky top-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Message Info</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Status</p>
                        @if($contact->is_replied)
                            <p class="mt-1 text-sm text-green-600 font-medium">Replied</p>
                        @elseif($contact->is_read)
                            <p class="mt-1 text-sm text-blue-600 font-medium">Read</p>
                        @else
                            <p class="mt-1 text-sm text-yellow-600 font-medium">New</p>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Received</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $contact->created_at->format('M d, Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Email</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $contact->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">IP Address</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $contact->ip_address ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection