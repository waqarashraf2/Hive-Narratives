@extends('layouts.admin') {{-- Assuming your layout file is layouts/admin.blade.php --}}

@section('title', 'Manage Credits')

@section('content')
<div class="bg-white shadow rounded p-4">
    <h2 class="text-xl font-semibold mb-4">Credit Requests</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full table-auto border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">User</th>
                <th class="border px-4 py-2">Amount ($)</th>
                <th class="border px-4 py-2">Credits</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Note</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchases as $purchase)
            <tr class="text-center">
                <td class="border px-4 py-2">{{ $purchase->user->name }}<br>{{ $purchase->user->email }}</td>
                <td class="border px-4 py-2">${{ $purchase->amount }}</td>
                <td class="border px-4 py-2">{{ $purchase->credits_purchased }}</td>
                <td class="border px-4 py-2">
                    @if($purchase->status === 'pending')
                        <span class="text-yellow-600 font-semibold">Pending</span>
                    @elseif($purchase->status === 'approved')
                        <span class="text-green-600 font-semibold">Approved</span>
                    @else
                        <span class="text-red-600 font-semibold">Rejected</span>
                    @endif
                </td>
                <td class="border px-4 py-2">{{ $purchase->admin_notes }}</td>
                <td class="border px-4 py-2 flex justify-center space-x-2">
                    @if($purchase->status === 'pending')
                        <form method="POST" action="{{ route('admin.credits.approve', $purchase->id) }}">
                            @csrf
                            <button type="submit" class="bg-green-600 text-white px-2 py-1 rounded hover:bg-green-700">Approve</button>
                        </form>
                        <form method="POST" action="{{ route('admin.credits.reject', $purchase->id) }}">
                            @csrf
                            <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700">Reject</button>
                        </form>
                    @else
                        <span class="text-gray-500">No actions</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
